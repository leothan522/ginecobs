<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ginecostetrico extends Model
{
    use HasFactory;
    protected $table = "ginecostetricos";
    protected $fillable = ['nombre'];



    public function scopeBuscar($query, $keyword)
    {
        return $query->where('nombre', 'LIKE', "%$keyword%")
            ;
    }
    
}
