<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'surveys';

    /**
  	* SurveyQuestions relationship
  	*
  	*/
    public function surveydata()
    {
        return $this->hasMany('App\SurveyData');
    }
}
