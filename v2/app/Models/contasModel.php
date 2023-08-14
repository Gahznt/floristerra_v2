<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contasModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'contas';

    protected $fillable = [
        'nomeconta',
        'vencimento',
        'valor',
        'boleto',
        'paga',
        'observacao'
    ];
}
