<?php

class AJAXController extends BaseController {

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

	public function updateSurveySingle(){
		$surveyID = 1;
		$votersID = Input::get('votersID');
		$candidateID = Input::get('candidateID');
		$positionID = Input::get('positionID');
		
		$candidateField = '';
		switch($positionID){
			case '1': $candidateField ='presID'; break; 
			case '2': $candidateField ='vpresID'; break; 
			case '3': $candidateField ='govID'; break; 
			case '4': $candidateField ='vgovID'; break; 
			case '5': $candidateField ='congID'; break; 
			case '6': $candidateField ='vocalID'; break; 
			case '7': $candidateField ='mayorID'; break; 
			case '8': $candidateField ='vmayorID'; break; 
		}

		//check if exist
		$exist = DB::select("SELECT id FROM survey_".$surveyID." WHERE votersID='".$votersID."'  ");		
		if($exist){					
	        $update = DB::select(" UPDATE survey_".$surveyID." SET ".$candidateField."='".$candidateID."' WHERE votersID='".$votersID."' ");			
			$success = true; 
			// if($update){ $success=true; }else{ $success = false; }
	    }else{	
	    	$insert = DB::select("INSERT INTO survey_".$surveyID." 
									(votersID,".$candidateField.") 
									VALUES(	'".$votersID."','".$candidateID."'	) ");	
			$success = true; 				    	
	    }		
		$response = array('success' => $success);	
		echo json_encode($response);
	}

	public function updateStatus(){	
		//get all candidates
		$surveys = DB::select("SELECT id, positionID, survey1, survey2, survey3, survey4 FROM candidates ");	
		foreach($surveys as $s){
			$id = $s->id;
			$pid = $s->positionID;
			$survey1a[ $pid ][ $s->survey1 ] = $id;
		}

		$winID = array();
		foreach ($survey1a as $posID=>$candidates) {
			//sort by vote ascending	
			krsort($candidates); 
			//get the winning id
			$kgwdCtr = 0;
			foreach ($candidates as $vote => $id) {
				if($posID==9){
					//get top 7 kagawad
					$winID[] = $id;
					$kgwdCtr++;
					if($kgwdCtr==7){
						break;
					}
				}else{
					$winID[] = $id;
					break;	
				}			
			}			
		}

		$winID = implode("','", $winID);
		$update = DB::select("UPDATE candidates SET stat1='N' ");
		$update = DB::select("UPDATE candidates SET stat1='Y' WHERE id IN ('".$winID."') ");

		$response = array('success' => true);	
		echo json_encode($response);
	}

	public function updateSingle(){	
		//get all candidates
		$surveyID = 1;
		$candidateID = Input::get('candidateID');
		$positionID = Input::get('positionID'); 

		$total = 0;
		$getName = DB::select("SELECT surveyName FROM list_positions WHERE id='".$positionID."' ");	
		$surveyName =$getName[0]->surveyName;	
		if($surveyName=='kgwdID'){
			$condition = "WHERE 
							kgwdID_1='".$candidateID."' OR
							kgwdID_2='".$candidateID."' OR
							kgwdID_3='".$candidateID."' OR
							kgwdID_4='".$candidateID."' OR
							kgwdID_5='".$candidateID."' OR
							kgwdID_6='".$candidateID."' OR
							kgwdID_7='".$candidateID."' 
						";
		}else{
			$condition = "WHERE ".$surveyName."='".$candidateID."' ";
		}

		//get total from survey result
		$getSurvey = DB::select("SELECT COUNT(id) as total FROM survey_".$surveyID." ".$condition."  ");
		$total =$getSurvey[0]->total;

		//update main
		$update = DB::select("UPDATE candidates SET survey".$surveyID."='".$total."' WHERE id='".$candidateID."' ");


		$response = array('success' => true, 'total' => $total );	
		echo json_encode($response);
	}

	

}


