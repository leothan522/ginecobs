<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    use HasFactory;
    protected $table = "pacientes_peso";
    protected $fillable = [
        'pacientes_id',
        'peso',
        'fecha'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id', 'id');
    }

    public function control()
    {
        return $this->hasOne(Control::class, 'peso_id', 'id');
    }

    public function historia()
    {
        return $this->hasOne(Historia::class, 'peso_id', 'id');
    }

}
