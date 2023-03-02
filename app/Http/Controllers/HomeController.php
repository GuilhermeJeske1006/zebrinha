<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = [];
        $listaProdutos = Produto::limit(16)->get();
        $data["lista"] = $listaProdutos;
        //$carrinho = session('cart', []);
        $carrinho = \Cart::getContent();
        $data["carrinho"] = $carrinho;

        return view('index', $data);
    }



}
