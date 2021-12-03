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
        return $this->belongsTo(anio_lectivo::class);
    }

    public function materias(){//se debe agregar el modelo de gurpo guia y su tabla de relación con periodo
        //return $this->belongsToMany(materia::class, 'rel_periodo_materia','id_periodo','id_materia');
    }
}
