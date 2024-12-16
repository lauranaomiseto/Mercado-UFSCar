<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'venda';
    protected $fillable = [
        'id',
        'timestamp'
    ];
}