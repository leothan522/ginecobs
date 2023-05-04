<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesLaboratorio1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_laboratorio_1', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->date('fecha');
            $table->string('hb')->nullable();
            $table->string('leuco')->nullable();
            $table->string('plaqueta')->nullable();
            $table->string('glicemia')->nullable();
            $table->string('urea')->nullable();
            $table->string('crea')->nullable();
            $table->string('ac_urico')->nullable();
            $table->string('tp')->nullable();
            $table->string('tpt')->nullable();
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
        Schema::dropIfExists('pacientes_laboratorio_1');
    }
}
