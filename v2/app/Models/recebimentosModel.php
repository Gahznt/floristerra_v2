<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recebimentosModel extends Model
{
    use HasFactory;
    protected $table = 'recebimentos';

    protected $fillable = [
        'pagador',
        'valor',
        'desc',
        'status_pagamento',
    ];
}
