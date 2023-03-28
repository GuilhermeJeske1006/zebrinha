<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdressController extends Controller
{
    public function adicionarEndereco(Request $request){

        $endereco = new Endereco;
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero    = $request->numero;
        $endereco->complemento    = $request->complemento;
        $endereco->logradouro    = $request->logradouro;
        $endereco->usuario_id = $request->usuario_id;
        $endereco->bairro  = $request->bairro;

        try {
            DB::beginTransaction();
            $endereco->save();
            DB::commit();

            return back()->with('success','Endereço cadastrado com sucesso!');

        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','Erro ao cadastrar endereço!');

        }

    }

    public function edit(Request $request)
    {

        $endereco = Endereco::find($request->id);
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero    = $request->numero;
        $endereco->complemento    = $request->complemento;
        $endereco->logradouro    = $request->logradouro;
        $endereco->usuario_id = $request->usuario_id;
        $endereco->bairro  = $request->bairro;

        try {
            DB::beginTransaction();
            $endereco->save();
            DB::commit();
            return back()->with('success','Endereço atualizado com sucesso!');

        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','Erro ao atualizar endereço!');

        }
    }

}
