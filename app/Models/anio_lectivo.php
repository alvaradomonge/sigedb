<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anio_lectivo extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'anio_lectivo';
    use HasFactory;

    public function periodos()
    {
        return $this->belongsToMany(periodo::class,'rel_anio_periodo','id_anio','id_periodo')->withPivot('es_final','activo','valor_porcentual')->as('relacion');
    }
}
