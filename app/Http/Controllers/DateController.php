<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dates\StoreDate;
use App\Http\Requests\Dates\UpdateDate;
use App\Models\Date;

class DateController extends Controller
{
    public function store(StoreDate $request)
    {
        $date = Date::create($request->only(['date', 'lote', 'amount', 'product_id', 'value']));

        if(isset($date)) {
            return back()->with('success', 'Data adicionada!');
        } else {
            return back()->with('error', 'Falha ao salvar data!');
        }
    }

    public function update(UpdateDate $request, $id)
    {
        $oldDate = Date::find($id);

        if(isset($oldDate)) {
            $data = $request->only(['amount', 'lote', 'reason_id']);
            $data['date'] = $oldDate->date;
            //$data['previous_id'] = $oldDate->id;
            //$data['product_id'] = $oldDate->product_id;
            
            $newDate = Date::create($data);
            
            if(isset($newDate)) {
                $oldDate->delete();
                return back()->with('success', 'Data atualizada!');
            } else {
                return back()->with('error', 'Erro ao atualizar data!');
            }
        } else {
            return back()->with('error', 'Data não encontrada!');
        }
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
