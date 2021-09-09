<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Controlist extends Model
{
    //
	
	protected $table = 'controlist';
	
	public function checksplan()
	{
		return $this->hasOne(App\Checksplan);
	}
}