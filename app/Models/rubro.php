<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rubro extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'rubro';
    use HasFactory;

    public function materia(){
        return $this->belongsTo(materia::class,'id_materia');
    }
    public function asignaciones(){
        return $this->hasMany(asignacion::class,'id_rubro');
    }
}
