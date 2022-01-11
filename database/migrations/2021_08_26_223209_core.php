<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Core extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anio_lectivo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',4);
        });
        Schema::create('periodo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',20);
            $table->unsignedTinyInteger('valor_porcentual')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->foreignId('id_anio')->constrained('anio_lectivo');
            $table->boolean('activo');
            $table->boolean('es_final');
        });
        Schema::create('grupo_guia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->foreignId('id_periodo')->constrained('periodo');
        });
        Schema::create('rel_grupo_guia_estudiante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_grupo_guia')->constrained('grupo_guia');
            $table->foreignId('id_user')->constrained('users');
        });
        Schema::create('estado_materia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
        });
        Schema::create('categoria_materia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
        });
        Schema::create('materia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->foreignId('id_grupo_guia')->nullable()->constrained('grupo_guia');
            $table->foreignId('id_categoria_materia')->nullable()->constrained('categoria_materia');
            $table->foreignId('id_user')->nullable()->constrained('users');
            $table->foreignId('id_estado')->nullable()->constrained('estado_materia');
            $table->boolean('es_cualitativo')->nullable();
        });
        Schema::create('rubro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->unsignedTinyInteger('valor_porcentual')->nullable();
            $table->foreignId('id_materia')->nullable()->constrained('materia');
        });
        Schema::create('escala_cualitativa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',255);
        });
        Schema::create('rubro_escala_cualitativa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
        });
        Schema::create('rel_escala_cualit_rubro_cualit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_escala_cualitativa')->constrained('escala_cualitativa');
            $table->foreignId('id_rubro_cualitativo')->constrained('rubro_escala_cualitativa');
        });
        Schema::create('asignacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',255);
            $table->float('valor_porcentual',3,1)->nullable();
            $table->foreignId('id_rubro')->constrained('rubro')->onDelete('cascade');
            $table->foreignId('id_escala_cualitativa')->nullable()->constrained('escala_cualitativa');
        });
        Schema::create('nota_estudiante_asignacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_estud')->constrained('users');
            $table->foreignId('id_asig')->constrained('asignacion')->onDelete('cascade');
            $table->foreignId('id_materia')->nullable()->constrained('materia');
            $table->unsignedDecimal('nota',$precision=4,$scale=1)->default(0);
            $table->foreignId('id_rubro_cualit')->nullable()->constrained('rubro_escala_cualitativa');
        });
        Schema::create('promedio_estud_materia_cuanti', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_estudiante')->constrained('users');
            $table->foreignId('id_materia')->constrained('materia');
            $table->unsignedDecimal('promedio',$precision=4,$scale=1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(['materia','periodo','grupo_guia','anio_lectivo','rol_usuario','estado_materia','rel_materia_docente','promedio_estud_materia_cuanti','nota_estudiante_asignacion','asignacion','rel_escala_cualit_rubro_cualit','rubro_escala_cualitativa','escala_cualitativa','rubro']);
    }
}
