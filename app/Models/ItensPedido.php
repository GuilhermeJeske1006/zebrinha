<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensPedido extends RModel
{
    protected $table = "itens_pedidos";

    protected $fillable = ['quantidade', 'valor', 'dt_item', 'produto_id', 'pedido_id'];
}
