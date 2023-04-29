<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('familiares')->default(0);
            $table->integer('personales')->default(0);
            $table->integer('otros')->default(0);
            $table->timestamps();
        });

        DB::table("antecedentes")
            ->insert([
                "nombre" => "DIABETES",
                "familiares" => 1,
                "personales" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "HIPERTENSION",
                "familiares" => 1,
                "personales" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "GEMELAR",
                "familiares" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "CIRUGIAS",
                "personales" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "CANCER",
                "familiares" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "ASMA",
                "personales" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "NEFROPATIA",
                "familiares" => 1,
                "personales" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "OTROS",
                "familiares" => 1,
                "personales" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "PESO FETAL MAYOR",
                "otros" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "EXPOSICION A QUIMICOS",
                "otros" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "EDAD PAREJA",
                "otros" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "FUMA/CAFE/ALCOHOL",
                "otros" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        DB::table("antecedentes")
            ->insert([
                "nombre" => "ALTO RIESGO",
                "otros" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antecedentes');
    }
}
