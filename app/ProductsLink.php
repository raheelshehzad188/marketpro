<?php

namespace App;

use App\Product;
use App\ProductAddon;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Str;
use Auth;

//class ProductsImport implements ToModel, WithHeadingRow, WithValidation
class ProductsLink implements ToCollection, WithHeadingRow, WithValidation, ToModel, WithChunkReading
{
    private $rows = 0;
    private $product_id = '';
    function __construct($pId)
    {
        $this->product_id = $pId;
    }

    public function collection(Collection $rows)
    {
        \DB::table('product_addon_pivot')->where('product_id', $this->product_id)->delete();
        foreach ($rows as $row) {
            if (!empty($row['codice'])) {
                $addon_first = ProductAddon::where('sku', $row['codice'])->get();
                if (!$addon_first->isEmpty()){
                    $addon = $addon_first->first();
                    \DB::table('product_addon_pivot')->insert([
                        'product_id' =>  $this->product_id,
                        'product_addon_id' => $addon->id,
                        'sort_order' => $row['pos']
                    ]);
                }

                
                // if ($addon == null) {
                //     // $addonId =  ProductAddon::create([
                //     //     'name' => $row['benamning'],
                //     //     'other_name' => $row['annan_benamning'],
                //     //     'short_name' => $row['kortnamn'],
                //     //     'article_group' => $row['artikelgrupp'],
                //     //     'fake_price' => $row['fake_pris'],
                //     //     'qty' => $row['disponibelt'],
                //     //     'sku' => $row['artikelnummer'],
                //     //     'unit_price' => $row['pris'],
                //     // ]);
                //     //$addonId =   ProductAddon::create();
                // } else {
                //     // $addon->name = $row['benamning'];
                //     // $addon->other_name = $row['annan_benamning'];
                //     // $addon->short_name = $row['kortnamn'];
                //     // $addon->article_group = $row['artikelgrupp'];
                //     // $addon->fake_price = $row['fake_pris'];
                //     // $addon->qty = $row['disponibelt'];
                //     // $addon->sku = $row['artikelnummer'];
                //     // $addon->unit_price = $row['pris'];
                //     // $addon->save();
                   
                // }
            }
        }

        flash(translate('Products linked successfully'))->success();
    }

    public function model(array $row)
    {
        ++$this->rows;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function rules(): array
    {
        return [
            // Can also use callback validation rules
            'unit_price' => function ($attribute, $value, $onFailure) {
                if (!is_numeric($value)) {
                    $onFailure('Unit price is not numeric');
                }
            }
        ];
    }
    public function chunkSize(): int
    {
        return 200;
    }
    public function downloadThumbnail($url)
    {
        try {
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            $filename = 'uploads/all/' . Str::random(5) . '.' . $extension;
            $fullpath = 'public/' . $filename;
            $file = file_get_contents($url);
            file_put_contents($fullpath, $file);

            $upload = new Upload;
            $upload->extension = strtolower($extension);

            $upload->file_original_name = $filename;
            $upload->file_name = $filename;
            $upload->user_id = Auth::user()->id;
            $upload->type = "image";
            $upload->file_size = filesize(base_path($fullpath));
            $upload->save();

            return $upload->id;
        } catch (\Exception $e) {
            //dd($e);
        }
        return null;
    }
}
