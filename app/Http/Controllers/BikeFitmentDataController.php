<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BikeFitmentDataImport;
use Illuminate\Support\Facades\Log;

class BikeFitmentDataController extends Controller
{
    /**
     * Handle the bike fitment data upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadBikeFitmentData(Request $request)
    {
        $request->validate([
            'bulk_file' => 'required|mimes:xlsx,csv',
            'import_id' => 'required|string', // Validate the presence of the import ID
        ]);

        $importId = $request->input('import_id'); // Get the unique import ID from the request

        $fileName = time() . '_' . $request->file('bulk_file')->getClientOriginalName();
        $filePath = public_path('uploads/bike_fitment_data/' . $fileName);

        if (!file_exists(public_path('uploads/bike_fitment_data'))) {
            mkdir(public_path('uploads/bike_fitment_data'), 0777, true);
        }

        $request->file('bulk_file')->move(public_path('uploads/bike_fitment_data'), $fileName);


        try {
            // Start the import process without counting rows first
            Excel::import(new BikeFitmentDataImport($importId), $filePath);
            return response()->json(['success' => true, 'message' => 'Upload started successfully.']);
        } catch (\Exception $e) {
            Log::error('Error during Bike Data import: ' . $e->getMessage());
            return response()->json(['error' => 'File import failed.'], 500);
        }

        return response()->json(['success' => true, 'importId' => $importId]);
    }
}
