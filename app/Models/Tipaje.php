<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipaje extends Model
{
    use HasFactory;
    protected $table = "pacientes_tipajes";
    protected $fillable = [
        'pacientes_id',
        'madre',
        'padre',
        'sensibilidad'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

}
