<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ginecostetrico extends Model
{
    use HasFactory;
    protected $table = "ginecostetricos";
    protected $fillable = ['nombre'];

    public function pacientes()
    {
        return $this->hasMany(PaciGine::class, 'ginecostetricos_id', 'id');
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ;
    }

}
