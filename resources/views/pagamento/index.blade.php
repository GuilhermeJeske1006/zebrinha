@php
    use App\Models\Pedido;
    use Illuminate\Support\Facades\DB;
    use Darryldecode\Cart\Cart;

        include_once("../PagSeguroLibrary/PagSeguroLibrary.php");
            $notificationCode = $_POST['notificationCode'];
            //$notificationCode = 'F950D28E10911091E58BB47DBF9A877203E8';
            try {


                $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
                $response = PagSeguroNotificationService::checkTransaction(
                    $credentials,
                    $notificationCode
            );

                $reference = $response->getReference();
                $status = $response->getStatus()->getTypeFromValue();
                $usuario_id = $response->getParameter('usuario_id');

                //WAITING_PAYMENT-PAID-AVAILABLE-IN_DISPUTE-CANCELLED-REFUNDED
                switch($status){
                    case "WAITING_PAYMENT":


                        $pedido_id = DB::table('pedidos')->insertGetId([
                            'status' => $status,
                            'reference' => $reference,
                            'dataPedido' => now(),
                            'usuario_id' => $usuario_id,
                        ]);

                        $items = $response->getItems();
                        foreach ($items as $item) {
                            if ($item->getId() != 0000){
                                DB::table('itens_pedidos')->insert([
                                'pedido_id' => $pedido_id,
                                'produto_id' => $item->getId(),
                                'quantidade' => $item->getQuantity(),
                                'valor' => $item->getAmount(),
                                'dt_item' => now(),
                            ]);
                            }
                        };
                        echo 'WAITING_PAYMENT';
                        break;


                   case "PAID":
                        $reference = $response->getReference();

                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'PAID']);


                        echo 'PAID - Pedido ID: ' . $pedido_id;
                        break;

                    case "AVAILABLE":
                        $reference = $response->getReference();

                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'AVAILABLE']);

                        // Output the order ID
                        echo 'PAID - Pedido ID: ' . $pedido_id;
                        break;


                    case "IN_DISPUTE":
                         $reference = $response->getReference();

                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'IN_DISPUTE']);

                        // Output the order ID
                        echo 'IN_DISPUTE - Pedido ID: ' . $pedido_id;
                        break;

                    case "CANCELLED":
                        $reference = $response->getReference();

                        $pedido = DB::table('pedidos')->where('reference', $reference)->first();
                        $pedido_id = $pedido->id;

                        DB::table('pedidos')
                            ->where('id', $pedido_id)
                            ->update(['status' => 'CANCELLED']);

                        // Output the order ID
                        echo 'CANCELLED - Pedido ID: ' . $pedido_id;
                        break;

                    case "REFUNDED":
                        $reference = $response->getReference();

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

@endphp
