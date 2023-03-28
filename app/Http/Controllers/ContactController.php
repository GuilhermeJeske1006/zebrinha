<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Index(){

        $carrinho = \Cart::getContent();

        return view('Contact.index', [
            'carrinho' => $carrinho
        ]);
    }
}
