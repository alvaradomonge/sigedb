<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leccion extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'leccion';
    use HasFactory;

    public function asistencia(){
        return $this->belongsToMany(materia::class,'asistencia_estudiante','id_leccion','id_materia')->withPivot('id_escala_asistencia','fecha_incidente','id_user');
    }
}
