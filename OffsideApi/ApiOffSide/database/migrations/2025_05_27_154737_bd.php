<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      public function up(): void
    {
        // Deportes
        Schema::create('deportes', function (Blueprint $table) {
            $table->id('dep_id');
            $table->string('dep_nombre', 45)->nullable();
            $table->string('dep_numParticipantes', 45)->nullable();
        });

        // Instalaciones
        Schema::create('instalaciones', function (Blueprint $table) {
            $table->id('ins_id');
            $table->string('ins_nombre', 45)->nullable();
            $table->string('ins_localidad', 45)->nullable();
            $table->string('ins_calle', 45)->nullable();
            $table->string('ins_num', 45)->nullable();
            $table->string('ins_coordenadas', 45)->nullable();
        });

        // Sesiones
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id('ses_id');
            $table->date('ses_fecha')->nullable();
            $table->string('ses_hora', 45)->nullable();
            $table->unsignedBigInteger('ses_use_id')->nullable(); // fk a users
            $table->unsignedBigInteger('ses_ins_id')->nullable();
            $table->unsignedBigInteger('ses_dep_id')->nullable();
            $table->float('ses_precio')->nullable();
            $table->string('ses_nombre', 45)->nullable();

            $table->foreign('ses_use_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('ses_ins_id')->references('ins_id')->on('instalaciones')->onDelete('cascade');
            $table->foreign('ses_dep_id')->references('dep_id')->on('deportes')->onDelete('cascade');
        });

        // Actividades
        Schema::create('actividades', function (Blueprint $table) {
            $table->id('act_id');
            $table->unsignedBigInteger('act_use_id')->nullable(); // fk a users
            $table->unsignedBigInteger('act_ses_id')->nullable();

            $table->foreign('act_use_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('act_ses_id')->references('ses_id')->on('sesiones')->onDelete('set null');
        });

        // Equipo
        Schema::create('equipo', function (Blueprint $table) {
            $table->id('eq_id');
            $table->string('eq_nom', 45)->nullable();
            $table->unsignedBigInteger('eq_usu_id')->nullable(); // fk a users
            $table->unsignedTinyInteger('eq_num_jug')->nullable();
            $table->unsignedSmallInteger('eq_gol_fav')->nullable();
            $table->unsignedSmallInteger('eq_gol_cont')->nullable();

            $table->foreign('eq_usu_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Liga
        Schema::create('liga', function (Blueprint $table) {
            $table->id('lig_id');
            $table->unsignedBigInteger('lig_eq_id')->nullable();
            $table->string('lig_jor', 45)->nullable();
            $table->integer('lig_punt')->nullable();
            $table->string('lig_result', 45)->nullable();

            $table->foreign('lig_eq_id')->references('eq_id')->on('equipo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('liga');
        Schema::dropIfExists('equipo');
        Schema::dropIfExists('actividades');
        Schema::dropIfExists('sesiones');
        Schema::dropIfExists('instalaciones');
        Schema::dropIfExists('deportes');
    }
};
