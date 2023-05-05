<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaciTabla extends Model
{
    use HasFactory;
    protected $table = "pacientes_tabla";
    protected $fillable = [
        'pacientes_id',
        'year',
        'semanas',
        'via',
        'sexo',
        'peso'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }
}
