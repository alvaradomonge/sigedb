<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'apellido1',
        'apellido2',
        'email',
        'password',
        'cedula',
        'telefono',
        'direccion',
        'id_estado',
        'id_rol_usuario',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function materias(){
        return $this->hasMany(materia::class,'id_user');
    }

    public function promedio_materia(){
        return $this->belongsToMany(materia::class,'promedio_estud_materia_cuanti','id_estudiante','id_materia')->withPivot('promedio');
    }

    public function grupos_guias()
    {
        return $this->belongsToMany(grupo_guia::class,'rel_grupo_guia_estudiante','id_user','id_grupo_guia');
    }
    public function nota_asignaciones(){
        return $this->belongsToMany(asignacion::class,'nota_estudiante_asignacion','id_estud','id_asig')->withPivot('nota','id_rubro_cualit','id_materia','id_rubro');
    }

    public function incidencias_asistencia(){
        return $this->belongsToMany(materia::class,'asistencia_estudiante','id_user','id_materia')->withPivot('id_escala_asistencia','fecha_incidente','id_leccion');
    }

    public function incidencias_conducta(){
        return $this->belongsToMany(materia::class,'asistencia_estudiante','id_user','id_materia')->withPivot('id_escala_conducta','fecha_incidente','puntos','detalle');
    }

    public function promedio_conducta(){
        return $this->belongsToMany(grupo_guia::class,'promedio_est_conducta','id_estud','id_grupo_guia')->withPivot('promedio');
    }

    public function getFullName(){
        return "{$this->id} {$this->name} {$this->apellido1} {$this->apellido2}";
    }
}
