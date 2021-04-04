<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategory;
use App\Http\Requests\Categories\UpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('categories.perPage', $request->perPage);
        $perPage = session('categories.perPage', 5);
        
        $data = [
            'categories' => Category::byCompany(auth()->user()->company->id, $perPage),
        ];

        return view('categories.index', $data);
    }

    public function store(StoreCategory $request)
    {
        $data = $request->only('name');
        $data['company_id'] = auth()->user()->company->id;

        $category = Category::create($data);

        if(isset($category)) {
            return back()->with('success', 'Categoria adicionada!');
        } else {
            return back()->with('error', 'Falha ao criar categoria!');
        }
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(isset($category)) {
            $data = [
                'category' => $category,
            ];
            return view('categories.show', $data);
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function update(UpdateCategory $request, $id)
    {
        $category = Category::find($id);

        if(isset($category)) {
            $category->update($request->only('name'));
            return back()->with('success', 'Categoria atualizada!');
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(isset($category)) {
            $category->delete();
            return back()->with('success', 'Categoria deletada!');
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }
}
