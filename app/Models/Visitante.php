<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;
    protected $table = 'visitante';
    public $timestamps = false;

    protected $fillable = [
        'nombres','apellidos','tipoDocumento','numeroDocumento','motivoVisita',
    ];
}
