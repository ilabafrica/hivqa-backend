<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionResponses extends Model
{
     //
  	protected $table = 'question_responses';

     /**
   	 * Relationship with questions.
   	 *
   	 */
    public function question()
    {
      return $this->belongsTo('App\Question');
    }
}
