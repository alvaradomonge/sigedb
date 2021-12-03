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
        return $this->hasMany(periodo::class);
    }
}
