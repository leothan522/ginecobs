<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_antecedentes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->bigInteger('antecedentes_id')->unsigned();
            $table->integer('valor')->nullable();
            $table->string('detalles')->nullable();
            $table->integer('familiares')->default(0);
            $table->integer('personales')->default(0);
            $table->integer('otros')->default(0);
            $table->foreign('pacientes_id')->references('id')->on('pacientes')->cascadeOnDelete();
            $table->foreign('antecedentes_id')->references('id')->on('antecedentes')->cascadeOnDelete();
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
        Schema::dropIfExists('pacientes_antecedentes');
    }
}
