<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responses extends Model
{
    //
     //
  	protected $table = 'responses';

     /**
   	 * Relationship with facilities.
   	 *
   	 */
    public function section()
    {
      return $this->hasMany('App\Section');
    }
}
