<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contasModel extends Model
{
    use HasFactory;
    protected $table = 'contas';

    protected $fillable = [
        'nomeconta',
        'vencimento',
        'valor',
        'boleto',
        'paga'
    ];
}
