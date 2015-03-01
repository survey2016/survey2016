
<?php include_once(app_path().'/includes/header.php');  ?>
<div class="app app-header-fixed  ">  
  <?php include_once(app_path().'/includes/header-menu.php'); ?>
  <?php  include_once(app_path().'/includes/side-menu.php');  ?>


  <!-- content -->

  <div id="content" class="app-content" role="main" >
    <div class="app-content-body ">
      

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <!-- <div class="col"> -->
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <h1 class="m-n font-thin h3 text-black">{{ $title }}</h1>
          <small class="text-muted">Overview </small>

        </div>
        <div class="col-sm-6 text-right hidden-xs">         
         
        </div>
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

      <!-- stats -->
      <div class="row">
        <div class="col-md-3">
          <div class="wrapper-md">
            <div class="panel panel-default">
              <div class="panel-heading b-b b-light">
                Current Survey
              </div>
              <div class="panel-body b-b b-light">

                <div class="form-group text-center">
                  <label class="i-checks i-checks-lg">
                    <input type="radio" name="surveyNo" value="1" checked>
                    <i></i>
                    Survey 1
                  </label>&nbsp;&nbsp;
                </div>
                <div class="form-group text-center">
                  <label class="i-checks i-checks-lg">
                    <input type="radio" name="surveyNo" value="2">
                    <i></i>
                    Survey 2
                  </label>&nbsp;&nbsp;
                </div>
                <div class="form-group text-center">
                  <label class="i-checks i-checks-lg">
                    <input type="radio" name="surveyNo" value="3">
                    <i></i>
                    Survey 3
                  </label>&nbsp;&nbsp;
                </div>
                <div class="form-group text-center">
                  <label class="i-checks i-checks-lg">
                    <input type="radio" name="surveyNo" value="4">
                    <i></i>
                    Survey 4
                  </label>
                
                </div>
                

              </div>              
            </div>
          </div>
        </div>

      </div>
    </div>
  <!-- </div> -->
  <!-- / main -->

</div>


    </div>
  </div>
  <!-- / content -->

  
  <?php include_once(app_path().'/includes/footer.php');  ?>
</div>


<script src="<?php echo asset('js/jquery.min.js'); ?>"></script>
<script src="<?php echo asset('js/bootstrap.js'); ?>"></script>
<script src="<?php echo asset('js/ui-load.js'); ?>"></script>
<script src="<?php echo asset('js/ui-jp.config.js'); ?>"></script>
<script src="<?php echo asset('js/ui-jp.js'); ?>"></script>
<script src="<?php echo asset('js/ui-nav.js'); ?>"></script>
<script src="<?php echo asset('js/ui-toggle.js'); ?>"></script>


<script type="text/javascript">
  $(function () {



  });

  

  
    
  
</script>
</body>
</html>
