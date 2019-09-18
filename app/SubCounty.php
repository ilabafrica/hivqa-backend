<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    //
  	protected $table = 'sub_counties';

    /**
  	 * Relationship with county.
  	 *
  	 */
     public function county()
     {
       return $this->belongsTo('App\County');
     }
     /**
   	 * Relationship with facilities.
   	 *
   	 */
    public function facilities()
    {
      return $this->hasMany('App\Facility', 'sub_county_id', 'id');
    }
}
