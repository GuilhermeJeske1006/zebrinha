<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\Log;
use env;
use Illuminate\Support\Facades\Facade;



class PagSeguroController extends Controller
{
    public function makePayment(Request $request){


        $title ="credito";
        $carrinho = \Cart::getContent();
        $idUsuario = Auth::user()->id;
        $endereco = DB::table('enderecos')->where('usuario_id', $idUsuario)->first();
        $vlrFrete = $_COOKIE['fretevlr'];
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);


        $totalCart = 0;
        foreach($carrinho as $item){
            $totalCart += $item->price * $item->quantity;
        }
        $totalVlr = $totalCart + $vlrFrete;
        $totalVlr = str_replace(",", "", $totalVlr);
        $vlrFrete = str_replace(",", "", $vlrFrete);

        $endpoint = 'https://sandbox.api.pagseguro.com/orders';
            $token = '3EADF66FE76B407894FC414D33893228';

            $body = [
                "reference_id" => "usuarioid_{$idUsuario}_". uniqid(),
                "customer" => [
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "tax_id" => $cpf,
                "phones" => [
                    [
                    "country" => "55",
                    "area" => "11",
                    "number" => "999999999",
                    "type" => "MOBILE"
                    ]
                ]
                ],
                "items" => [
                    [
                        "id" => "0000",
                        "name" => "Frete",
                        "quantity" => 1,
                        "unit_amount" => $vlrFrete * 100
                      ]
                    
                ],

                "shipping" => [
                    "address" => [
                        "street" => $endereco->logradouro,
                        "number" => $endereco->numero,
                        "complement" => $endereco->complemento,
                        "locality" => $endereco->bairro,
                        "city" => $endereco->cidade,
                        "region_code" => $endereco->estado,
                        "country" => "BRA",
                        "postal_code" => str_replace('-', '', $endereco->cep),
                    ]
                    ],
                    "notification_urls" => [
                        "https://zebrinha.gjdesenvolvimento.com.br/checkout/pagamento"
                    ],
                'charges' => [
                    [
                        'reference_id' => "usuarioid_{$idUsuario}_". uniqid(),
                        'description' => 'descricao da cobranca',
                        'amount' => [
                            'value' => $totalVlr * 100,
                            'currency' => 'BRL'
                        ],
                        'payment_method' => [
                            'type' => 'CREDIT_CARD',
                            'installments' => 1,
                            'capture' => true,
                            'card' => [
                                'encrypted' => $request->encrypted,
                                'security_code' => $request->number,
                                'holder' => [
                                    'name' => $request->name,
                                ],
                                'store' => false
                            ]
                        ]
                    ]
                ]
            ];
            

            foreach ($carrinho as $item) {
                $description =  $item->name .' - Cor:  '. $item->attributes->cor . ' - Tamanho: ' . $item->attributes->tamanho. ' - id: '. $item->attributes->produtoId;

                $novoItem = [
                    "name" => $description,
                    "quantity" => $item['quantity'],
                    "unit_amount" => $item['price'] * 100
                ];
                array_push($body['items'], $novoItem);
            }
            

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_CAINFO, "cacert.pem");
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization: Bearer ' . $token
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);

            $response = json_decode($response, true);   
            $error = json_decode($error, true);   
            
            try {
                DB::beginTransaction();
                $dtHoje = now();
            
                $pedido = new Pedido;
                $pedido->dataPedido = $dtHoje;
                $pedido->status = "PAID";
                $pedido->usuario_id = Auth::user()->id;
                if (isset($response['reference_id'])) {
                    $pedido->reference = $response['reference_id'];
                }
                $pedido->save();
            
                foreach ($response['items'] as $item) {
                    if ($item['name'] != "Frete") {
                        $descricao = $item['name'];
                        $tamanho = null;
                        $cor = null;
                        $id = null;
            
                        if (preg_match('/Tamanho: (\S+)/', $descricao, $matches)) {
                            $tamanho = $matches[1];
                        }
            
                        if (preg_match('/Cor:\s*(\S+)/', $descricao, $matches)) {
                            $cor = $matches[1];
                        }
            
                        if (preg_match('/id: (\S+)/', $descricao, $matches)) {
                            $id = $matches[1];
                        }

            
                        DB::table('itens_pedidos')->insert([
                            'pedido_id' => $pedido->id,
                            'produto_id' => $id,
                            'quantidade' => $item['quantity'],
                            'valor' => $item['unit_amount'] / 100,
                            'tamanho' => $tamanho,
                            'cor' => $cor,
                            'dt_item' => $dtHoje,
                        ]);
            
                        if (!is_null($tamanho) && !is_null($cor)) {
                            DB::table('cors')
                                ->join('tamanhos', 'cors.id', '=', 'tamanhos.cor_id')
                                ->where('cors.produto_id', $id)
                                ->where('tamanhos.tamanho', $tamanho)
                                ->where('cors.cor', $cor)
                                ->decrement('tamanhos.qtdTamanho', $item['quantity']);
                        }
                    }
                }
            
                if ($response['charges'][0]['payment_response']['message'] === 'SUCESSO') {
                     DB::commit();
            
                    \Cart::clear();
            
                    return redirect()->route('index')->with('success', $response['charges'][0]['payment_response']['message']);
                }
            
            } catch (\Exception $e) {
                 DB::rollBack();
                // dd($e);
                // Log::error("erro:venda service", ['message' => $e->getMessage()]);
                return back()->with('error', trans($response['error_messages'][0]['description']));
            }


    }


    public function pix(Request $request){


        $title ="Pix";
        $carrinho = \Cart::getContent();
        $idUsuario = Auth::user()->id;
        $endereco = DB::table('enderecos')->where('usuario_id', $idUsuario)->first();
        $vlrFrete = $_COOKIE['fretevlr'];

        $totalCart = 0;
        foreach($carrinho as $item){
            $totalCart += $item->price * $item->quantity;
        }
        $totalVlr = $totalCart + $vlrFrete;
        $totalVlr = str_replace(",", "", $totalVlr);
        $vlrFrete = str_replace(",", "", $vlrFrete);

        $endpoint = 'https://sandbox.api.pagseguro.com/orders';
            $token = '3EADF66FE76B407894FC414D33893228';

            dd($endpoint);
            $body =
            [
                "reference_id" => "usuarioid_{$idUsuario}_". uniqid(),
                "customer" => [
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "tax_id" => "12345678909",
                "phones" => [
                    [
                    "country" => "55",
                    "area" => "11",
                    "number" => "999999999",
                    "type" => "MOBILE"
                    ]
                ]
                ],
                "items" => [
                    [
                        "id" => "0000",
                        "name" => "Frete",
                        "quantity" => 1,
                        "unit_amount" => $vlrFrete * 100
                      ]
                    
                ],

                "qr_codes" => [
                [
                    "amount" => [
                    "value" => $totalVlr * 100
                    ],
                    "expiration_date" => now()->addMinutes(10)->toIso8601String(),
                ]
                ],
                "shipping" => [
                "address" => [
                    "street" => $endereco->logradouro,
                    "number" => $endereco->numero,
                    "complement" => $endereco->complemento,
                    "locality" => $endereco->bairro,
                    "city" => $endereco->cidade,
                    "region_code" => $endereco->estado,
                    "country" => "BRA",
                    "postal_code" => str_replace('-', '', $endereco->cep),
                ]
                ],
                "notification_urls" => [
                    "https://zebrinha.gjdesenvolvimento.com.br/checkout/pagamento"
                ]
            ];

            foreach ($carrinho as $item) {
                $description =  $item->name .' - Cor:  '. $item->attributes->cor . ' - Tamanho: ' . $item->attributes->tamanho. ' - id: '. $item->attributes->produtoId;

                $novoItem = [
                    "name" => $description,
                    "quantity" => $item['quantity'],
                    "unit_amount" => $item['price'] * 100
                ];
                array_push($body['items'], $novoItem);
            }
            

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_CAINFO, "cacert.pem");
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization: Bearer ' . $token
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
            $response = json_decode($response, true);   

            try {
                DB::beginTransaction();
                $dtHoje = now();
            
                $pedido = new Pedido;
                $pedido->dataPedido = $dtHoje;
                $pedido->status = "WAITING_PAYMENT";
                $pedido->usuario_id = Auth::user()->id;
                if (isset($response['reference_id'])) {
                    $pedido->reference = $response['reference_id'];
                }
                $pedido->save();
            
                foreach ($response['items'] as $item) {
                    if ($item['name'] != "Frete") {
                        $descricao = $item['name'];
                        $tamanho = null;
                        $cor = null;
                        $id = null;
            
                        if (preg_match('/Tamanho: (\S+)/', $descricao, $matches)) {
                            $tamanho = $matches[1];
                        }
            
                        if (preg_match('/Cor:\s*(\S+)/', $descricao, $matches)) {
                            $cor = $matches[1];
                        }
            
                        if (preg_match('/id: (\S+)/', $descricao, $matches)) {
                            $id = $matches[1];
                        }

            
                        DB::table('itens_pedidos')->insert([
                            'pedido_id' => $pedido->id,
                            'produto_id' => $id,
                            'quantidade' => $item['quantity'],
                            'valor' => $item['unit_amount'] / 100,
                            'tamanho' => $tamanho,
                            'cor' => $cor,
                            'dt_item' => $dtHoje,
                        ]);
            
                        if (!is_null($tamanho) && !is_null($cor)) {
                            DB::table('cors')
                                ->join('tamanhos', 'cors.id', '=', 'tamanhos.cor_id')
                                ->where('cors.produto_id', $id)
                                ->where('tamanhos.tamanho', $tamanho)
                                ->where('cors.cor', $cor)
                                ->decrement('tamanhos.qtdTamanho', $item['quantity']);
                        }
                    }
                }
            
                     DB::commit();
            
                    \Cart::clear();
            
                    return view('CheckOut.pix', [
                        'response' => $response,
                        'error' => $error,
                        'title' => $title,
                        'carrinho' => $carrinho,
                        
                    ]);
            
            
            } catch (\Exception $e) {
                 DB::rollBack();
                 dd($e->getMessage());
                Log::error("erro:venda service", ['message' => $e->getMessage()]);
                // return back()->with('error', trans($response['error_messages'][0]['description']));
            }


            
    }

    public function boleto(Request $request){

        $title ="Boleto";
        $carrinho = \Cart::getContent();
        $idUsuario = Auth::user()->id;
        $endereco = DB::table('enderecos')->where('usuario_id', $idUsuario)->first();
        $vlrFrete = $_COOKIE['fretevlr'];
        $hoje = Carbon::now();
        $due_date = $hoje->addDays(3)->format('Y-m-d');
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

        $totalCart = 0;
        foreach($carrinho as $item){
            $totalCart += $item->price * $item->quantity;
        }
        $totalVlr = $totalCart + $vlrFrete;
        $totalVlr = str_replace(",", "", $totalVlr);
        $vlrFrete = str_replace(",", "", $vlrFrete);

        $endpoint = 'https://sandbox.api.pagseguro.com/orders';
            $token = '3EADF66FE76B407894FC414D33893228';

            $body =
            array(
                "reference_id" => "usuarioid_{$idUsuario}_". uniqid(),
                "customer" => [
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "tax_id" => $cpf,
                "phones" => [
                    [
                    "country" => "55",
                    "area" => $request->ddd,
                    "number" => $request->phone,
                    "type" => "MOBILE"
                    ]
                ]
                ],
                'items' => array(
                    array(
                        "reference_id" => "usuarioid_{$idUsuario}_". uniqid(),
                        "name" => "Frete",
                        "quantity" => 1,
                        "unit_amount" => $vlrFrete * 100
                    )
                ),
                'shipping' => array(
                    "address" => [
                        "street" => $endereco->logradouro,
                        "number" => $endereco->numero,
                        "complement" => $endereco->complemento,
                        "locality" => $endereco->bairro,
                        "city" => $endereco->cidade,
                        "region_code" => $endereco->estado,
                        "country" => "BRA",
                        "postal_code" => str_replace('-', '', $endereco->cep),
                    ]
                ),
                'notification_urls' => array(
                    "https://zebrinha.gjdesenvolvimento.com.br/checkout/pagamento"
                ),
                'charges' => array(
                    array(
                        'reference_id' => "usuarioid_{$idUsuario}_". uniqid(),
                        'description' => 'cobrança em valor a compra',
                        'amount' => array(
                            'value' => $totalVlr * 100,
                            'currency' => 'BRL'
                        ),
                        'payment_method' => array(
                            'type' => 'BOLETO',
                            'boleto' => array(
                                'due_date' => $due_date,
                                'instruction_lines' => array(
                                    'line_1' => 'Pagamento processado para DESC Fatura',
                                    'line_2' => 'Via PagSeguro'
                                ),
                                'holder' => array(
                                    'name' => Auth::user()->name,
                                    'tax_id' => $request->cpf,
                                    'email' => Auth::user()->email,
                                    'address' => array(
                                        'country' => 'Brasil',
                                        'region' => $endereco->estado,
                                        'region_code' => $endereco->estado,
                                        'city' => $endereco->cidade,
                                        'postal_code' => str_replace('-', '', $endereco->cep),
                                        'street' => $endereco->logradouro,
                                        'number' => $endereco->numero,
                                        'locality' => $endereco->bairro
                                    )
                                )
                            )
                        )
                    )
                )
            );
            

            foreach ($carrinho as $item) {
                $description =  $item->name .' - Cor:  '. $item->attributes->cor . ' - Tamanho: ' . $item->attributes->tamanho. ' - id: '. $item->attributes->produtoId;

                $novoItem = [
                    "reference_id" => $item->attributes->produtoId,
                    "name" => $description,
                    "quantity" => $item['quantity'],
                    "unit_amount" => $item['price'] * 100
                ];
                array_push($body['items'], $novoItem);
            }
            

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_CAINFO, "cacert.pem");
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization: Bearer ' . $token
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            curl_close($curl);
            $response = json_decode($response, true);   

            try {
                DB::beginTransaction();
                $dtHoje = now();
            
                $pedido = new Pedido;
                $pedido->dataPedido = $dtHoje;
                $pedido->status = "WAITING_PAYMENT";
                $pedido->usuario_id = Auth::user()->id;
                if (isset($response['reference_id'])) {
                    $pedido->reference = $response['reference_id'];
                }
                $pedido->save();
            
                foreach ($response['items'] as $item) {
                    if ($item['name'] != "Frete") {
                        $descricao = $item['name'];
                        $tamanho = null;
                        $cor = null;
                        $id = null;
            
                        if (preg_match('/Tamanho: (\S+)/', $descricao, $matches)) {
                            $tamanho = $matches[1];
                        }
            
                        if (preg_match('/Cor:\s*(\S+)/', $descricao, $matches)) {
                            $cor = $matches[1];
                        }
            
                        if (preg_match('/id: (\S+)/', $descricao, $matches)) {
                            $id = $matches[1];
                        }

            
                        DB::table('itens_pedidos')->insert([
                            'pedido_id' => $pedido->id,
                            'produto_id' => $id,
                            'quantidade' => $item['quantity'],
                            'valor' => $item['unit_amount'] / 100,
                            'tamanho' => $tamanho,
                            'cor' => $cor,
                            'dt_item' => $dtHoje,
                        ]);
            
                        if (!is_null($tamanho) && !is_null($cor)) {
                            DB::table('cors')
                                ->join('tamanhos', 'cors.id', '=', 'tamanhos.cor_id')
                                ->where('cors.produto_id', $id)
                                ->where('tamanhos.tamanho', $tamanho)
                                ->where('cors.cor', $cor)
                                ->decrement('tamanhos.qtdTamanho', $item['quantity']);
                        }
                    }
                }
            
                     DB::commit();
            
                    \Cart::clear();
            
                    return view('CheckOut.boleto', [
                        'response' => $response,
                        'error' => $error,
                        'title' => $title,
                        'carrinho' => $carrinho,
        
                        
                    ]);
            
            
            } catch (\Exception $e) {
                 DB::rollBack();
                // Log::error("erro:venda service", ['message' => $e->getMessage()]);
                return back()->with('error', trans($response['error_messages'][0]['description']));
            }


           
    }

}

