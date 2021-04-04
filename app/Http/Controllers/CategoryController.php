<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategory;
use App\Http\Requests\Categories\UpdateCategory;
use App\Models\Category;
use App\Models\CategoryEmail;
use App\Models\Email;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('categories.perPage', $request->perPage);
        $perPage = session('categories.perPage', 5);
        
        $data = [
            'categories' => Category::byCompany(auth()->user()->company->id, $perPage),
            'emails' => Email::byCompany(auth()->user()->company->id),
        ];

        return view('categories.index', $data);
    }

    public function store(StoreCategory $request)
    {
        $data = $request->only('name');
        $data['company_id'] = auth()->user()->company->id;

        $category = Category::create($data);

        if(isset($category)) {
            $this->saveEmails($request, $category);
            
            return back()->with('success', 'Categoria adicionada!');
        } else {
            return back()->with('error', 'Falha ao criar categoria!');
        }
    }

    public function show(Request $request, $id)
    {
        $category = Category::find($id);

        !$request->perPage ? : session()->put('products.perPage', $request->perPage);
        $perPage = session('products.perPage', 10);

        if(isset($category)) {
            $data = [
                'category' => $category,
                'products' => Product::byCategory($id, $perPage),
                'emails' => Email::byCompany(auth()->user()->company->id),
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
            $this->saveEmails($request, $category);
            $category->update($request->only('name'));
            return back()->with('success', 'Categoria atualizada!');
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function destroy(Request $request,$id)
    {
        $category = Category::find($id);

        if(isset($category)) {
            $category->delete();
            
            if(isset($request->redirect)) {
                return redirect()->route($request->redirect)->with('success', 'Categoria deletada!');
            } else {
                return back()->with('success', 'Categoria deletada!');
            }
        } else {
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    private function saveEmails($request, $category)
    {
        DB::table('category_emails')->where('category_id', '=', $category->id)->delete();

        foreach($request->emails as $emailId) {
            CategoryEmail::create(['category_id' => $category->id, 'email_id' => $emailId]);
        }
    }
}
