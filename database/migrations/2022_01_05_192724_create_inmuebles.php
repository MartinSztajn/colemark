<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmuebles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('id_usuario');
            $table->string('id_sector');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('lote');
            $table->boolean('estado');
            $table->integer('pisos');
            $table->integer('dormitorios');
            $table->integer('ambientes');
            $table->integer('baños');
            $table->integer('superficie_total');
            $table->boolean('pileta');
            $table->boolean('parilla');
            $table->boolean('jardin');
            $table->integer('precio');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inmuebles');
    }
}
