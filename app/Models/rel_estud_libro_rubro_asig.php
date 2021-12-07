<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rel_estud_libro_rubro_asig extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'rel_estud_libro_rubro_asig';
    use HasFactory;
}
