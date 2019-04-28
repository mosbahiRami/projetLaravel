<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaiementMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('etudiant_id')->unsigned(); 
            $table->foreign('etudiant_id')->references('id')->on('etudiants')
            ->onDelete('cascade'); 
            $table->enum('trimestre1', ['payé', 'non payé']);
            $table->enum('trimestre2', ['payé', 'non payé']);
            $table->enum('trimestre3', ['payé', 'non payé']);
            $table->enum('cautionnement', ['rendu', 'non rendu']);
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
        Schema::dropIfExists('paiements');
    }
}
