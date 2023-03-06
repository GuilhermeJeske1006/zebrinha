<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Comentario;
use App\Services\VendaService;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\DirectPayment\DirectPaymentService;


class ShopController extends Controller
{

    public function Index($idCategoria = 0){
        $data = [];

        $search = \request('search');
        $listaCategorias = Categoria::all();

        if($search){
            $queryProduto = Produto::where([
                ['nome', 'like', '%'.$search.'%']
            ])->simplePaginate(16);
        }
        else if($idCategoria != 0){
            $queryProduto = Produto::where("categoria_id", $idCategoria)->simplePaginate(16);
        }
        else{
            $queryProduto = Produto::simplePaginate(16);
        }
        $listaProdutos = $queryProduto;

        $carrinho = \Cart::getContent();

        $data["lista"] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idCategoria;
        $data["carrinho"] = $carrinho;
        $data["search"] = $search;


        return view(
            'shop.Index',
            $data);
    }

    public function Check(){
        $user = Auth::user()->id;
        $endereco = DB::select(
            'select * from enderecos where usuario_id = '.$user);
        
        $cep = Endereco::findOrFail($user);

        $carrinho = \Cart::getContent();

        return view('CheckOut.index', [
            'carrinho' => $carrinho,
            'endereco' => $endereco,
            'cep'      => $cep
        ]);
    }

    public function Details($id){
        $produto = Produto::findOrFail($id);

        $comentarios = DB::table('comentarios as P')
                        ->join('users as C', 'C.id', '=', 'P.usuario_id')
                        ->where('P.produto_id', '=', $id)
                        ->get();

        $tamanhos = DB::select(
            'select * from Tamanhos where produto_id =' .$id);

        $Imagens = DB::select(
            'select * from Imagems where produto_id =' .$id);

        $cores = DB::select(
            'select * from Imagems where produto_id =' .$id );

        $carrinho = \Cart::getContent();

        return view('shop.details',
            [
                'produto' => $produto,
                'comentarios' => $comentarios,
                'tamanhos' => $tamanhos,
                'imagens' => $Imagens,
                'carrinho' => $carrinho,
                'cores'   => $cores,
            ]);
    }

    public function Comentar(Request $request){

        $comentario = new Comentario;
        $comentario->descricao = $request->descricao;
        $comentario->usuario_id = $request->usuario_id;
        $comentario->produto_id = $request->produto_id;
        $comentario->estrela    = $request->estrela;

        $comentario->save();

        return redirect()
            ->to(url()->previous())
            ->with('msg', 'Comentado com suceso');
    }


    public function adicionarCarrinho( Request $request){
        //$prod = Produto::find($idProduto);

        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'foto' => $request->foto,
                'tamanho' => $request->tamanho,
                'frete' => $request->frete,
            )
        ]);

        return  redirect()
           ->to(url()->previous());
    }

    public function excluirCarrinho(Request $request){
        $id = $request->id;
        \Cart::remove($id);

        return redirect()
            ->to(url()->previous());

    }

    public function finalizarPedido(Request $request){
        $prods = \Cart::getContent();
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($prods, Auth::user());

        $request->session()->forget('cart');



        return redirect()->route('checkout');
    }

    public function historico(Request $request){
        $carrinho = \Cart::getContent();

        $idUsuario = Auth::user()->id;

        $search = \request('search');

        if($search){

            $listaPedido = DB::table('itens_pedidos as I')
                        ->join('pedidos as P', 'P.id', '=', 'I.pedido_id')
                        ->join('produtos as R', 'R.id', '=', 'I.produto_id')
                        ->where('P.usuario_id', '=', $idUsuario)
                        ->where('R.nome', 'like', '%'.$search.'%')
                        ->simplePaginate(10);
        }
        else {

            $listaPedido = DB::table('itens_pedidos as I')
                        ->join('pedidos as P', 'P.id', '=', 'I.pedido_id')
                        ->join('produtos as R', 'R.id', '=', 'I.produto_id')
                        ->where('P.usuario_id', '=', $idUsuario)
                        ->simplePaginate(10);
        }

        return view('profile.historico',[
            'carrinho' => $carrinho,
            'listaPedido' => $listaPedido,
        ]);
    }

    public function getPagamento(){
        $data = [];
        $itens = \Cart::getContent();
        $user = Auth::user()->id;
        $endereco = DB::select(
            'select * from enderecos where usuario_id = '.$user);

        $data["carrinho"] = $itens;
        $data["endereco"] = $endereco;

        return view('pagamento.index', $data);
    }




}
