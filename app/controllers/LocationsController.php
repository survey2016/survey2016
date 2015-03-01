<?php

class LocationsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function main(){
		$provinces = DB::select("SELECT * FROM list_provinces");
		$districts = DB::select("SELECT * FROM list_districts");
		$towns = DB::select("SELECT * FROM list_towns");
		$brgys = DB::select("SELECT * FROM list_brgys");

		$data = array(
			'title' => 'Locations',
			'provinces'=>$provinces,
			'districts'=>$districts,
			'towns'=>$towns,
			'brgys'=>$brgys
		);
		return View::make('locations',$data);
	}

	

}


