<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Index(){
        $carrinho = \Cart::getContent();

        return view('contact.index', [
            'carrinho' => $carrinho
        ]);
    }
}
