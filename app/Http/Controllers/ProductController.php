<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProduct;
use App\Http\Requests\Products\UpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('products.perPage', $request->perPage);
        $perPage = session('products.perPage', 4);
        
        $data = [
            'products' => Product::byCompany(auth()->user()->company->id, $perPage),
            'categories' => auth()->user()->company->categories,
        ];

        return view('products.index', $data);
    }

    public function store(StoreProduct $request)
    {
        $data = $request->only(['ean', 'description', 'category_id']);
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
                'categories' => auth()->user()->company->categories,
            ];
    
            return view('products.show', $data);
        } else {
            return back()->with('error', 'Produto não encotrado!');
        }
    }

    public function update(UpdateProduct $request, $id)
    {
        $product = Product::find($id);
        
        if(isset($product)) {
            $product->update($request->only('ean', 'description', 'category_id'));
            return back()->with('success', 'Produto atualizado!');
        } else {
            return back()->with('error', 'Produto não encotrado!');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Produto deletado!');
        } else {
            return back()->with('error', 'Produto não encotrado!');
        }
    }
}
