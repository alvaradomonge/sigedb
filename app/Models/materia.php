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
}
