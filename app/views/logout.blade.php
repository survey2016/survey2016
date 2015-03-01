<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>eSURVEY | Logged Out</title>
  <?php include_once(app_path().'/includes/common-css.php');  ?> 

</head>
<body style="background-image:url(<?php echo asset('img/bridge.jpg'); ?>);background-size: cover;color:#fff;">
<div class="app app-header-fixed  ">
  

<div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">
  <a href class="navbar-brand block m-t" style="color:#fff;"><i style="font-size: 20px;">e</i><span style="color:#23b7e5;">SURVEY</span></a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>You have successfully logged out.</strong>
    </div>
   
      
      <a href="/login" class="btn btn-lg btn-default btn-block">Go to Log-in ?</a>
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <small class="text-muted" style="color:#fff;">eSURVEY<br>&copy; 2015</small>
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