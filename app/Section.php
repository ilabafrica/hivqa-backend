<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  	protected $table = 'sections';

    /**
  	 * Relationship with checklist.
  	 *
  	 */
     public function checklist()
     {
       return $this->belongsTo('App\Checklist');
     }
     /**
   	 * Relationship with question.
   	 *
   	 */
    public function question()
    {
      return $this->hasMany('App\Question');
    }
}
