<?php include_once(app_path().'/includes/header.php');  ?>
<div class="app app-header-fixed  ">  
  <?php include_once(app_path().'/includes/header-menu.php');  ?>
  <?php include_once(app_path().'/includes/side-menu.php');  ?>

  <?php include_once(app_path().'/includes/common-list.php');  ?>


<?php
  $res = $settings[0];
  $photo = asset('img/bridge_small.jpg');
  $isPublic = "";
  $displayName = "";
  $birthDay = ""; $birthMonth=""; $birthYear = "";
  $immediate = $daily = $weekly = $newsletter = $campaign = "";

  $profileTab = $passwordTab = $emailTab = $currencyTab = '';
  switch($defaultTab){
    case 'profile': $profileTab = "active"; break;
    case 'changePassword': $passwordTab = "active"; break;
    case 'emailPreferences': $emailTab = "active"; break;
    case 'currency': $currencyTab = "active"; break;
    default:
      $profileTab = "active"; 
  }

  if(strlen($res->photo)>3) {
    // $photo = $res->photo;
    $photo = asset('img/uploads/'.$res->photo);
  }
  if($res->isPublic) $isPublic = "checked";
  if($res->displayName) $displayName = "checked";
  if($res->birthDate) {
    $b = explode('-',$res->birthDate); //Y-m-d
    $birthDay = $b[2];
    $birthMonth = $b[1];
    $birthYear = $b[0];
  }
  switch($res->emailUpdates){
    case 'i': $immediate = "checked"; break;
    case 'd': $daily = "checked"; break;
    case 'w': $weekly = "checked"; break;
  }
  if($res->emailNewsletter) { $newsletter = "checked"; }
  if($res->emailCampaign) { $campaign = "checked"; }

  // print_r($res->name);
?>

  <style type="text/css">
      .scf-box{ width:30% !important;}
      .input-group .form-control{ display:none;}
  </style>
  
  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

        <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="app.settings.asideFolded = false;app.settings.asideDock = false; ">
          <!-- main -->
          <div class="col">
            <!-- main header -->
            <div class="lter b-b wrapper-md">
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <h1 class="m-n h4 text-black">{{ $title }}</h1>
                </div>                
              </div>
            </div>
            <!-- / main header -->


            <div class="wrapper-md">          
              <!-- NOTIFICATION MESSAGE -->
                  <?php
                    if($message!=''){
                      if($success) $statusColor = "alert-success";
                      else $statusColor = "alert-danger";
                  ?>
                  <div class="alert {{ $statusColor }} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ $message }}
                  </div>
                  <?php } ?>
                   <!-- NOTIFICATION MESSAGE -->   

              <div class="tab-container">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="{{ $profileTab }}"><a href="#profile" data-toggle="tab">Profile </a></li>         
                  <li class="{{ $passwordTab }}"><a href="#changePassword" data-toggle="tab">Change Password </a></li>
                    <!-- <li><a href="#referrals" data-toggle="tab">Referrals </a></li>  -->                 
                </ul>

                <div class="tab-content">
                             

                  <!-- PROFILE TAB STARTS HERE -->
                  <div class="tab-pane {{ $profileTab }}" id="profile"> 

                       
                    <form role="form" action="/settings" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" style="padding-left:20px;padding-top:20px;">
                      <input type="hidden" name="settingsToUpdate" value="profile">
                      <div class="form-group text-center scf-box">
                        <img src="{{ $photo }}" class="img-circle"><br><br>                         
                        <input name="photo" ui-jq="filestyle" class="scf-box" type="file" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                      </div>
                      
                      <div class="form-group"><span class="h3 text-black">Legal Name</span></div>
                      <div class="form-group">
                        <label>First name</label>
                        <input type="text" name="firstName" value="{{ $res->firstName }}" class="form-control scf-box" placeholder="First name" required>
                      </div>
                      <div class="form-group">
                        <label>Last name</label>
                        <input type="text" name="lastName" value="{{ $res->lastName }}" class="form-control scf-box" placeholder="Last name" required>
                      </div>

                      <div class="form-group"><span class="h3 text-black">Display Name</span></div>
                      <div class="form-group">
                        <div class="checkbox">
                          <label class="i-checks">
                            <input type="checkbox"  name="displayName" checked="{{ $displayName }}" value="1">
                            <i></i> Same as legal name
                          </label>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ $res->email }}" class="form-control scf-box" placeholder="http://" required>
                      </div>
                      <div class="form-group">
                        <label>Telephone Number</label>
                        <input type="text" name="phone" value="{{ $res->phone }}" class="form-control scf-box" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>Date of Birth</label><br>
                        <nobr>
                        <select name="day" style="width:50px;height:34px;">
                          <?php for($d=1;$d<=31; $d++){ 
                                $selected = "";
                                $dd = $d;
                                if($dd<10) $dd = '0'.$dd;
                                if($dd==$birthDay) $selected = "selected";
                          ?>
                            <option value="{{ $dd }}" {{ $selected }}>&nbsp;&nbsp;{{ $d }}</option>
                          <?php }?>
                        </select>&nbsp;
                        <select name="month" class="" style="width:100px;height:34px;">
                          <?php $monthsArr = array('January','February','March','April','May','June','July','August','September','October','November','December'); ?>
                          <?php for($d=0; $d<count($monthsArr); $d++){  
                                $selected = "";
                                $mon = $d+1;
                                if($mon<10) $mon = '0'.$mon;
                                if($mon==$birthMonth) $selected = "selected";
                          ?>
                            <option value="{{ $mon }}" {{ $selected }} >&nbsp;&nbsp;{{ $monthsArr[$d] }}</option>
                          <?php }?>
                        </select>&nbsp;
                        <select name="year"class="" style="width:100px;height:34px;">
                          <?php for($d=date('Y');$d>=1945; $d--){  
                                $selected = "";
                                if($d==$birthYear) $selected = "selected";
                          ?>
                            <option value="{{ $d }}" {{ $selected }}>&nbsp;&nbsp;{{ $d }}</option>
                          <?php }?>
                        </select>
                        </nobr>
                      </div>


                      <div class="form-group">
                        <label>Country</label>
                        <select name="country" class="form-control scf-box">
                          <?php for($i=1;$i<count($countryArr); $i++){  
                                $selected = "";
                                if($countryArr[$i]==$res->country) $selected = "selected";
                          ?>
                            <option value="{{ $countryArr[$i] }}" {{ $selected }}>&nbsp;&nbsp;{{ $countryArr[$i] }}</option>
                          <?php }?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Address line 1</label>
                        <input type="text" name="address1" value="{{ $res->address1 }}" class="form-control scf-box" placeholder="Address line 1">
                      </div>
                      <div class="form-group">
                        <label>Address line 2</label>
                        <input type="text" name="address2" value="{{ $res->address2 }}" class="form-control scf-box" placeholder="Address line 2">
                      </div>
                      <div class="form-group">
                        <label>Post Code</label>
                        <input type="text" name="postCode" value="{{ $res->postCode }}" class="form-control scf-box" placeholder="Post code">
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" value="{{ $res->city }}" class="form-control scf-box" placeholder="City">
                      </div>
                      <div class="form-group">
                        <label>Region / State</label>
                        <input type="text" name="region" value="{{ $res->region }}" class="form-control scf-box" placeholder="Region">
                      </div>
                      <button type="submit" class="btn btn-success btn-md">Save</button>

                    </form>
                  </div>
                  <!-- PROFILE TAB ENDS HERE -->

                  <!-- CHANGE PASSWORD TAB STARTS HERE -->
                  <div class="tab-pane {{ $passwordTab }}" id="changePassword">
                    <form role="form" action="/settings" method="POST" style="padding-left:20px;padding-top:20px;">
                      <input type="hidden" name="settingsToUpdate" value="changePassword"> 
                      <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="currentPassword" class="form-control scf-box" placeholder="Current Password" required>
                      </div>
                      <div class="form-group">
                        <label>Enter New Password</label>
                        <input type="password" name="newPassword" class="form-control scf-box" placeholder="Enter New Password" required>
                      </div>
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control scf-box" placeholder="Confirm Password" required>
                      </div>
                      <button class="btn btn-success btn-md">Change Password</button>
                    </form>                  
                  </div>                

                  
                </div>
              </div>


            </div>
          </div>

      
        </div>


    </div>
  </div>
  <!-- / content -->

  
  <?php include_once(app_path().'/includes/footer.php');  ?>
</div>

<?php include_once(app_path().'/includes/common-js.php');  ?>


</body>
</html>