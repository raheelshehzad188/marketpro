<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\ModelName;
use App\Models\Year;
use App\Models\Manufacturer;
use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BikeFitmentDataImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    private $importId;

    public function __construct($importId)
    {
        $this->importId = $importId;
    }

    public function collection(Collection $rows)
    {
        // Log when a new chunk starts processing
        Log::channel('bike_fitment_import')->info("Starting import process for chunk in import ID {$this->importId}", [
            'import_id' => $this->importId,
        ]);

        foreach ($rows as $row) {
            try {
                $product = Product::where('sku', $row['sku'])->first();

                if ($product) {
                    try {
                        $brand = Brand::firstOrCreate(['name' => $row['brand']]);
                        $product->brands()->syncWithoutDetaching([$brand->id]);
                    } catch (\Exception $e) {
                        Log::channel('bike_fitment_import')->error('Error creating or syncing Brand: ' . $e->getMessage(), ['row' => $row]);
                    }

                    try {
                        $model = ModelName::firstOrCreate(['name' => $row['model']]);
                        $product->models()->syncWithoutDetaching([$model->id]);
                    } catch (\Exception $e) {
                        Log::channel('bike_fitment_import')->error('Error creating or syncing Model: ' . $e->getMessage(), ['row' => $row]);
                    }

                    try {
                        $manufacturer = Manufacturer::firstOrCreate(['name' => $row['manufacturer_brand']]);
                        $product->manufacturers()->syncWithoutDetaching([$manufacturer->id]);
                    } catch (\Exception $e) {
                        Log::channel('bike_fitment_import')->error('Error creating or syncing Manufacturer: ' . $e->getMessage(), ['row' => $row]);
                    }

                    try {
                        $year = Year::firstOrCreate(['name' => $row['year']]);
                        $product->years()->syncWithoutDetaching([$year->id]);
                    } catch (\Exception $e) {
                        Log::channel('bike_fitment_import')->error('Error creating or syncing Year: ' . $e->getMessage(), ['row' => $row]);
                    }
                } else {
                    throw new \Exception('SKU not found in product database: ' . $row['sku']);
                }
            } catch (\Exception $e) {
                Log::channel('bike_fitment_import')->error('Failed to process bike fitment data: ' . $e->getMessage(), [
                    'row' => $row->toArray(),
                    'import_id' => $this->importId,
                ]);
            }
        }
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
