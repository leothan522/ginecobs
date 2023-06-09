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

    public function ginecostetricos()
    {
        return $this->hasMany(PaciGine::class, 'pacientes_id', 'id');
    }

    public function control()
    {
        return $this->hasMany(Control::class, 'pacientes_id', 'id');
    }

    public function laboratorio1()
    {
        return $this->hasMany(Laboratorio1::class, 'pacientes_id', 'id');
    }

    public function laboratorio2()
    {
        return $this->hasMany(Laboratorio2::class, 'pacientes_id', 'id');
    }

    public function uroanalisis()
    {
        return $this->hasMany(PaciUro::class, 'pacientes_id', 'id');
    }

    public function historia()
    {
        return $this->hasMany(Historia::class, 'pacientes_id', 'id');
    }

    public function tabla()
    {
        return $this->hasMany(PaciTabla::class, 'pacientes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ->orWhere('cedula', 'LIKE', "%$keyword%")
            ;
    }


}
