<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Equipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('equipos', function (Blueprint $table) {
            //Cascada engine
            $table->engine="InnoDB";

            $table->bigIncrements('id');

            //Este es el campo que relaciona una tabla con la otra
            //Relizar los artisans de más grande a más pequeño
            $table->unsignedBigInteger('departamento_id');

            $table->string('Nombre');
            $table->string('Codigo');


            $table->timestamps();

            //La columna departamento_id pertenece a una relación en dónde la columna id de departamento está relacionado con ese campo
            //Se especifica el borrado en cascada
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
