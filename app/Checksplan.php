<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checksplan extends Model
{
    //
	
	public function objectslist()
    {
        return $this->belongsTo('App\Objectslist', 'object_id');
    }
	
	public function controlist()
    {
        return $this->belongsTo('App\Controlist', 'control_id');
    }
	
}