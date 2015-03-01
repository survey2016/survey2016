<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>eSURVEY | Login</title>
  <?php include_once(app_path().'/includes/common-css.php');  ?> 

</head>
<body style="background-image:url(<?php echo asset('img/bridge.jpg'); ?>);background-size: cover;color:#fff;">
<div class="app app-header-fixed  ">
  

<div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
  <a href class="navbar-brand block m-t" style="color:#fff;">
    <i style="font-size: 20px;">e</i><span style="color:#23b7e5;">SURVEY</span>
  </a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>Log in to get in touch</strong>
    </div>
    {{ Form::open(array('url'=>'login', 'role'=>'form', 'class'=>'form-validation')) }}
      <div class="text-danger wrapper text-center" ng-show="authError">
          
      </div>
      <div class="list-group list-group-sm">
        <div class="list-group-item">
             <!-- <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus> -->
            <input type="email" placeholder="Email" class="form-control no-border" name="email" required autofocus>
        </div>
        <div class="list-group-item">
           <input type="password" placeholder="Password" class="form-control no-border" name="password" required>
           <!-- <input class="form-control" placeholder="Password" name="password" type="password" value=""> -->
        </div>
      </div>
      <button type="submit" class="btn btn-lg btn-info btn-block">Log in</button>
      <div class="text-center m-t m-b"><a ui-sref="access.forgotpwd"  style="color:#fff;">Forgot password?</a></div>
      <div class="line line-dashed"></div>
      
    {{ Form::close() }}
      <p class="text-center"><small>Do not have an account?</small></p>
      <a href="/register" class="btn btn-lg btn-default btn-block">Create an account</a>
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <small class="text-muted"  style="color:#fff;">eSURVEY<br>&copy; 2015</small>
</p>
  </div>
</div>


</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>

</body>
</html>