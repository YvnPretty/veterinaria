<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medicos';

    protected $fillable = [
        'paciente_id',
        'veterinario_id',
        'fecha',
        'diagnostico',
        'tratamiento',
        'medicamentos',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }
}
