<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){		
	if(!Auth::check()){	return Redirect::to('/login'); }
	return Redirect::to('/dashboard');	
});

Route::get('register', function(){
	if(!Auth::check()){	return Redirect::to('/login'); }	
	$data = array(
			'title' => 'Register'
			);
	return View::make('register',$data);
});

// Route::post('register', function(){
Route::post('register', array('before' => 'csrf', function(){
	$theEmail = Input::get('email');
	$exists = DB::select('select * from users where email = ?', array($theEmail));
	if(!$exists){
		//save it
		$user = new User;
		$user->name = Input::get('name');
		$user->email = $theEmail;
		$user->password = Hash::make(Input::get('password'));
		$user->save();
		$data = array(
			'title' => 'Thank You!',
			'theEmail' => Input::get('email')
			);
		return View::make('thanks',$data);
	}else{
		$data = array(
			'title' => 'Email already registered!',
			'theEmail' => Input::get('email')
			);
		return View::make('exists',$data);
	}	
}));

Route::get('login', function(){
	$data = array('title' => 'Login');
	return View::make('login',$data);
});

// Route::post('login', function(){
Route::post('login', array('before' => 'csrf', function(){
	$credentials = Input::only('email','password');
	if(Auth::attempt($credentials)){
		$theEmail = Input::get('email');
		$result = DB::select('SELECT id, name, firstName, lastName, photo, displayName, userType FROM users WHERE email = ?', array($theEmail));
		if($result[0]->displayName){
			Session::put('user', $result[0]->firstName.' '.$result[0]->lastName);
		}else{
			Session::put('user', $result[0]->name);
		}
		
		Session::put('photo', $result[0]->photo);
		Session::put('userType', $result[0]->userType);
		Session::put('email', $theEmail);		

		if($result[0]->userType == 'A'){
			return Redirect::intended('/dashboard');
		}elseif($result[0]->userType == 'T'){
			$tagInfo = DB::select('SELECT provinceID, districtID, townID, brgyID FROM taggers WHERE userID = ?', array($result[0]->id));
			Session::put('provinceID', $tagInfo[0]->provinceID);
			Session::put('districtID', $tagInfo[0]->districtID);
			Session::put('townID', $tagInfo[0]->townID);
			Session::put('brgyID', $tagInfo[0]->brgyID);
			return Redirect::intended('/tag');
		}else{
			return Redirect::to('/login');
		}
		
	}
	return Redirect::to('/login');
}));

Route::get('logout', function(){
	// Session::flush();
	Auth::logout();
	$data = array('title' => 'Logout');
	return View::make('logout',$data);
});

//MAIN PAGES
Route::get('dashboard', array('before' => 'auth','uses' => 'DashboardController@main'));
Route::get('tag', array('before' => 'auth','uses' => 'TagController@main'));
Route::get('candidates/{id}', array('before' => 'auth','uses' => 'CandidatesController@getCandidate'));
Route::get('candidates', array('before' => 'auth','uses' => 'CandidatesController@main'));
Route::get('voters', array('before' => 'auth','uses' => 'VotersController@main'));
Route::get('taggers', array('before' => 'auth','uses' => 'TaggersController@main'));
Route::get('users', array('before' => 'auth','uses' => 'UsersController@main'));
Route::get('positions', array('before' => 'auth','uses' => 'PositionsController@main'));
Route::get('locations', array('before' => 'auth','uses' => 'LocationsController@main'));
Route::get('others', array('before' => 'auth','uses' => 'OthersController@main'));
Route::get('settings', array('before' => 'auth','uses' => 'SettingsController@main'));
Route::post('settings', array('before' => 'auth','uses' => 'SettingsController@update'));

//AJAX CALLS
Route::post('updateSingle', array('before' => 'auth','uses' => 'AJAXController@updateSingle')); //FORCE UPDATE
Route::post('updateSurveySingle', array('before' => 'auth','uses' => 'AJAXController@updateSurveySingle')); //add survey
Route::post('updateStatus', array('before' => 'auth','uses' => 'AJAXController@updateStatus')); //update stat1, stat2..








