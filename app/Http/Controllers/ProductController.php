<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProduct;
use App\Http\Requests\Products\UpdateProduct;
use App\Http\Requests\SearchRequest;
use App\Models\Date;
use App\Models\Product;
use Exception;
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
        $data = $request->only(['ean', 'description', 'value', 'category_id']);

        $product = auth()->user()->company->products()->create($data);
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
                'graphicData' => $this->getGraphicData($product),
            ];
    
            return view('products.show', $data);
        } else {
            return back()->with('error', 'Produto não encotrado!');
        }
    }

    public function update(UpdateProduct $request, $id)
    {
        try{
            $product = Product::findOrFail($id);
            $product->update($request->only('ean', 'description', 'category_id'));
        
            return back()->with('success', 'Produto atualizado!');
        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
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

    private function getGraphicData($product)
    {
        $data = [];

        foreach($product->dates as $date) {
            $data[$date->date] = [];
            $oldDates = Date::where('date', '=', $date->date)->where('product_id', '=', $product->id)->withTrashed()->orderBy('created_at')->get();
            
            foreach($oldDates as $oldDate) {
                $data[$date->date][] = ["$oldDate->date", $oldDate->amount, 'blue', "$oldDate->amount"];
            }
        }

        return json_encode($data);
    }

    public function search(SearchRequest $request)
    {
        $perPage = session('products.perPage', 4);
        
        $data = [
            'products' => Product::search($request->search, auth()->user()->company->id, $perPage),
            'categories' => auth()->user()->company->categories,
        ];

        return view('products.index', $data);
    }
}
