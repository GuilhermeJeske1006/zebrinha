@php
    use App\Models\Pedido;
    use Illuminate\Support\Facades\DB;
    use Darryldecode\Cart\Cart;

        include_once("../PagSeguroLibrary/PagSeguroLibrary.php");
            $notificationCode = $_POST['code'];
            $url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/${notificationCode}?email=guilhermeieski@gmail.com&token=b6a96588-9307-4e89-8f77-8396919b1172e372748a456d94b3c65b6ec60f8dace92b6e-b93f-47fb-835e-52f3392b639e";

            $headers = array(
                'Content-Type: application/xml'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            curl_close($ch);

            // Verificar se a solicitação foi bem-sucedida
            if ($response === false) {
                echo 'Erro na solicitação';
            } else {
                // Trabalhar com o XML retornado
                $xml = simplexml_load_string($response);

                // Acessar os elementos do XML
                $date = $xml->date;
                $code = $xml->code;
                $type = $xml->type;
                $status = $xml->status;
                $reference = (string) $xml->reference;
                // ... acessar outros elementos conforme necessário

                // Exibir os valores
                echo "Data: " . $date . "<br>";
                echo "Código: " . $code . "<br>";
                echo "Tipo: " . $type . "<br>";
                echo "Status: " . $status . "<br>";


            switch($status){
                case 1:
                    $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                    $pedido_id = $pedido->id;

                    DB::table('pedidos')
                        ->where('id', $pedido_id)
                        ->update(['status' => 'WAITING_PAYMENT']);

                    break;
                   case 2:
                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'Em análise']);

                        // Output the order ID
                        echo 'IN_DISPUTE - Pedido ID: ' . $pedido_id;
                        break;

                case 3:
                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'PAID']);

                        // Output the order ID
                        echo 'IN_DISPUTE - Pedido ID: ' . $pedido_id;
                        break;

                case 4:

                    $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                    $pedido_id = $pedido->id;

                    DB::table('pedidos')
                        ->where('id', $pedido_id)
                        ->update(['status' => 'AVAILABLE']);

                    // Output the order ID
                    echo 'IN_DISPUTE - Pedido ID: ' . $pedido_id;
                    break;


                    case "IN_DISPUTE":
                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'IN_DISPUTE']);

                        // Output the order ID
                        echo 'IN_DISPUTE - Pedido ID: ' . $pedido_id;
                        break;

                    case "CANCELLED":
                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'CANCELLED']);

                        // Output the order ID
                        echo 'CANCELLED - Pedido ID: ' . $pedido_id;
                        break;

                    case "REFUNDED":
                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'REFUNDED']);

                        // Output the order ID
                        echo 'REFUNDED - Pedido ID: ' . $pedido_id;
                }
            } catch (PagSeguroServiceException $e) {
                die($e->getMessage());
            }
            //     
@endphp
