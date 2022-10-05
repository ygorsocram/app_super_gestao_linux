<?php

namespace App\Http\Controllers;
use \App\Models\SiteContato;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request){
        return view('site.contato');
    }

    public function salvar(Request $request){
        $request->validate([
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'required',
            'motivo' => 'required',
            'mensagem' => 'required',
        ]);
        SiteContato::create($request->all());
        return view('site.contato');
    }
}
