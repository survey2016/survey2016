<?php

class DashboardController extends BaseController {

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
		$watchList = array(11);
		$provinces = DB::select("SELECT COUNT(id) as count FROM list_provinces");
		$districts = DB::select("SELECT COUNT(id) as count FROM list_districts");
		$towns = DB::select("SELECT COUNT(id) as count FROM list_towns");
		$brgys = DB::select("SELECT COUNT(id) as count FROM list_brgys");		
		$voters = DB::select("SELECT COUNT(id) as count FROM voters");	

		//POSITIONS
		$listOfPositions = DB::select("SELECT * FROM list_positions ORDER BY id ASC");
		foreach ($listOfPositions as $p) {
			$positionArr[$p->id] = $p->name;
            $posDetail = array('id'=>$p->id, 'name'=>$p->name);
            $positionIDArr[] = $posDetail;            
		}

		//CANDIDATES
		$candidateStatus = array(); $pieChartData = array(); $nameVote = array();
		$candidateIDs = array(); $positionIDs = array();
		$listOfCandidates = DB::select("SELECT * FROM candidates ORDER BY positionID ASC, survey".$surveyNo." DESC");
		foreach ($listOfCandidates as $c) {
			$name = strtoupper($c->lastName).', '.ucfirst($c->firstName);
            $cand = array(
        		'id' => $c->id,
        		'name' => $name,
        		'position' => $positionArr[ $c->positionID ],
        		'positionID' => $c->positionID,
        		'survey1' => $c->survey1,
        		'survey2' => $c->survey2,
        		'survey3' => $c->survey3,
        		'survey4' => $c->survey4,
        		'stat1' => $c->stat1,
        		'stat2' => $c->stat2,
        		'stat3' => $c->stat3,
        		'stat4' => $c->stat4
        	);
        	$candidateStatus[] = $cand;
        	$surveyData = 1;        	
        	switch($surveyNo){
        		case 1: $surveyData = $c->survey1; break;
        		case 2: $surveyData = $c->survey2; break;
        		case 3: $surveyData = $c->survey3; break;
        		case 4: $surveyData = $c->survey4; break;
        	}

        	//pie chart data
        	if(in_array($c->id, $watchList)){
        		$pie = "{ name: '".$name."', y: ".$surveyData.", sliced:true, selected:true }";
        	}else{
        		$pie = "['".$name."', ".$surveyData."]";
        	}        	
        	$pieChartData[$c->positionID][] = $pie;      
        	$nameVote[$c->positionID][$name] = $surveyData;
        	$candidateIDs[] = $c->id;
        	$positionIDs[] = $c->positionID;
		}

		// echo "<pre>";
		// print_r($nameVote); 
		// echo "</pre>";
		// exit();
		$data = array(
			'title' => 'Dashboard',
			'numberOfProvinces'=>$provinces[0]->count,
			'numberOfDistricts'=>$districts[0]->count,
			'numberOfTowns'=>$towns[0]->count,
			'numberOfBrgys'=>$brgys[0]->count,
			'numberOfVoters'=>$voters[0]->count,
			'candidateStatus'=> $candidateStatus,
			'pieChartData' => $pieChartData,
			'positionArr' => $positionArr,
			'nameVote'=> $nameVote,
			'candidateIDs'=> implode(',', $candidateIDs),
			'positionIDs'=>implode(',', $positionIDs)
		);
		return View::make('dashboard',$data);	
	}

	

}


