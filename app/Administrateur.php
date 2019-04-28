<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    protected $fillable=['id','nom','prenom','adresse','telephone','email','image','login','mdp'];
}
