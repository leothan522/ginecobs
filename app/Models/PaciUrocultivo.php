<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaciUrocultivo extends Model
{
    use HasFactory;
    protected $table = "pacientes_urocultivos";
    protected $fillable = [
        'pacientes_id',
        'fecha',
        'detalles'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }
}
