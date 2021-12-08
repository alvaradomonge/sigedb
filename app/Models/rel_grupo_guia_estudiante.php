<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rel_grupo_guia_estudiante extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'rel_grupo_guia_estudiante';
    use HasFactory;
}
