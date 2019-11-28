<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyData extends Model
{
    protected $table = 'survey_data';

    /**
  	 * Survey relationship
  	 *
  	 */
     public function survey()
     {
          return $this->belongsTo('App\Survey');
     }
}
