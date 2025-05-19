<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        //tabla Usuario----------
        Schema::create('usuarios',function(Blueprint $table){
            $table->bigIncrements('Use_id');
            $table->string('Use_Nom');
            $table->string('Use-ApeNom');
            $table->string('Use_telf');
            $table->string('Use_mail');
        });

        //tabla Instalaciones------------
        Schema::create('instalaciones',function(Blueprint $table){
            $table->bigIncrements('ins_id');
            $table->string('ins_nombre');
            $table->string('ins_localidad');
            $table->string('ins_calle');
            $table->integer('ins_num');
             $table->string('ins_coordenadas');
        });

        //tabla Deportes ------------
        Schema::create('deportes',function(Blueprint $table){
            $table->bigIncrements('dep_id');
            $table->string('dep_nombre');
            $table->integer('dep_numParticipantes');
        });
        // tabla PsMaterial 
        Schema::create('material',function(Blueprint $table){
            $table->string('mat_pass');
            $table->unsignedBigInteger('mat_use_id');
            $table->foreign('mat_use_id')->references('Use_id')->on('usuarios')->onDelete('cascade');
        });
        //tabla sesiones 
         Schema::create('sesiones',function(Blueprint $table){
            $table->bigIncrements('ses_id');
            $table->date('ses_fecha');
            $table->string('ses_hora');
            $table->unsignedBigInteger('ses_ins_id');
            $table->unsignedBigInteger('ses_dep_id');
            $table->unsignedBigInteger('ses_use_id');
            $table->foreign('ses_ins_id')->references('ins_id')->on('instalaciones')->onDelete('cascade');
            $table->foreign('ses_dep_id')->references('dep_id')->on('deportes')->onDelete('cascade');
            $table->foreign('mat_use_id')->references('Use_id')->on('usuarios')->onDelete('cascade');
        });

        //tabla Actividades
           Schema::create('actividades',function(Blueprint $table){
            $table->bigIncrements('act_id');
            $table->unsignedBigInteger('act_ses_id');
            $table->unsignedBigInteger('act_use_id');
            $table->foreign('act_ses_id')->references('ses_id')->on('sesiones')->onDelete('cascade');
            $table->foreign('act_use_id')->references('Use_id')->on('usuarios')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Drop tabla usuario
        Schema::dropIfExists('usuarios');
        //Drop tabla instalaciones
        Schema::dropIfExists('instalaciones');
        //Drop tabla deportes
        Schema::dropIfExists('deportes');
        //Drop tabla materiales
        Schema::dropIfExists('material');
        //Drop tabla sesiones
        Schema::dropIfExists('sesiones');
        //Drop tabla sesiones
        Schema::dropIfExists('actividades');
    }
};
