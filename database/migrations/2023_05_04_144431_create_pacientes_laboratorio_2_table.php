<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesLaboratorio2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_laboratorio_2', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->date('fecha');
            $table->string('hiv')->nullable();
            $table->string('vdrl')->nullable();
            $table->string('anticore')->nullable();
            $table->string('tgo')->nullable();
            $table->string('tpg')->nullable();
            $table->string('ldh')->nullable();
            $table->string('toxo_igm')->nullable();
            $table->string('toxo_igg')->nullable();
            $table->string('tsh')->nullable();
            $table->string('t4')->nullable();
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
        Schema::dropIfExists('pacientes_laboratorio_2');
    }
}
