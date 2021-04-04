<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dates\StoreDate;
use App\Models\Date;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function store(StoreDate $request)
    {
        $date = Date::create($request->only(['date', 'lote', 'amount', 'product_id']));

        if(isset($date)) {
            return back()->with('success', 'Data adicionada!');
        } else {
            return back()->with('error', 'Falha ao salvar data!');
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $date = Date::find($id);

        if(isset($date)) {
            $date->delete();
            return back()->with('success', 'Data removida!');
        } else {
            return back()->with('error', 'Data não encontrada!');
        }
    }
}
