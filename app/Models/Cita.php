<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'fecha_hora',
        'motivo',
        'estado',
        'notas',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
