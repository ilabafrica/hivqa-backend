<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    //
     //
  	protected $table = 'checklists';

     /**
   	 * Relationship with facilities.
   	 *
   	 */
    public function section()
    {
      return $this->hasMany('App\Section');
    }
}
