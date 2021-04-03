<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('products.perPage', $request->perPage);
        $perPage = session('products.perPage', 10);
        
        $data = [
            'products' => Product::byCompany(auth()->user()->company->id, $perPage),
        ];

        return view('products.index', $data);
    }

    public function store(StoreProduct $request)
    {
        $data = $request->only(['ean', 'description']);
        $data['company_id'] = auth()->user()->company->id;

        $product = Product::create($data);
        if(isset($product)) {
            return back()->with('success', 'Produto adicionado!');
        } else {
            return back()->with('error', 'Falha ao salvar produto!');
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        if(isset($product)) {
            $data = [
                'product' => $product,
            ];
    
            return view('products.show', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
