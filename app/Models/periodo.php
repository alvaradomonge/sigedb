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
}
