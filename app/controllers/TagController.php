<?php

class TagController extends BaseController {

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


		$surveyNo = 1;
		$provinces = DB::select("SELECT * FROM list_provinces ORDER BY id ASC");
		$districts = DB::select("SELECT * FROM list_districts ORDER BY id ASC");
		$towns = DB::select("SELECT * FROM list_towns ORDER BY id ASC");
		$brgys = DB::select("SELECT * FROM list_brgys ORDER BY id ASC");	
		if(Session::get('userType')=='T'){	
			$listOfVoters = DB::select("SELECT a.id as voters_id, a.firstName, a.lastName, b.* 
										FROM voters a 
										LEFT JOIN survey_".$surveyNo." b ON b.votersID=a.id
										WHERE					 
											a.provinceID='".Session::get('provinceID')."' AND
											a.districtID='".Session::get('districtID')."' AND
											a.townID='".Session::get('townID')."' AND
											a.brgyID='".Session::get('brgyID')."' 
										ORDER BY lastName ASC");	
		}else{
			$listOfVoters = DB::select("SELECT a.id as voters_id, a.firstName, a.lastName, b.* 
										FROM voters a 
										LEFT JOIN survey_".$surveyNo." b ON b.votersID=a.id										
										ORDER BY lastName ASC");	
		}
		$listOfCandidates = DB::select("SELECT id, positionID, lastName, firstName FROM candidates ORDER BY positionID ASC");	
		$listOfPositions = DB::select("SELECT * FROM list_positions WHERE id!=9 ORDER BY id ASC");	
	
		// echo "<pre>";
		// print_r($listOfVoters);
		// echo "</pre>";
		// exit();
		$data = array(
			'title' => 'Tag',
			'provinces'=>$provinces,
			'districts'=>$districts,
			'towns'=>$towns,
			'brgys'=>$brgys,
			'listOfVoters'=>$listOfVoters,
			'listOfCandidates'=>$listOfCandidates,
			'listOfPositions'=> $listOfPositions
		);
		return View::make('tag',$data);	
	}

	

}


