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

    public function periodos(){
        return $this->belongsToMany(periodo::class, 'rel_periodo_materia','id_materia','id_periodo');
    }
}
