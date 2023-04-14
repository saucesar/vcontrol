<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Company\StoreCompany;
use App\Models\Company;
use Exception;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company.index', [
            'companies' => Auth::user()->companies,
        ]);
    }

    public function selectCompany(Request $request)
    {
        $company = Company::find($request->company_id);
        $this->setCompanyInSession($company);

        return redirect()->back()->with('success', "Você selecionou a empresa {$company->name}");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $request->merge(['owner_id' => Auth::user()->id]);
        $data = $request->all();
        $data['cnpj'] = str_replace(['.', '-', '/'], '', $data['cnpj']);
        
        Company::create($data);
        return redirect()->route('company.index')->with('success', 'Empresa criada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {
            Company::findOrFail($id)->delete();
            
            return redirect()->route('company.index')->with('success', 'Empresa removida!');
        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}