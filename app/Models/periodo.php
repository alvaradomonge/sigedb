<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodo extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'periodo';
    use HasFactory;

    public function anio_lectivo(){
        return $this->belongsToMany('App\Models\anio_lectivo','rel_anio_periodo','id_periodo','id_anio');
    }

    public function materias(){
        return $this->belongsToMany(materia::class, 'rel_periodo_materia','id_periodo','id_materia');
    }
}
