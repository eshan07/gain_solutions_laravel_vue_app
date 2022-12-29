<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductList()
    {
        $searchTerm = \request()->searchTerm;
        $products = Product::active()->with('category','images');
        if ($searchTerm){
            $products->where('name', 'LIKE', '%' . $searchTerm . '%');
        }
        return paginateResponse($products, ProductResource::class,'products',10);
    }
}
