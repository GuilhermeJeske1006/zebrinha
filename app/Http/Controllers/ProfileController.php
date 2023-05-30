<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Newsletter;

class ProfileController extends Controller
{
    public function Perfil(){
        $carrinho = \Cart::getContent();
        $idUsuario = Auth::user()->id;
        $usuario = User::findOrfail($idUsuario);
        $title = "Perfil";



        return view('profile.perfil', [
            'carrinho' => $carrinho,
            'usuario' => $usuario,
            'title' => $title
        ]);
    }
    public function editPerfil(Request $request){

        User::findOrFail($request->id)->update($request->all());
        return redirect()->route('perfil');

    }

    public function enviarNewsletter(Request $request){
        $Newsletter = new Newsletter();
        $Newsletter->email = $request->email;
        $Newsletter->save();

        return redirect()->route('index');
    }
}
