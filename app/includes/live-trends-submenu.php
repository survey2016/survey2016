<div class="lter b-b wrapper-md">
  <div class="row">
    <?php
      $currentBtn = 'style="color:#23b7e5"';
      $overallBtn = $platformBtn = $sectorBtn = $locationBtn = 'style="color:#ccc"';
      switch($defaultTab){
        case 'overall': $overallBtn = $currentBtn; break;
        case 'platform': $platformBtn = $currentBtn; break;
        case 'sector': $sectorBtn = $currentBtn; break;
        case 'location': $locationBtn = $currentBtn; break;
      }
    ?>
    <div class="col-md-12">
      <a href="/live-trends/overall" class="sectionBtn"  <?php echo $overallBtn; ?> ><i class="fa fa-globe"></i> Overall</a>
      <a href="/live-trends/platform" class="sectionBtn"  <?php echo $platformBtn; ?> ><i class="fa fa-tags"></i> Platform</a>
      <a href="/live-trends/sector" class="sectionBtn" <?php echo $sectorBtn; ?> ><i class="fa fa-flag"></i> Sector</a>
      <a href="/live-trends/location" class="sectionBtn" <?php echo $locationBtn; ?> ><i class="fa fa-map-marker"></i> Location</a>
    </div>
  </div>
</div>