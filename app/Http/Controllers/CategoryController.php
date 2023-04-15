<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategory;
use App\Http\Requests\Categories\UpdateCategory;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\EmailRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;
    private EmailRepository $emailRepository;
    private ProductRepository $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        EmailRepository $emailRepository,
        ProductRepository $productRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->emailRepository = $emailRepository;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('categories.perPage', $request->perPage);
        $perPage = session('categories.perPage', 4);
        $company = $this->getCompanyInSession();
        
        $data = [
            'categories' => $this->categoryRepository->byCompany($company->id, $perPage),
            'emails' => $this->emailRepository->byCompany($company->id),
            'company' => $company,
        ];

        return view('categories.index', $data);
    }

    public function store(StoreCategory $request)
    {
        try{
            $company = $this->getCompanyInSession();

            $data = $request->only('name');
            $data['company_id'] = $company->id;

            $category = $this->categoryRepository->store($data);
            $this->saveEmails($request->emails, $category);
                
            return back()->with('success', 'Categoria adicionada!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}", ['request' => $request->all()]);
            return back()->with('error', 'Falha ao criar categoria!');
        }
    }

    public function show(Request $request, $id)
    {
        try {
            !$request->perPage ? : session()->put('products.perPage', $request->perPage);
            $perPage = session('products.perPage', 4);
            $category = $this->categoryRepository->byId($id);
            $company = $this->getCompanyInSession();

            if($company->id != $category->company_id) {
                return redirect()->route('categories.index');
            }

            $data = [
                'category' => $category,
                'products' => $this->productRepository->byCategory($id, $perPage),
                'emails' => $this->emailRepository->byCompany($company->id),
            ];

            return view('categories.show', $data);
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}", ['request' => $request->all()]);
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function update(UpdateCategory $request, $id)
    {
        try{
            $category = $this->categoryRepository->update($id, $request->only('name'));
            $this->saveEmails($request->emails, $category);
            
            return back()->with('success', 'Categoria atualizada!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}", ['request' => $request->all()]);
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    public function destroy(Request $request, $id)
    {
        try{
            $this->categoryRepository->destroy($id);
            
            if(isset($request->redirect)) {
                return redirect()->route($request->redirect)->with('success', 'Categoria deletada!');
            }

            return back()->with('success', 'Categoria deletada!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}", ['request' => $request->all()]);
            return back()->with('error', 'Categoria não encontrada!');
        }
    }

    private function saveEmails(array $emailIds, Category $category)
    {
        $this->emailRepository->disassossiateAllEmails($category->id);
        $this->emailRepository->assossiateEmails($emailIds, $category->id);
    }

    public function search(SearchRequest $request)
    {
        $perPage = session('categories.perPage', 4);
        $company = $this->getCompanyInSession();

        $data = [
            'categories' => $this->categoryRepository->search($request->input('search', ''), $company->id, $perPage),
            'emails' => $this->emailRepository->byCompany($company->id),
        ];

        return view('categories.index', $data);
    }
}
