<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'name' => $this->name,
            'bn_name' => $this->bn_name ?? '-',
            'short_note' => $this->short_note,
            'slug' => $this->slug,
            'category' => $this->whenLoaded('category', function (){
                return $this->category->name ?? '';
            }),
            'category_slug' => $this->whenLoaded('category', function (){
                return $this->category->slug ?? '';
            }),
            'feature_image' => $this->feature_image ? Storage::disk(config('app.files_disk'))->url('images/product/feature').$this->feature_image : Storage::disk(config('app.files_disk'))->url('images//default-logo.png'),
//            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'images' => ProductImagesResource::collection($this->whenLoaded('images')),
            'price'=>$this->price,
            'description' => $this->description,
            'unit' => $this->unit,
            'specification' => $this->specification,
            'delivery_info' => $this->delivery_info,
            'faqs' => $this->faqs,

        ];
    }
}
