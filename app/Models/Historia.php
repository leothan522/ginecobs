<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;
    protected $table = "pacientes_historia";
    protected $fillable = [
        'pacientes_id',
        'fecha',
        'mc',
        'peso_id',
        'ta',
        'mama',
        'cue',
        'zt',
        'cabeza',
        'cuello',
        'torax',
        'abdomen',
        'extremidades',
        'snc',
        'genitales',
        'observacion',
        'plan'
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
