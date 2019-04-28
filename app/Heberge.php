<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heberge extends Model
{
    protected $fillable=['id','ApprobationLogement','recuInscriptionUniversitaire','certificatResidence','copieCin','certificatMedicale','enveloppes','photo','photos','reglementInterieur'];

     public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }
}
