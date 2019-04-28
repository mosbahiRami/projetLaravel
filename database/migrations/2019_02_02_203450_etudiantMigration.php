<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EtudiantMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('etudiants', function (Blueprint $table) {
            $table->increments('id');
            $table->String('cin');
            $table->String('num_bac')->nullable();
            $table->String('nom')->nullable();
            $table->String('naissance')->nullable();
            $table->String('gouvernorat')->nullable();
            $table->String('telephone')->nullable();
            $table->String('email')->nullable();
            $table->String('faculte')->nullable();
            $table->String('date_inscription')->nullable();
            $table->Integer('promotion_bac')->nullable();
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
        Schema::dropIfExists('etudiants');
    }
}
