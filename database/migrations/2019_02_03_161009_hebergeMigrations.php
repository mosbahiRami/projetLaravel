<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HebergeMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('heberges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('etudiant_id')->unsigned(); 
            $table->foreign('etudiant_id')->references('id')->on('etudiants')
            ->onDelete('cascade'); 
            $table->integer('chambre_id')->unsigned(); 
            $table->foreign('chambre_id')->references('id')->on('chambres')
            ->onDelete('cascade');           
            $table->enum('ApprobationLogement', ['oui', 'non']);
            $table->enum('recuInscriptionUniversitaire', ['oui', 'non']);
            $table->enum('certificatResidence', ['oui', 'non']);
            $table->enum('copieCin', ['oui', 'non']);
            $table->enum('certificatMedicale', ['oui', 'non']);
            $table->enum('enveloppes', ['oui', 'non']);
            $table->enum('photos', ['oui', 'non']);
            $table->enum('reglementInterieur', ['oui', 'non']);
            $table->String('photo')->nullable();
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
        Schema::dropIfExists('heberges');
    }
}
