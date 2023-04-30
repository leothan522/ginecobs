<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    use HasFactory;
    protected $table = "vacunas";
    protected $fillable = ['nombre'];



    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ;
    }

    public function pacientes()
    {
        return $this->hasMany(PaciVacuna::class, 'vacunas_id', 'id');
    }

}
