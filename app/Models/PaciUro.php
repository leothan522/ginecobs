<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaciUro extends Model
{
    use HasFactory;
    protected $table = "pacientes_uroanalisis";
    protected $fillable = [
        'pacientes_id',
        'fecha',
        'leu',
        'bac',
        'detalles'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

}
