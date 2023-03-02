<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends RModel
{
    protected $table = "produtos";
    protected $fillable = ['nome', 'foto', 'descricao', 'categoria_id', 'valor'];
}
