<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
 protected $fillable=['id','cin','num_bac','nom','naissance','gouvernorat','telephone','email','faculte','date_inscription','promotion_bac'];

 public function heberge()
 {
 	return $this->hasOne(Heberge::class);
 }
 public function paiement()
 {
 	return $this->hasOne(Paiement::class);
 }
}
