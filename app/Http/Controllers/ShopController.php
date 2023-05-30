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

    public function index(Request $request, $idCategoria = 0)
    {
        $search = $request->input('search');
        $precoMinimo = $request->input('preco_minimo');
        $precoMaximo = $request->input('preco_maximo');
        $itens = Produto::query();

        if ($precoMinimo !== null) {
            $itens->where('valor', '>=', $precoMinimo);
        }

        if ($precoMaximo !== null) {
            $itens->where('valor', '<=', $precoMaximo);
        }

        if ($idCategoria !== 0) {
            $itens->where('categoria_id', $idCategoria);
        }

        if ($search !== null) {
            $itens->where('nome', 'like', '%' . $search . '%');
        }

        $listaProdutos = $itens->simplePaginate(16);
        $listaCategorias = Categoria::all();
        $carrinho = \Cart::getContent();
        $title = "Produtos - Zebrinha Kids";


        return view('shop.index', [
            'lista' => $listaProdutos,
            'listaCategoria' => $listaCategorias,
            'idcategoria' => $idCategoria,
            'carrinho' => $carrinho,
            'search' => $search,
            'title' => $title
        ]);
    }

    public function Check(){
        $user = Auth::user()->id;
        $endereco = DB::select(
            'select * from enderecos where usuario_id = '.$user);

        $cep = DB::table('enderecos')
        ->where('usuario_id', $user)
        ->first();




        $carrinho = \Cart::getContent();
        $produtos_json = $carrinho->toJson();
        $title = "Checkout - Zebrinha Kids";

    


        return view('CheckOut.index', [
            'carrinho' => $carrinho,
            'endereco' => $endereco,
            'cep'      => $cep,
            'produtos_json' => $produtos_json,
            'title' => $title
        ]);
    }

    public function Details($id){
        $produto = Produto::findOrFail($id);

        $comentarios = DB::table('comentarios as P')
                        ->join('users as C', 'C.id', '=', 'P.usuario_id')
                        ->where('P.produto_id', '=', $id)
                        ->get();

        $tamanhos = DB::select(
            'select * from tamanhos where produto_id =' .$id);

        $Imagens = DB::select(
            'select * from imagems where produto_id =' .$id);

        $cores = DB::select(
            'select * from cors where produto_id =' .$id );

        $carrinho = \Cart::getContent();

        $title = $produto->nome;


        return view('shop.details',
            [
                'produto' => $produto,
                'comentarios' => $comentarios,
                'tamanhos' => $tamanhos,
                'imagens' => $Imagens,
                'carrinho' => $carrinho,
                'cores'   => $cores,
                'title' => $title,
            ]);
    }

    public function Comentar(Request $request){

        $comentario = new Comentario;
        $comentario->descricao = $request->descricao;
        $comentario->usuario_id = $request->usuario_id;
        $comentario->produto_id = $request->produto_id;
        $comentario->estrela    = $request->estrela;

        try {
            DB::beginTransaction();
            $comentario->save();
            DB::commit();

            return back()->with('success','Comentário feito com sucesso!!');

        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','Erro ao fazer comentário. Tente novamente!');
        }
    }


    public function adicionarCarrinho( Request $request){

            $unique_id = uniqid();
            \Cart::add([
                'id' => $unique_id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'foto' => $request->foto,
                    'tamanho' => $request->tamanho,
                    'frete' => $request->frete,
                    'produtoId'   => $request->produtoId,
                    'cor' => $request->cor,

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

    public function finalizarPedido(){

        $prods = \Cart::getContent();
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($prods, Auth::user());

       \Cart::clear();

        return redirect()->route('index');
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
                        ->orderBy('P.id', 'Desc')
                        ->simplePaginate(10);
        }
        else {

            $listaPedido = DB::table('itens_pedidos as I')
                        ->join('pedidos as P', 'P.id', '=', 'I.pedido_id')
                        ->join('produtos as R', 'R.id', '=', 'I.produto_id')
                        ->where('P.usuario_id', '=', $idUsuario)
                        ->orderBy('P.id', 'Desc')
                        ->simplePaginate(10);

        }

        $title = "Histórico de compras";


        return view('profile.historico',[
            'carrinho' => $carrinho,
            'listaPedido' => $listaPedido,
            'title' => $title,
        ]);
    }

    public function getPagamento(){

        $carrinho = \Cart::getContent();
        $title = "";

        


        return view('pagamento.index',
        [
            'carrinho' => $carrinho,
            'title' => $title
        ]);
    }

    public function pagamentoPix(){

        $carrinho = \Cart::getContent();
        $title = "";


        return view('pagamento.pix',
        [
            'carrinho' => $carrinho,
            'title' => $title
        ]);
    }

    public function tamanhosParaCor($cor, $produto_id)
    {
        // Busca os tamanhos para a cor especificada
        $tamanhos = DB::table('tamanhos')
            ->join('cors', 'tamanhos.cor_id', '=', 'cors.id')
            ->join('produtos', 'cors.produto_id', '=', 'produtos.id')
            ->select('tamanhos.tamanho', 'tamanhos.qtdTamanho')
            ->where('cors.cor', '=', $cor)
            ->where('produtos.id', '=', $produto_id)
            ->get();


        // Retorna os tamanhos como um array em JSON
        return response()->json($tamanhos);
    }


    public function pagamento(){
        $user = Auth::user()->id;
        $endereco = DB::select(
            'select * from enderecos where usuario_id = '.$user);

        $cep = DB::table('enderecos')
        ->where('usuario_id', $user)
        ->first();
        
        $curl = curl_init();

        $curl = curl_init();

        $data = array(
            "type" => "card"
        );
        
        $payload = json_encode($data);
        
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://sandbox.api.pagseguro.com/public-keys",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer 3EADF66FE76B407894FC414D33893228",
                "Content-Type: application/json",
                "Accept: application/json"
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        $carrinho = \Cart::getContent();
        $produtos_json = $carrinho->toJson();
        $title = "Checkout - Zebrinha Kids";


        return view('CheckOut.payModal', [
            'response'  => json_decode($response, true),
            'carrinho' => $carrinho,
            'endereco' => $endereco,
            'cep'      => $cep,
            'produtos_json' => $produtos_json,
            'title' => $title
        ]);
    }

}
