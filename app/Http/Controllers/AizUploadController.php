<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;
use Response;
use Auth;
use Storage;
use Image;

class AizUploadController extends Controller
{


    public function index(Request $request){


        $all_uploads = (auth()->user()->user_type == 'seller') ? Upload::where('user_id',auth()->user()->id) : Upload::query();
        $search = null;
        $sort_by = null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%'.$request->search.'%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)->appends(request()->query());


        return (auth()->user()->user_type == 'seller')
            ? view('frontend.user.seller.uploads.index', compact('all_uploads', 'search', 'sort_by'))
            : view('backend.uploaded_files.index', compact('all_uploads', 'search', 'sort_by'));
    }

    public function create(){
        return (auth()->user()->user_type == 'seller')
            ? view('frontend.user.seller.uploads.create')
            : view('backend.uploaded_files.create');
    }


    public function show_uploader(Request $request){
        return view('uploader.aiz-uploader');
    }
    public function upload(Request $request){
        try {
            $type = array(
                "jpg"=>"image",
                "jpeg"=>"image",
                "png"=>"image",
                "svg"=>"image",
                "webp"=>"image",
                "gif"=>"image",
                "mp4"=>"video",
                "mpg"=>"video",
                "mpeg"=>"video",
                "webm"=>"video",
                "ogg"=>"video",
                "avi"=>"video",
                "mov"=>"video",
                "flv"=>"video",
                "swf"=>"video",
                "mkv"=>"video",
                "wmv"=>"video",
                "wma"=>"audio",
                "aac"=>"audio",
                "wav"=>"audio",
                "mp3"=>"audio",
                "zip"=>"archive",
                "rar"=>"archive",
                "7z"=>"archive",
                "doc"=>"document",
                "txt"=>"document",
                "docx"=>"document",
                "pdf"=>"document",
                "csv"=>"document",
                "xml"=>"document",
                "ods"=>"document",
                "xlr"=>"document",
                "xls"=>"document",
                "xlsx"=>"document"
            );

            if(!$request->hasFile('aiz_file')){
                return response()->json(['error' => 'No file uploaded'], 400);
            }

            $upload = new Upload;
            $extension = strtolower($request->file('aiz_file')->getClientOriginalExtension());

            if(!isset($type[$extension])){
                return response()->json(['error' => 'File type not allowed'], 400);
            }

            // Get original file name
            $upload->file_original_name = null;
            $arr = explode('.', $request->file('aiz_file')->getClientOriginalName());
            for($i=0; $i < count($arr)-1; $i++){
                if($i == 0){
                    $upload->file_original_name .= $arr[$i];
                }
                else{
                    $upload->file_original_name .= ".".$arr[$i];
                }
            }

            // Ensure uploads directory exists with proper permissions
            $uploadDir = public_path('uploads/all');
            if (!file_exists($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true)) {
                    return response()->json(['error' => 'Failed to create upload directory'], 500);
                }
                // Set permissions explicitly
                chmod($uploadDir, 0777);
            } else {
                // Ensure directory is writable
                if (!is_writable($uploadDir)) {
                    // Try to make it writable
                    if (!chmod($uploadDir, 0777)) {
                        return response()->json(['error' => 'Upload directory is not writable and could not be fixed'], 500);
                    }
                }
            }

            // Generate unique filename
            $fileName = uniqid() . '_' . time() . '.' . $extension;
            $path = 'uploads/all/' . $fileName;
            $fullPath = public_path($path);

            // Move uploaded file to destination using copy + unlink method
            try {
                $uploadedFile = $request->file('aiz_file');
                $tempPath = $uploadedFile->getRealPath();
                
                // Use copy instead of move for better compatibility
                if (!copy($tempPath, $fullPath)) {
                    return response()->json(['error' => 'Failed to copy uploaded file. Check directory permissions.'], 500);
                }
                
                // Verify file was copied successfully
                if (!file_exists($fullPath)) {
                    return response()->json(['error' => 'File was not copied successfully'], 500);
                }
                
                // Set file permissions
                chmod($fullPath, 0644);
                
            } catch (\Exception $e) {
                \Log::error('File copy error: ' . $e->getMessage());
                return response()->json(['error' => 'Failed to save uploaded file: ' . $e->getMessage()], 500);
            }

            // Verify file was moved successfully
            if (!file_exists($fullPath)) {
                \Log::error('File not found after move: ' . $fullPath);
                return response()->json(['error' => 'File storage failed'], 500);
            }

            $size = filesize($fullPath);

            // Get MIME type from stored file
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_mime = finfo_file($finfo, $fullPath);
            if (!$file_mime) {
                // Fallback to uploaded file MIME type
                $file_mime = finfo_file($finfo, $request->file('aiz_file')->getRealPath());
            }
            finfo_close($finfo);

            // Image optimization
            if($type[$extension] == 'image' && get_setting('disable_image_optimization') != 1){
                try {
                    if (file_exists($fullPath)) {
                        $img = Image::make($fullPath)->encode();
                        $height = $img->height();
                        $width = $img->width();
                        if($width > $height && $width > 1500){
                            $img->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }elseif ($height > 1500) {
                            $img->resize(null, 800, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $img->save($fullPath);
                        clearstatcache();
                        $size = filesize($fullPath);
                    }
                } catch (\Exception $e) {
                    \Log::error('Image optimization error: ' . $e->getMessage());
                }
            }
            
            // Handle S3 storage if configured
            if (env('FILESYSTEM_DRIVER') == 's3') {
                try {
                    Storage::disk('s3')->put(
                        $path,
                        file_get_contents($fullPath),
                        [
                            'visibility' => 'public',
                            'ContentType' =>  $extension == 'svg' ? 'image/svg+xml' : $file_mime
                        ]
                    );
                    if($arr[0] != 'updates') {
                        @unlink($fullPath);
                    }
                } catch (\Exception $e) {
                    \Log::error('S3 upload error: ' . $e->getMessage());
                }
            }

            // Save upload record
            $upload->extension = $extension;
            $upload->file_name = $path;
            $upload->user_id = Auth::user()->id;
            $upload->type = $type[$extension];
            $upload->file_size = $size;
            
            if($upload->save()){
                return response()->json(['success' => true, 'id' => $upload->id]);
            } else {
                return response()->json(['error' => 'Failed to save upload record'], 500);
            }
            
        } catch (\Exception $e) {
            \Log::error('Upload error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Upload failed: ' . $e->getMessage()], 500);
        }
    }

    public function get_uploaded_files(Request $request)
    {
        // For admin/staff users, show all admin-uploaded images
        // For sellers, show only their own images
        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
            // Show all uploads from admin/staff users (or all uploads for admin)
            $uploads = Upload::query();
            // Optionally filter to only admin/staff uploads:
            // $uploads = Upload::whereHas('user', function($query) {
            //     $query->whereIn('user_type', ['admin', 'staff']);
            // });
        } else {
            // For sellers, show only their own uploads
            $uploads = Upload::where('user_id', Auth::user()->id);
        }
        
        if ($request->search != null) {
            $uploads->where('file_original_name', 'like', '%'.$request->search.'%');
        }
        if ($request->sort != null) {
            switch ($request->sort) {
                case 'newest':
                    $uploads->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $uploads->orderBy('created_at', 'asc');
                    break;
                case 'smallest':
                    $uploads->orderBy('file_size', 'asc');
                    break;
                case 'largest':
                    $uploads->orderBy('file_size', 'desc');
                    break;
                default:
                    $uploads->orderBy('created_at', 'desc');
                    break;
            }
        }
        return $uploads->paginate(60)->appends(request()->query());
    }

    public function destroy(Request $request,$id)
    {
        $upload = Upload::findOrFail($id);
        
        if(auth()->user()->user_type == 'seller' && $upload->user_id != auth()->user()->id){
            flash(translate("You don't have permission for deleting this!"))->error();
            return back();
        }
        try{
            if(env('FILESYSTEM_DRIVER') == 's3'){
                Storage::disk('s3')->delete($upload->file_name);
                if (file_exists(public_path().'/'.$upload->file_name)) {
                    unlink(public_path().'/'.$upload->file_name);
                }
            }
            else{
                unlink(public_path().'/'.$upload->file_name);
            }
            $upload->delete();
            flash(translate('File deleted successfully'))->success();
        }
        catch(\Exception $e){
            $upload->delete();
            flash(translate('File deleted successfully'))->success();
        }
        return back();
    }

    public function get_preview_files(Request $request){
        $ids = explode(',', $request->ids);
        $files = Upload::whereIn('id', $ids)->get();
        return $files;
    }

    //Download project attachment
    public function attachment_download($id)
    {
        $project_attachment = Upload::find($id);
        try{
           $file_path = public_path($project_attachment->file_name);
            return Response::download($file_path);
        }catch(\Exception $e){
            flash(translate('File does not exist!'))->error();
            return back();
        }

    }
    //Download project attachment
    public function file_info(Request $request)
    {
        $file = Upload::findOrFail($request['id']);

        return (auth()->user()->user_type == 'seller')
            ? view('frontend.user.seller.uploads.info',compact('file'))
            : view('backend.uploaded_files.info',compact('file'));
    }

}
