<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rel_anio_periodo extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'rel_anio_periodo';
    use HasFactory;
}
