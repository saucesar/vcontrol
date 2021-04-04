<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emails\StoreEmail;
use App\Http\Requests\Emails\UpdateEmail;
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
