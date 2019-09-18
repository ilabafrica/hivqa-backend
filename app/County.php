<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    //
    /**
  	* The database table used by the model.
  	*
  	* @var string
  	*/
  	protected $table = 'counties';
    /**
  	* Relationship with sub-countis.
  	*
  	*/
    public function subCounties()
    {
       return $this->hasMany('App\SubCounty');
    }
}
