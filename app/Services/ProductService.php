<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;

class ProductService
{
    public function store($validated)
    {
        if (isset($validated['feature_image'])) {
            $validated['feature_image'] = $this->getFeatureImageUploadableName($validated['feature_image']);
        }
        $product = Product::create($validated);
        if (isset($validated['images'])) {
            $this->uploadProductGalleryImage($validated['images'],$product);
        }
        return $product;
    }

    public function update($product_slug, $validated)
    {
        $product = Product::with('images')->where('slug', $product_slug)->first();
        if (isset($validated['feature_image'])) {
            $validated['feature_image'] = $this->getFeatureImageUploadableName($validated['feature_image']);
            deleteOne('images/product/feature', $product->feature_image);
        }
        $product->update($validated);
        if (isset($validated['images'])) {
            if ($product->images) {
                foreach ($product->images as $image){
                    deleteOne('images/product/gallery', $image->file_name);
                }
                $product->images()->delete();
            }
            $this->uploadProductGalleryImage($validated['images'],$product);
        }
        return $product;
    }

    public function getFeatureImageUploadableName($validated)
    {
        $image = imageUpload($validated, 'images/product/feature', true, true, 700, 700);
        return $image['file_name'];
    }

    public function uploadProductGalleryImage($validated, $product)
    {
        foreach ($validated as $key => $image) {
            $image = imageUpload($image, 'images/product/gallery', true, true, 700, 700);
            $image['imageable_type'] = $product;
            $image['imageable_id'] = $product->id;
            $product->image()->create($image);
        }
    }
}
