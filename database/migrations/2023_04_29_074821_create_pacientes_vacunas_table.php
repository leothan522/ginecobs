<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesVacunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_vacunas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->bigInteger('vacunas_id')->unsigned();
            $table->string('dosis_1')->nullable();
            $table->string('dosis_2')->nullable();
            $table->string('refuerzo')->nullable();
            $table->foreign('pacientes_id')->references('id')->on('pacientes')->cascadeOnDelete();
            $table->foreign('vacunas_id')->references('id')->on('vacunas')->cascadeOnDelete();
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
        Schema::dropIfExists('pacientes_vacunas');
    }
}
