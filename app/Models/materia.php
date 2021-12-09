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
    public function grupos_guias(){
        return $this->belongsTo(grupo_guia::class,'id_grupo_guia');
    }
    public function docentes(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function estados(){
        return $this->belongsTo(estado_materia::class,'id_estado');
    }
    public function libro_notas(){
        return $this->belongsTo(libro_notas::class,'id_libro_notas');
    }
    public function agregarLibro(materia $materia,libro_notas $id_libro){
        $materia=materia::findOrFail($materia->id);
        $materia->id_libro_notas=$id_libro->id;

    }
}
