<?php

namespace App\Services;
use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class VendaService {

    public function finalizarVenda($prods = [], User $user){
        try {
            DB::beginTransaction();
            $dtHoje = new \DateTime();

            $pedido = new Pedido();

            $pedido->dataPedido = $dtHoje->format('y-m-d H:i:s');
            $pedido->status = "PEN";
            $pedido->usuario_id = Auth::user()->id;

            $pedido->save();
            foreach ($prods as $p){
                $itens = new ItensPedido();

                $itens->quantidade = $p->quantity;
                $itens->valor = $p->price;
                $itens->dt_item = $dtHoje->format('y-m-d H:i:s');
                $itens->produto_id = $p->id;
                $itens->pedido_id = $pedido->id;
                $itens->save();

                
            }
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            Log::error("erro:venda service", ['message' => $e->getMessage()]);
        }
    }
}
