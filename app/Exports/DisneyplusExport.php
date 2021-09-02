<?php

namespace App\Exports;

use App\Disneyplus;
use App\Checksplan;

use Maatwebsite\Excel\Concerns\FromCollection;

class DisneyplusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Disneyplus::all();
		
		return Checksplan::all();
    }
}
