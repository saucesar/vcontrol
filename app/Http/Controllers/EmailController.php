<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emails\StoreEmail;
use App\Http\Requests\Emails\UpdateEmail;
use App\Http\Requests\SearchRequest;
use App\Repositories\EmailRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    private EmailRepository $emailRepository;

    public function __construct(
        EmailRepository $emailRepository,
    )
    {
        $this->emailRepository = $emailRepository;
    }

    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('email.perPage', $request->perPage);
        $perPage = session('email.perPage', 5);
        $company = $this->getCompanyInSession();
        
        $data = [
            'emails' => $this->emailRepository->byCompany($company->id, $perPage),
            'company' => $company,
        ];

        return view('emails.index', $data);
    }

    public function store(StoreEmail $request)
    {
        try {
            $company = $this->getCompanyInSession();
            $data = $request->only(['name', 'email']);
            $data['company_id'] = $company->id;
            $this->emailRepository->store($data);
    
            return back()->with('success', 'Email adicionado!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}", ['request' => $request->all()]);
            return back()->with('error', 'Falhas ao adicionar email!');
        }
    }

    public function update(UpdateEmail $request, $id)
    {
        try {
            $this->emailRepository->update($id, $request->only('name', 'email'));

            return back()->with('success', 'Email atualizado!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}", ['request' => $request->all()]);
            return back()->with('error', 'Email não econtrado!');
        }
    }

    public function destroy($id)
    {
        try {
            $this->emailRepository->destroy($id);

            return back()->with('emails.index')->with('success', 'Email deletado!');
        } catch(Exception $e) {
            Log::error("Exception: ".(get_class($e)).": {$e->getMessage()}");
            return back()->with('error', 'Email não econtrado!');
        }
    }

    public function search(SearchRequest $request)
    {
        $perPage = session('email.perPage', 5);
        $company = $this->getCompanyInSession();

        $data = [
            'emails' => $this->emailRepository->search($request->search, $company->id, $perPage),
            'company' => $company,
        ];
        
        return view('emails.index', $data);
    }
}
