<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
  	protected $table = 'facilities';

    public function subCounty()
     {
   		return $this->belongsTo('App\SubCounty');
     }
}
