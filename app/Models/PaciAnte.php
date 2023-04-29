<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaciAnte extends Model
{
    use HasFactory;
    protected $table = "pacientes_antecedentes";
    protected $fillable = [
        'pacientes_id',
        'antecedentes_id',
        'valor',
        'detalles',
        'familiares',
        'personales',
        'otros'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

    public function antecedente()
    {
        return $this->belongsTo(PaciAnte::class, 'antecedentes_id', 'id');
    }

}
