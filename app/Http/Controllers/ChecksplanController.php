<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\DisneyplusExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Checksplan;
use App\Objectslist;
use App\Controlist;

use View;
use Validator;
use Input;
use Session;
use Redirect;
use Cookie;


class ChecksplanController extends Controller
{
	
	//Отображает список ресурсов
	
    public function index()
    {
        $checksplans = Checksplan::all();
		
        return View::make('checksplans.index')
            ->with('checksplans', $checksplans);
    }
	
	
	//Выводит форму для создания нового ресурса
	
    public function create()
    {
		$object_list = Objectslist::pluck('name', 'id');
		$control_list = Controlist::pluck('name', 'id');
		
		return View::make('checksplans.create')
			->with('object_list', $object_list)
			->with('control_list', $control_list);
    }
	
	
	//Помещает созданный ресурс в хранилище
	
    public function store(Request $request)
    {
        $rules = array(
            'object_id'       => 'required',
            'control_id'      => 'required',
			'checks_from'     => 'required|date',
            'checks_to'       => 'required|date',
			'plan'            => 'required|max:10'
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
			$checksplan->plan            = Input::get('plan');
            $checksplan->save();

            Session::flash('message', 'Successfully created checksplan!');
            return Redirect::to('checksplans');
        }
    }
	
	
	//Отображает указанный ресурс

    public function show($id)
    {
		$checksplan = Checksplan::find($id);
        return View::make('checksplans.show')
            ->with('checksplan', $checksplan);
    }
	
	
	//Выводит форму для редактирования указанного ресурса
	
    public function edit($id)
    {
		$checksplan = Checksplan::find($id);
		
		$object_list = Objectslist::pluck('name', 'id');
		$control_list = Controlist::pluck('name', 'id');

        return View::make('checksplans.edit')
            ->with('checksplan', $checksplan)
			->with('object_list', $object_list)
			->with('control_list', $control_list);
    }

	
	//Обновляет указанный ресурс в хранилище
	
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
            $checksplan = Checksplan::find($id);
            $checksplan->object_id       = Input::get('object_id');
            $checksplan->control_id      = Input::get('control_id');
			$checksplan->checks_from     = Input::get('checks_from');
			$checksplan->checks_to       = Input::get('checks_to');
			$checksplan->plan            = Input::get('plan');
            $checksplan->save();

            Session::flash('message', 'Successfully updates checksplan!');
            return Redirect::to('checksplans');
        }
    }
	
	
	//Удаляет указанный ресурс из хранилища

    public function destroy($id)
    {
        $checksplan = Checksplan::find($id);
        $checksplan->delete();


        Session::flash('message', 'Successfully deleted the checksplan!');
        return Redirect::to('checksplans');
    }
	
	
	//Экпорт\Выборка указанных ресурсов в Excel
	
	public function export(Request $request) 
	{
		if($request->post('elements')) {
			Cookie::queue('elements_list', $request->post('elements'));
		} else {
			return Excel::download(new DisneyplusExport, '111111111.xlsx');
		}
	}
	
}