<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesa;
use Illuminate\Support\Facades\Auth;

class ControladorDespesa extends Controller
{
    public function index()
    {
        $des = Despesa::where('users_id', '=', Auth::user()->id)->get();
        return view('despesas', compact('des'));
    }

    public function create()
    {
        return view('novadespesa');
    }

    public function store(Request $request)
    {
        if ($request->input('valorDespesa') != null && $request->input('tipoDespesa') != null) {
            $des = new Despesa();
            $des->valor = $request->input('valorDespesa');
            $des->tipo_despesa = $request->input('tipoDespesa');
            $des->users_id = Auth::user()->id;
            $des->save();
        }
        return redirect('/despesas');
    }

    public function edit($id)
    {
        $des = Despesa::find($id);
        if (isset($des)) {
            return view('editardespesa', compact('des'));
        }
        return redirect('/despesas');
    }

    public function update(Request $request, $id)
    {
        $des = Despesa::find($id);
        if (isset($des)) {
            $des->valor = $request->input('valorDespesa');
            $des->tipo_despesa = $request->input('tipoDespesa');
            $des->users_id = Auth::id();
            $des->save();
        }
        return redirect('/despesas');
    }

    public function destroy($id)
    {
        $des = Despesa::find($id);
        if (isset($des)) {
            $des->delete();
        }
        return redirect('/despesas');
    }
}
