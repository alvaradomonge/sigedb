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
        return $this->hasMany(materia::class);
    }
}
