<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Index(){

        $carrinho = \Cart::getContent();
        $title = "Contato";


        return view('Contact.index', [
            'title' => $title,
            'carrinho' => $carrinho
        ]);
    }
}
