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
    public function rubros(){
        return $this->hasMany(rubro::class,'id_materia');
    }
    public function nota_asignaciones(){
        return $this->belongsToMany(asignacion::class,'nota_estudiante_asignacion','id_materia','id_asig')->withPivot('nota','id_estud','id_rubro_cualit');
    }
    public function estud_asignaciones(){
        return $this->belongsToMany(user::class,'nota_estudiante_asignacion','id_materia','id_estud')->withPivot('nota','id_asig','id_rubro_cualit');
    }
    public function asignaciones()
    {
        return $this->hasManyThrough(asignacion::class, rubro::class,'id_materia','id_rubro');
    }
}
