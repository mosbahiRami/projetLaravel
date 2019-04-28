<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
 	protected $fillable=['id','bloc_chambre','num_chambre','etat','capacite','compteur'];

 	public function heberge()
    {
        return $this->hasMany(Heberge::class);
    }
}
