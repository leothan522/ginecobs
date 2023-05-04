<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_control', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->date('fecha');
            $table->string('edad_gestacional')->nullable();
            $table->bigInteger('peso_id')->nullable()->unsigned();
            $table->string('ta')->nullable();
            $table->string('au')->nullable();
            $table->string('pres')->nullable();
            $table->string('fcf')->nullable();
            $table->string('mov_fetales')->nullable();
            $table->string('du')->nullable();
            $table->string('edema')->nullable();
            $table->string('sintomas')->nullable();
            $table->text('observaciones')->nullable();
            $table->foreign('pacientes_id')->references('id')->on('pacientes')->cascadeOnDelete();
            $table->foreign('peso_id')->references('id')->on('pacientes_peso')->nullOnDelete();
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
        Schema::dropIfExists('pacientes_control');
    }
}
