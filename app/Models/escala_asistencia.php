<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class escala_asistencia extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'escala_asistencia';
    use HasFactory;
}
