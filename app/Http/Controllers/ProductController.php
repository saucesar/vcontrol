<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProduct;
use App\Http\Requests\Products\UpdateProduct;
use App\Http\Requests\SearchRequest;
use App\Models\Date;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('products.perPage', $request->perPage);
        $perPage = session('products.perPage', 4);
        $companyId = auth()->user()->company->id;
        
        $data = [
            'products' => $this->productRepository->byCompany($companyId, $perPage),
            'categories' => $this->categoryRepository->byCompany($companyId),
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
        try {
            $product = $this->productRepository->byId($id);

            $data = [
                'product' => $product,
                'categories' => $this->categoryRepository->byCompany(auth()->user()->company->id),
                'graphicData' => $this->getGraphicData($product),
            ];
    
            return view('products.show', $data);
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}");
            return back()->with('error', 'Produto não encotrado!');
        }
    }

    public function update(UpdateProduct $request, $id)
    {
        try{
            $this->productRepository->update($id, $request->only('ean', 'description', 'category_id'));
            return back()->with('success', 'Produto atualizado!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}");
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->productRepository->destroy($id);
            return redirect()->route('products.index')->with('success', 'Produto deletado!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}");
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
            'products' => $this->productRepository->search($request->search, auth()->user()->company->id, $perPage),
            'categories' => $this->categoryRepository->byCompany(auth()->user()->company->id),
        ];

        return view('products.index', $data);
    }
}
