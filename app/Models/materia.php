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
        return $this->belongsTo(user::class,'id');
    }
    public function estados(){
        return $this->belongsTo(estado_materia::class,'id');
    }
    public function libro_notas(){
        return $this->belongsTo(libro_notas::class,'id_libro_notas');
    }
}
