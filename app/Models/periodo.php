<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodo extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'periodo';
    use HasFactory;

    public function materias(){
        return $this->belongsToMany(materia::class, 'rel_periodo_materia','id_periodo','id_materia');
    }
}
