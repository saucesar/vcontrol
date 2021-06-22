<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $products = auth('api')->user()->company->productsWithPaginate(10, true);
            
            return response()->json(['products' => $products]);    
        } catch(\Throwable $e) {
            return response()->json(['msg' => $e->getMessage()], 404);
        }
    }

    public function show($id)
    {
        try {
            $product = \App\Models\Product::with('dates')->findOrFail($id);

            if($product->company_id == auth('api')->user()->company_id) {            
                return response()->json(['product' => ProductResource::make($product)]);
            } else {
                return response()->json(['msg' => 'Este produto não pertence a sua empresa!'], 401);
            }
        } catch(\Throwable $e) {
            return response()->json(['msg' => $e->getMessage()], 404);
        }
    }
}
