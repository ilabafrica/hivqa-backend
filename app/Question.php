<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $table = 'questions';

    public function subCounty()
     {
   		return $this->belongsTo('App\Section');
     }

    /**
   	 * Relationship with question_responses.
   	 *
   	 */
    public function question_responses()
    {
      return $this->hasMany('App\QuestionResponses');
    }
}
