<?php

class SettingsController extends BaseController {

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
		
		
		$results = DB::select("SELECT * FROM users WHERE id ='".Auth::id()."' ");
		
		$data = array(
			'title' => 'Settings',
			'message' => '',
			'defaultTab' => 'profile',
			'settings'=> $results
		);
		return View::make('settings',$data);	
	}

	public function update(){	
		// include(app_path().'/includes/s3/image_check.php');	
		// include(app_path().'/includes/s3/S3.php');
		

		$mode = Input::get('settingsToUpdate');
		$defaultTab = "profile";
		$success = false;
		$message = '';
	    $filename  = Session::get('photo');
	    $fileUpload = true;
	    
	    if (Input::hasFile('photo')) {
	    	if ( Input::file('photo')->isValid() && Input::file('photo')->getSize() < 1000000)
			{
				// include(app_path().'/includes/s3/s3_config.php');
				$file            = Input::file('photo');
				$tmp = Input::file('photo')->getRealPath();
		        $destinationPath =  public_path().'/img/uploads/';
		        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
		        $file->move($destinationPath, $filename);
		        $fileUpload = true;
		    }else{
		    	$fileUpload = false;

		    }
		}
	    /*//process image upload
	    if (Input::hasFile('photo')) {
	    	if ( Input::file('photo')->isValid() && Input::file('photo')->getSize() < 1000000)
			{
				// include(app_path().'/includes/s3/s3_config.php');
				$file            = Input::file('photo');
				$tmp = Input::file('photo')->getRealPath();
		        $destinationPath =  public_path().'/img/uploads/';
		        $filename        = str_random(6) . '_' . $file->getClientOriginalName();
		        $file->move($destinationPath, $filename);
		        // $bucket = 'scfprofile';

		  //       echo '<br>'.public_path().'/img/uploads/'.$filename;
				// echo '<br>temp :'.$tmp;

				//source: https://github.com/aws/aws-sdk-php-laravel
				// $s3 = App::make('aws')->get('s3');
				// $s3->putObject(array(
				//     'Bucket'     => $bucket,
				//     'Key'        => 'AKIAJ75CH6GEKPX2M3TA',
				//     'SourceFile' =>  $tmp
				// ));

				// $s3 = AWS::get('s3');
				// if($s3->putObject(array(
				//     'Bucket'     => 'scfprofile',
				//     'Key'        => 'AKIAJ75CH6GEKPX2M3TA',
				//     'SourceFile' => public_path().'/img/uploads/'.$filename,
				// 	))){
				// 	echo 'success';
				// }else{
				// 	echo 'failed';
				// }
				
				// echo '<br>http://'.$bucket.'.s3.amazonaws.com/'.$filename;
				// echo '<br><img src="http://'.$bucket.'.s3.amazonaws.com/'.$filename.'" >';
				// exit();
				//'/the/path/to/the/file/you/are/uploading.ext',
		     

		        $tmp = Input::file('photo')->getRealPath();
		        $filename = time().".".Input::file('photo')->getClientOriginalExtension();
		        if($s3->putObjectFile($tmp, $bucket , $filename, S3::ACL_PUBLIC_READ) ){
					// echo "S3 Upload Successful.";	
					$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$filename;
					// echo "<img src='$s3file' style='max-width:400px'/><br/>";
					// echo '<b>S3 File URL:</b>'.$s3file;
					
					//check if old picture exist
					$oldPhoto = Session::get('photo');
					if( strlen($oldPhoto)>4 ){
						//delete old image
						$o = explode('com/', $oldPhoto);
						if(count($o)>1){
							$oldFileName = $o[1];
							// echo '<br>old file: http://scfprofile.s3.amazonaws.com/1422021613.jpg';
							$s3->deleteObject($bucket, $oldFileName);
						}
					}

					Session::put('photo', $s3file);
					$fileUpload = true;
				}else{
					// echo "S3 Upload Fail.";
					$fileUpload = false;
				}		        
		    }
	    }*/

		switch($mode){
			case 'profile': 
				//temporary override
				$s3file = $filename;
				Session::put('photo', $s3file);
				// $fileUpload = true;

				if(!$fileUpload){
					$message = "<b>Ups!</b> You're file was not uploaded. Max-size is 50kb. ";	
				}else{
					//process birthDate
	    			$birthDate =  Input::get('year').'-'.Input::get('month').'-'.Input::get('day');

					$result = DB::table('users')
	           			 	->where('id', Auth::id())
		            		->update(
				            	array(
				            		'email' => Input::get('email'),
				            		'photo' => $s3file, 
				            		'isPublic' => Input::get('isPublic'), 
				            		'firstName' => Input::get('firstName'), 
				            		'lastName' => Input::get('lastName'), 
				            		'displayName' => Input::get('displayName'), 
				            		'facebook' => Input::get('facebook'), 
				            		'twitter' => Input::get('twitter'), 
				            		'linkedIn' => Input::get('linkedIn'), 
				            		'website' => Input::get('website'),
				            		'angelList' => Input::get('angelList'), 
				            		'phone' => Input::get('phone'), 
				            		'birthDate' => $birthDate, 
				            		'country' => Input::get('country'), 
				            		'address1' => Input::get('address1'), 
				            		'address2' => Input::get('address2'), 
				            		'postCode' => Input::get('postCode'), 
				            		'city' => Input::get('city'), 
				            		'region' => Input::get('region'), 
				            		'emailUpdates' => Input::get('emailUpdates'), 
				            		'emailNewsletter' => Input::get('emailNewsletter'), 
				            		'emailCampaign' => Input::get('emailCampaign'), 
				            		'shortBio' => Input::get('shortBio')
				            	)
		            	);
					if($result) {					
						$success = true;
						$message = "<b>Well done!</b> You have successfully updated your profile.";					
					}
				}
				$defaultTab = "profile";
			break;
			case 'changePassword':
				// $currentPassword = Input::get('currentPassword');
				$currentPassword = Input::get('currentPassword');
				$newPassword = Input::get('newPassword');
				$confirmPassword = Input::get('confirmPassword');
				if($newPassword == $confirmPassword){

					$credentials = Input::only('email','password');

					if( Auth::attempt(array('email' => Session::get('email'), 'password' => $currentPassword)) ){
						DB::select("UPDATE users SET password='".Hash::make($newPassword)."' WHERE id ='".Auth::id()."' ");
						$success = true;
						$message = "<b>Well done!</b> You have successfully changed your password.";						
					}else{
						$message = "<b>Ups!</b> old password do not match.";
					}
				}else{
					$message = "<b>Ups!</b> confirm password do not match.";
				}
				$defaultTab = "changePassword";
			break;
			case 'emailPreferences':
				$emailUpdates = Hash::make(Input::get('emailUpdates'));
				$emailNewsletter = Input::get('emailNewsletter');
				$emailCampaign = Input::get('emailCampaign');


					$result = DB::table('users')
	           			 	->where('id', Auth::id())
		            		->update(
				            	array(
				            		'emailUpdates' => Input::get('emailUpdates'),
				            		'emailNewsletter' => Input::get('emailNewsletter'), 
				            		'emailCampaign' => Input::get('emailCampaign')
				            	)
		            		);
				if($result){
					$success = true;
					$message = "<b>Well done!</b> You have successfully updated your email preferences.";										
				}else{
					$message = "<b>Ups!</b> please try again later.";
				}
				$defaultTab = "emailPreferences";
			break;
			case 'currency':
				$currency = Input::get('currency');
					$result = DB::table('users')
	           			 	->where('id', Auth::id())
		            		->update( array('currency' => $currency) );
				if($result){
					$success = true;
					$message = "<b>Well done!</b> You have successfully updated your currency preference.";										
				}else{
					$message = "<b>Ups!</b> please try again later.";
				}
				$defaultTab = "currency";
				Session::put('currency', $currency);
			break;
		}
		
		$results = DB::select("SELECT * FROM users WHERE id ='".Auth::id()."' ");
		$data = array(
			'title' => 'Settings',
			'success'=> $success,
			'message' => $message,
			'defaultTab' => $defaultTab,
			'settings'=> $results
		);
		return View::make('settings',$data);
	}


}
