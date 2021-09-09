<?php

namespace App\Exports;

use App\Disneyplus;
use App\Checksplan;
use App\Objectslist;
use App\Controlist;


use Maatwebsite\Excel\Concerns\FromCollection;

use Cookie;

class DisneyplusExport implements FromCollection
{
	
	public $datalist;
	
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
		
		//return Checksplan::all();
		
		$elements_list = explode('-', Cookie::get('elements_list') );
		
		return Checksplan::with('objectslist')->find( $elements_list )->map(function($item, $key) {

                            return [
                                'id' => $item->id,
								'object' => $item->objectslist->name,
								'control' => $item->controlist->name,
								'from' => date_format(date_create($item->checks_from), 'd.m.Y'),
								'to' => date_format(date_create($item->checks_to), 'd.m.Y'),
								'plan' => $item->plan,
                            ];

                        });
		
    }
}
