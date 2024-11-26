<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'produto';
    protected $fillable = [
        'descricao',
        'preco'
    ];
}
