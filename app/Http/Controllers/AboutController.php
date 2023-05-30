<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function Index(){
        $carrinho = \Cart::getContent();
        $title = "Sobre nós";

        return view('About.index',
            [
                'carrinho' => $carrinho,
                'title' => $title
            ]);
    }

}
