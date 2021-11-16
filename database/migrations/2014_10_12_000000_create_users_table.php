<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('detalle_tipo_usuario',50);
            $table->boolean('gestion_materias');
            $table->boolean('gestion_periodos');
            $table->boolean('gestion_anios');
            $table->boolean('gestion_usuarios');
            $table->boolean('gestion_plantillas_informes');
            $table->boolean('acceso_informes_usuarios');
            $table->boolean('gestion_notas');
            $table->boolean('acceso_informes_notas');
            $table->boolean('acceso_mensajeria');
            $table->boolean('consulta_asistencia');
            $table->boolean('modifica_asistencia');
        });
        Schema::create('estado_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',20);
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',20);
            $table->string('apellido1',20);
            $table->string('apellido2',20);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cedula',30)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('direccion')->nullable();
            $table->rememberToken();
            $table->timestamps();
            //$table->unsignedTinyInteger('id_rol_ususario')->default(1);
            //$table->unsignedTinyInteger('id_estado')->default(1);
            $table->foreignId('id_estado')->constrained('estado_usuario');
            $table->foreignId('id_rol_usuario')->constrained('rol_usuario');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(['users','rol_usuario','estado_usuario']);
    }
}
