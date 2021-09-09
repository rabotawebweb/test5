<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectslist extends Model
{
    //
	
	protected $table = 'objectslist';
	
	public function checksplan()
	{
		return $this->hasOne(App\Checksplan);
	}
}