<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria_materia extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'categoria_materia';
    use HasFactory;

    public function materias()
    {
        return $this->hasMany(materia::class,'id_categoria_materia');
    }
}
