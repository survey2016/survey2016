
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
      <div class="row">
        <div class="col-sm-12 text-center">      
          <div class="btn-group" role="group" aria-label="...">   
          
          </div>
        </div>
      </div>
      <!-- stats -->
      <div class="row">
        <div class="wrapper-md">
          <div class="panel panel-default">
            
            <div class="panel-body b-b b-light">
              Search: <input id="filter" type="text" class="form-control input-sm w-sm inline m-r"/>
            </div>
            <div>
            
              <table id="dataTables" class="table m-b-none" style="border:none" ui-jq="footable" data-filter="#filter" data-page-size="5">
                <thead>
                  <tr>                      
                      <th data-toggle="true">Alias</th>
                      <th data-toggle="true">Name</th>
                      <th data-toggle="true">Type</th>
                      <th data-toggle="true">Email</th>
                      <th data-toggle="true">Phone</th>                           
                      <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($results as $res) { ?>
                    <tr>
                      <td class="text-left">{{ $res->name }}</td>
                      <td class="text-center">{{ $res->lastName }}, {{ $res->firstName }}</td>
                      <td class="text-center">{{ $res->userType }}</td>
                      <td class="text-left">{{ $res->email }}</td>                      
                      <td class="text-center">{{ $res->phone }}</td>
                      <td>
                        <a href="" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot class="hide-if-no-paging">
                  <tr>
                      <td colspan="5" class="text-center">
                          <ul class="pagination"></ul>
                      </td>
                  </tr>
                </tfoot>
              </table>
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
