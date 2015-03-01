<div class="lter b-b wrapper-md">
  <div class="row">
    <?php
      $currentBtn = 'style="color:#23b7e5"';
      $listSearchBtn = $allDataBtn = $trendsBtn = $analyticsBtn = 'style="color:#ccc"';
      switch($defaultTab){
        case 'list-search': $listSearchBtn = $currentBtn; break;
        case 'all-data': $allDataBtn = $currentBtn; break;
        case 'trends': $trendsBtn = $currentBtn; break;
        case 'analytics': $analyticsBtn = $currentBtn; break;
        default: $listSearchBtn = $currentBtn;
      }
    ?>
    <div class="col-md-12">
      <a href="/compare/list-search" class="sectionBtn"  <?php echo $listSearchBtn; ?> ><i class="fa fa-bars"></i> List Search</a>
      <a href="/compare/all-data" class="sectionBtn"  <?php echo $allDataBtn; ?> ><i class="fa fa-database"></i> All Data</a>
      <a href="/compare/trends" class="sectionBtn" <?php echo $trendsBtn; ?> ><i class="fa fa-paper-plane"></i> Trends</a>
      <a href="/compare/analytics" class="sectionBtn" <?php echo $analyticsBtn; ?> ><i class="fa fa-bar-chart-o"></i> Analytics</a>
    </div>
  </div>
</div>  

