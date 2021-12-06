<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado_materia extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'estado_materia';
    use HasFactory;

    //crear modelo y dependencias de la tabla grupo_guia
    public function materias(){
        return $this->hasMany(materia::class);
    }
}
