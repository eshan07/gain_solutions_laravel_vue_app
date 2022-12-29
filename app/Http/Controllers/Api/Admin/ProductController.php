<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::with('category','images');
        return paginateResponse($products, ProductResource::class,'products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request, ProductService $service)
    {
        $validated = $request->validated();
        try {
            $product = $service->store($validated);
            return successResponse('Product stored successfully!');

        } catch (\Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return resourceResponse('product',$product->load('category','images'),ProductResource::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $product, ProductService $service)
    {
         $validated = $request->validated();
        try {
            $service->update($product,$validated);
            return successResponse('Product updated successfully!');
        } catch (\Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->feature_image) {
                deleteOne('images/product/feature', $product->feature_image);
            }
            if ($product->images) {
                foreach ($product->images as $image){
                    deleteOne('images/product/gallery', $image->file_name);
                }
                $product->images()->delete();
            }
            $product->delete();
            return successResponse('Product deleted!');
        }catch (\Exception $exception){
           return errorResponse();
        }
    }
}
