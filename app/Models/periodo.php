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
        return $this->belongsTo(anio_lectivo::class,'id_anio');
    }

    public function grupos_guias(){
        return $this->hasMany(grupo_guia::class,'id_periodo');
    }
}
