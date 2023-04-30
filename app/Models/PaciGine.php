<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaciGine extends Model
{
    use HasFactory;
    protected $table = "pacientes_ginecostetricos";
    protected $fillable = [
        'pacientes_id',
        'ginecostetricos_id',
        'detalles',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

    public function ginecostetrico()
    {
        return $this->belongsTo(Ginecostetrico::class, 'ginecostetricos_id', 'id');
    }
}
