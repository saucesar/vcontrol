<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emails\StoreEmail;
use App\Http\Requests\Emails\UpdateEmail;
use App\Http\Requests\SearchRequest;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        !$request->perPage ? : session()->put('email.perPage', $request->perPage);
        $perPage = session('email.perPage', 5);
        
        $data = [
            'emails' => Email::byCompany(auth()->user()->company->id, $perPage),
        ];

        return view('emails.index', $data);
    }

    public function store(StoreEmail $request)
    {
        $data = $request->only(['name', 'email']);
        $data['company_id'] = auth()->user()->company->id;

        $email = Email::create($data);

        if(isset($email)) {
            return back()->with('success', 'Email adicionado!');
        } else {
            return back()->with('error', 'Falhas ao adicionar email!');
        }
    }

    public function update(UpdateEmail $request, $id)
    {
        $email = Email::find($id);

        if(isset($email)) {
            $email->update($request->only('name', 'email'));
            return back()->with('success', 'Email atualizado!');
        } else {
            return back()->with('error', 'Email não econtrado!');
        }
    }

    public function destroy($id)
    {
        $email = Email::find($id);

        if(isset($email)) {
            $email->delete();
            return back()->with('emails.index')->with('success', 'Email deletado!');
        } else {
            return back()->with('error', 'Email não econtrado!');
        }
    }

    public function search(SearchRequest $request)
    {
        $perPage = session('email.perPage', 5);

        $data = [
            'emails' => Email::search($request->search, auth()->user()->company->id, $perPage),
        ];
        
        return view('emails.index', $data);
    }
}
