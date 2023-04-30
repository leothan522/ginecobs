<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTipajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_tipajes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->string('madre')->nullable();
            $table->string('padre')->nullable();
            $table->string('sensibilidad')->nullable();
            $table->foreign('pacientes_id')->references('id')->on('pacientes')->cascadeOnDelete();
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
        Schema::dropIfExists('pacientes_tipajes');
    }
}
