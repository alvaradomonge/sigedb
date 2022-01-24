<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsistenciaConducta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leccion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',20);
        });
        Schema::create('escala_asistencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',30);
            $table->boolean('es_positiva');
             $table->unsignedDecimal('valor_porcentual',$precision=3,$scale=1)->nullable();
        });
        Schema::create('escala_conducta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',30);
            $table->boolean('es_positiva');
            $table->unsignedDecimal('valor_porcentual',$precision=3,$scale=1)->nullable();
        });
        Schema::create('conducta_estudiante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_grupo_guia')->constrained('grupo_guia');
            $table->foreignId('id_materia')->constrained('materia');
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_escala_conducta')->constrained('escala_conducta')->onDelete('cascade');
            $table->date('fecha_incidente')->nullable();
            $table->unsignedDecimal('puntos',$precision=3,$scale=1)->nullable();
            $table->string('detalle',255)->nullable();
        });
        Schema::create('asistencia_estudiante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_grupo_guia')->constrained('grupo_guia');
            $table->foreignId('id_materia')->constrained('materia');
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_escala_asistencia')->constrained('escala_asistencia');
            $table->foreignId('id_leccion')->constrained('leccion')->onDelete('cascade');
            $table->date('fecha_incidente')->nullable();
            $table->string('detalle',255)->nullable();
        });
        Schema::create('promedio_est_conducta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_grupo_guia')->constrained('grupo_guia');
            $table->foreignId('id_estud')->constrained('users');
            $table->unsignedDecimal('promedio',$precision=4,$scale=1)->default(100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(['leccion','escala_asistencia','escala_conducta','conducta_estudiante','asistencia_estudiante']);
    }
}
