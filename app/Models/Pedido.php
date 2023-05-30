<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends RModel
{
    protected $table = "pedidos";
    protected $fillable = ['dataPedido', 'reference', 'status'];
}
