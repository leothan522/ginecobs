<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio2 extends Model
{
    use HasFactory;
    protected $table = "pacientes_laboratorio_2";
    protected $fillable = [
        'pacientes_id',
        'fecha',
        'hiv',
        'vdrl',
        'anticore',
        'tgo',
        'tpg',
        'ldh',
        'toxo_igm',
        'toxo_igg',
        'tsh',
        't4'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

}
