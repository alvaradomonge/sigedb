<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacion extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'asignacion';
    use HasFactory;

    public function rubro(){
        return $this->belongsTo(rubro::class,'id_rubro');
    }
    public function nota(){
        return $this->belongsToMany(user::class,'nota_estudiante_asignacion','id_estud','id_asig')->withPivot('nota','id_rubro_cualit');
    }
    // public function estudiantes(){
    //     return $this->belongsToMany(user::class,'rel_estud_materia_rubro_asig','id_asig','id_estud','id_materia')->withPivot('nota','id_rubro_cualit');
    // }
}
