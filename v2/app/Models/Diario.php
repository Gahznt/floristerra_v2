<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    use HasFactory;
    protected $table = 'diario';

    protected $fillable = [
        'obra',
        'local',
        'contratante',
        'contratado',
        'prazo_contratual',
        'prazo_decorrido',
        'nomeconta',
        'condicao_climatica_manha',
        'praticavel_manha',
        'condicao_climatica_tarde',
        'praticavel_tarde',
        'qtd_funcionarios',
        'equipamentos',
        'detalhes_atividades'
    ];

    public function diariosUploads()
    {
        return $this->hasMany(DiarioUploads::class, 'diario_id');
    }
}
