<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promedio_estud_libro_cuanti extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'promedio_estud_libro_cuanti';
    use HasFactory;

    // public function estudiante(){
    //     return $this->belongsToMany(user::class,'id_estudiante');
    // }
    // public function libro_notas(){
    //     return $this->belongsToMany(libro_notas::class,'id_libro_notas');
    // }
}
