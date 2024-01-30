<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiarioUploads extends Model
{
    use HasFactory;
    protected $table = 'diario_uploads';

    protected $fillable = [
        'diario_id',
        'file',
        'url'
    ];
}
