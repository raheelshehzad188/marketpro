<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PosProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'stock_id' => $data->stock_id,
                    'name' => $data->name,
                    'thumbnail_image' => ($data->stock_image == null)  ? uploaded_asset($data->thumbnail_img) : uploaded_asset($data->stock_image),
                    'price' => 28,
                    'base_price' =>34,
                    'qty' => $data->stock_qty,
                    'variant' => $data->variant,
                ];
            })
         ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
