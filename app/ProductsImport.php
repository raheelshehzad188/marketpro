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

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\IValueBinder;

use Auth;

//class ProductsImport implements ToModel, WithHeadingRow, WithValidation
class ProductsImport implements ToCollection, WithHeadingRow, WithValidation, ToModel, WithChunkReading, WithCustomValueBinder
{
    private $rows = 0;

    public function collection(Collection $rows)
    {



        foreach ($rows as $row) {


            $row = $row->mapWithKeys(function ($value, $key) {
                return [strtolower($key) => $value];
            });

            if (!empty($row['artikelnummer'])) {

                if ($row['artikelgrupp'] == 'TM' || $row['artikelgrupp'] == 'TM') {
                    $addon = ProductAddon::where('sku', $row['artikelnummer'])->first();
                    if ($addon == null) {
                        $productId =  ProductAddon::create([
                            'name' => $row['benmning'],  // Adjusted from 'benamning' to 'benmning'
                            'other_name' => $row['annan_benmning'],  // Adjusted from 'annan_benamning' to 'annan_benmning'
                            'short_name' => $row['kortnamn'],
                            'article_group' => $row['artikelgrupp'],
                            'fake_price' => $row['fake_pris'],
                            'qty' => $row['disponibelt'],
                            'sku' => $row['artikelnummer'],
                            'unit_price' => $row['pris'],
                        ]);

                        //$addonId =   ProductAddon::create();
                    } else {

                        $addon->name = $row['benmning'];
                        $addon->other_name = $row['annan_benmning'];
                        $addon->short_name = $row['kortnamn'];
                        $addon->article_group = $row['artikelgrupp'];
                        $addon->fake_price = $row['fake_pris'];
                        $addon->qty = $row['disponibelt'];
                        $addon->sku = $row['artikelnummer'];
                        $addon->unit_price = $row['pris'];
                        $addon->save();
                    }
                } else {
                    $product = Product::where('sku', $row['artikelnummer'])->first();
                    if ($product == null) {
                        $productId =  Product::create([
                            'name' => $row['benmning'],
                            'other_name' => $row['annan_benmning'],
                            'short_name' => $row['kortnamn'],
                            'added_by' =>  'admin',
                            'user_id' => 1,
                            'article_group' => $row['artikelgrupp'],
                            'fake_price' => $row['fake_pris'],
                            'current_stock' => $row['disponibelt'],
                            'qty' => $row['disponibelt'],
                            'sku' => $row['artikelnummer'],
                            'unit_price' => $row['pris'],
                        ]);
                    } else {
                        $product->name = $row['benmning'];
                        $product->other_name = $row['annan_benmning'];
                        $product->short_name = $row['kortnamn'];
                        $product->article_group = $row['artikelgrupp'];
                        $product->fake_price = $row['fake_pris'];
                        $product->current_stock = $row['disponibelt'];
                        $product->qty = $row['disponibelt'];
                        $product->sku = $row['artikelnummer'];
                        $product->unit_price = $row['pris'];
                        $product->save();
                    }
                }
            }
        }

        flash(translate('Products imported successfully'))->success();
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell == 'codice') {
        }

        $cell->setValueExplicit($value, DataType::TYPE_STRING);
        return true;

        // else return default behavior
        // return parent::bindValue($cell, $value);
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
