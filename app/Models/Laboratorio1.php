<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio1 extends Model
{
    use HasFactory;
    protected $table = "pacientes_laboratorio_1";
    protected $fillable = [
        'pacientes_id',
        'fecha',
        'hb',
        'leuco',
        'plaqueta',
        'glicemia',
        'urea',
        'crea',
        'ac_urico',
        'tp',
        'tpt',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

}
