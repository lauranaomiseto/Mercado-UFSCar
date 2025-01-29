<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProd extends Model
{
    protected $table = 'prod_venda'; // Nome da tabela no banco de dados
    protected $fillable = [
        'id_produto',
        'id_lote',
        'id_venda',
        'quantidade',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produto');
    }
}