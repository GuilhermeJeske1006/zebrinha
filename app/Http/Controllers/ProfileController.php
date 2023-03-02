<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function Perfil(){
        $carrinho = \Cart::getContent();
        $idUsuario = Auth::user()->id;
        $usuario = User::findOrfail($idUsuario);


        return view('profile.perfil', [
            'carrinho' => $carrinho,
            'usuario' => $usuario
        ]);
    }
    public function editPerfil(Request $request){

        User::findOrFail($request->id)->update($request->all());
        return redirect()->route('perfil');

    }
}
