<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;
    protected $table = "pacientes_control";
    protected $fillable = [
        'pacientes_id',
        'fecha',
        'edad_gestacional',
        'peso_id',
        'ta',
        'au',
        'pres',
        'fcf',
        'mov_fetales',
        'du',
        'edema',
        'sintomas',
        'observaciones',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

    public function peso()
    {
        return $this->belongsTo(Peso::class, 'peso_id', 'id');
    }

}
