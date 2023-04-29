<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;
    protected $table = "antecedentes";
    protected $fillable = [
        'nombre',
        'familiares',
        'personales',
        'otros',
    ];

    public function pacientes()
    {
        return $this->hasMany(PaciAnte::class, 'antecedentes_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ;
    }

}
