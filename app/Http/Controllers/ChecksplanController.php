<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\DisneyplusExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Checksplan;
use View;
use Validator;
use Input;
use Session;
use Redirect;

class ChecksplanController extends Controller
{
    public function index()
    {
        $checksplans = Checksplan::all();
		
        return View::make('checksplans.index')
            ->with('checksplans', $checksplans);
    }

    public function create()
    {
		return View::make('checksplans.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'object_id'       => 'required',
            'control_id'      => 'required',
			'checks_from'     => 'required',
            'checks_to'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('checksplans/create')
                ->withErrors($validator);
        } else {
            $checksplan = new Checksplan;
            $checksplan->object_id       = Input::get('object_id');
            $checksplan->control_id      = Input::get('control_id');
			$checksplan->checks_from     = Input::get('checks_from');
			$checksplan->checks_to       = Input::get('checks_to');
			$checksplan->plan            = 'one days';
            $checksplan->save();

            Session::flash('message', 'Successfully created checksplan!');
            return Redirect::to('checksplans');
        }
    }

    public function show($id)
    {
		$checksplan = Checksplan::find($id);
        return View::make('checksplans.show')
            ->with('checksplan', $checksplan);
    }

    public function edit($id)
    {
		$checksplan = Checksplan::find($id);

        return View::make('checksplans.edit')
            ->with('checksplan', $checksplan);
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'object_id'       => 'required',
            'control_id'      => 'required',
			'checks_from'     => 'required',
            'checks_to'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('checksplans/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $checksplan = new Checksplan;
            $checksplan->object_id       = Input::get('object_id');
            $checksplan->control_id      = Input::get('control_id');
			$checksplan->checks_from     = Input::get('checks_from');
			$checksplan->checks_to       = Input::get('checks_to');
            $checksplan->save();

            Session::flash('message', 'Successfully updates checksplan!');
            return Redirect::to('checksplans');
        }
    }

    public function destroy($id)
    {
        $checksplan = Checksplan::find($id);
        $checksplan->delete();


        Session::flash('message', 'Successfully deleted the checksplan!');
        return Redirect::to('checksplans');
    }
	
	public function export() 
	{
			return Excel::download(new DisneyplusExport, '111111111.xlsx');
	}
	
}