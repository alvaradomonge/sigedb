<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libro_notas extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'libro_notas';
    use HasFactory;

    public function materia()
    {
        return $this->hasOne(materia::class);
    }
    public function promedio_estudiante(){
        return $this->belongsToMany(user::class,'promedio_estud_libro_cuanti','id_libro_notas','id_estudiante')->withPivot('promedio');
    }
}
