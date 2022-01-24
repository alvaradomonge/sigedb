<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupo_guia extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'grupo_guia';
    use HasFactory;

    public function materias()
    {
        return $this->hasMany(materia::class,'id_grupo_guia');
    }

    public function periodo()
    {
        return $this->belongsTo(periodo::class,'id_periodo');
    }

    public function promedio_conducta_estudiantes(){
        return $this->belongsToMany(user::class,'promedio_est_conducta','id_grupo_guia','id_estud')->withPivot('promedio');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(user::class,'rel_grupo_guia_estudiante','id_grupo_guia','id_user');
    }
}
