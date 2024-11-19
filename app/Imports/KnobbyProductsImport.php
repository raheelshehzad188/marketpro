<?php

namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue; // Add this

class KnobbyProductsImport implements ToCollection, WithChunkReading, WithHeadingRow, ShouldQueue
{
    private $importId;

    public function __construct($importId)
    {
        $this->importId = $importId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                if (empty($row['name']) || empty($row['article_no'])) {
                    throw new \Exception('Missing required fields: Name or SKU');
                }

                $product = Product::updateOrCreate(
                    ['sku' => $row['article_no']],
                    [
                        'name' => $row['name'] ?? null,
                        'unit_price' => $row['retail_price'] ?? 0,
                        'fake_price' => $row['dealer_price'] ?? 0,
                        'current_stock' => $row['stock_count'] ?? 0,
                        'knobby_images' => json_encode([$row['image'] ?? null]),
                        'knobby_thumbnail_img' => $row['small_image'] ?? null,
                        'description' => $row['long_webtext'] ?? null,
                        'attributes' => json_encode([
                            'SizeTires' => $row['sizetires'] ?? null,
                            'Spokes' => $row['spokes'] ?? null,
                            'SprocketsChains' => $row['sprocketschains'] ?? null,
                            'Tools' => $row['tools'] ?? null,
                            'WearParts' => $row['wearparts'] ?? null,
                            'UniversalSize' => $row['universalsize'] ?? null,
                            'ValvesShims' => $row['valvesshims'] ?? null,
                            'Wheel' => $row['wheel'] ?? null,
                            'WireBrakeHose' => $row['wirebrakehose'] ?? null,
                        ]),
                        'additional_attributes' => json_encode([
                            'Short Webtext' => $row['short_webtext'] ?? null,
                            'Article No' => $row['article_no'] ?? null,
                            'Supplier SKU' => $row['supplier_sku'] ?? null,
                            'EAN/UPC' => $row['eanupc'] ?? null,
                        ]),
                        'source' => 'knobby',
                        'min_qty' => 1,
                        'unit' => 'pcs',
                    ]
                );

                $product->visibility()->sync([2]);

                $cachedProcessedRows = Cache::get("processed_rows_{$this->importId}", 0);
                $cachedProcessedRows++;
                Cache::put("processed_rows_{$this->importId}", $cachedProcessedRows, 3600);

            } catch (\Exception $e) {
                Log::channel('product_import')->error('Failed to process product: ' . $e->getMessage(), [
                    'row' => $row->toArray()
                ]);
                continue;
            }
        }

        $processedChunks = Cache::get("processed_chunks_{$this->importId}", 0);
        $processedChunks++;
        Cache::put("processed_chunks_{$this->importId}", $processedChunks, 3600);

        if ($rows->count() < $this->chunkSize()) {
            Cache::put("import_completed_{$this->importId}", true, 3600);
        }
    }

    public function chunkSize(): int
    {
        return 500; // Adjust based on your server capacity
    }
}
