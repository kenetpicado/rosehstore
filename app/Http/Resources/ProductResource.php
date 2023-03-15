<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->SKU,
            'description' => $this->description,
            'default_price' => $this->default_price,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'category_parent_name' => $this->category->parent?->name,
            'category_parent_id' => $this->category->parent?->id,
            'is_new' => $this->created_at->gt(now()->subDays(15)),
            'has_new_stock' => $this->stocks->contains('created_at', '>', now()->subDays(15)),
            'stocks' => StockResource::collection($this->stocks),
        ];
    }
}
