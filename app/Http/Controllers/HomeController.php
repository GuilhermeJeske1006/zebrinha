<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = [];
        $listaProdutos = Produto::limit(16)->get();
        $title = "Home";
        $data["lista"] = $listaProdutos;
        $carrinho = \Cart::getContent();

        $data["carrinho"] = $carrinho;
        $data["title"] = $title;

        return view('index', $data);
    }



}
