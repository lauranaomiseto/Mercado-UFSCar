<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'lote';
    protected $fillable = [
        'id_produto',
        'quantidade',
        'validade'
    ];
}
