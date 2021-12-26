<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota_estudiante_asignacion extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'nota_estudiante_asignacion';
    use HasFactory;
}

