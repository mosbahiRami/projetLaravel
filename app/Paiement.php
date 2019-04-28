<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable=['id','trimestre1','trimestre2','trimestre3','cautionnement'];
	
	public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

}
