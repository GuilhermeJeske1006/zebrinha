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

            //return [ 'status' => 'Ok', 'message' => 'Endereço cadastrado com sucesso!'];
            return redirect()
                ->to(url()->previous());
        }catch (\Exception $e){
            DB::rollBack();
            return [ 'status' => 'err', 'message' => 'Erro ao cadastrar endereço!'];

        }

//        return redirect()
//            ->to(url()->previous());
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

            //return [ 'status' => 'Ok', 'message' => 'Endereço cadastrado com sucesso!'];
            return redirect()
                ->to(url()->previous());
        }catch (\Exception $e){
            DB::rollBack();
            return [ 'status' => 'err', 'message' => 'Erro ao cadastrar endereço!'];

        }
    }

}
