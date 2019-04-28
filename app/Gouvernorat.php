<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gouvernorat extends Model
{
   protected $fillable=['id','code_gouvernorat','libelle_gouvernorat'];
}
