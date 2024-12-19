<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProd extends Model
{
    protected $table = 'prod_venda';
    protected $fillable = [
        'id_produto',
        'id_lote',
		'id_venda',
		'quantidade',
    ];
}
