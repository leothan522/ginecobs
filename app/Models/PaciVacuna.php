<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaciVacuna extends Model
{
    use HasFactory;
    protected $table = "pacientes_vacunas";
    protected $fillable = [
        'pacientes_id',
        'vacunas_id',
        'dosis_1',
        'dosis_2',
        'refuerzo'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class, 'vacunas_id', 'id');
    }
}
