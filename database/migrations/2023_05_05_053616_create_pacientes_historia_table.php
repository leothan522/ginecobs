<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesHistoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_historia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacientes_id')->unsigned();
            $table->date('fecha');
            $table->string('mc')->nullable();
            $table->bigInteger('peso_id')->nullable()->unsigned();
            $table->string('ta')->nullable();
            $table->string('mama')->nullable();
            $table->string('cue')->nullable();
            $table->string('zt')->nullable();
            $table->string('cabeza')->nullable();
            $table->string('cuello')->nullable();
            $table->string('torax')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('extremidades')->nullable();
            $table->string('snc')->nullable();
            $table->string('genitales')->nullable();
            $table->text('observacion')->nullable();
            $table->text('plan')->nullable();
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
        Schema::dropIfExists('pacientes_historia');
    }
}
