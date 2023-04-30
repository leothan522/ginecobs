<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    use HasFactory;
    protected $table = "pacientes";
    protected $fillable = [
        'cedula',
        'nombre',
        'fecha_nac',
        'edad',
        'telefono',
        'direccion',
        'fur',
        'fpp',
        'gestas',
        'partos',
        'cesarias',
        'abortos',
        'peso',
        'grupo'
    ];

    public function peso()
    {
        return $this->hasMany(Peso::class, 'pacientes_id', 'id');
    }

    public function antecedentes()
    {
        return $this->hasMany(PaciAnte::class, 'pacientes_id', 'id');
    }

    public function vacunas()
    {
        return $this->hasMany(Vacuna::class, 'vacunas_id', 'id');
    }

    public function tipaje()
    {
        return $this->hasOne(Tipaje::class, 'pacientes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ->orWhere('cedula', 'LIKE', "%$keyword%")
            ;
    }


}
