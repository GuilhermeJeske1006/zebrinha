<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Switch_;

class Pedido extends RModel
{
    protected $table = "pedidos";
    protected $dates = ["datapedido"];
    protected $fillable = ['datapedido', 'status', 'usuario_id'];

    public function statusDesc(){
        $desc = "";
        Switch($this->status){
            case 'PEN' : $desc = "PENDENTE";break;
            case 'APR' : $desc = "APROVADO"; break;
            case 'CAN' : $desc = "Cancelado"; break;
        }
        return $desc;
    }
}
