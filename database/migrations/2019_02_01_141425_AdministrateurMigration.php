<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdministrateurMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('administrateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nom');
            $table->String('prenom');
            $table->String('adresse');
            $table->String('telephone');
            $table->String('email');
            $table->String('image')->nullable();
            $table->String('login');
            $table->String('mdp');
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
        Schema::dropIfExists('administrateurs');
    }
}
