<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'materia';
    use HasFactory;

    //crear modelo y dependencias de la tabla grupo_guia
    public function grupo_guia(){
        return $this->belongsTo(grupo_guia::class,'id_grupo_guia');
    }
    public function docentes(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function estados(){
        return $this->belongsTo(estado_materia::class,'id_estado');
    }
     public function categoria(){
        return $this->belongsTo(categoria_materia::class,'id_categoria_materia');
    }
    public function promedio_estudiante(){
        return $this->belongsToMany(user::class,'promedio_estud_materia_cuanti','id_materia','id_estudiante')->withPivot('promedio');
    }
}
