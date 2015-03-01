<input type="hidden" name="platform" id="platformInput" value="">
<input type="hidden" name="loc_country" id="locationInput" value="">
<input type="hidden" name="advanced" id="advancedInput" value="">
<?php
  $active = 'btn-warning';
  $default = 'btn-default';
  $platformStatus = $locationStatus = $advancedStatus = $default;
  if($filters['platform']!='') { $platformStatus = $active; } 
  if($filters['loc_country']!='') { $locationStatus = $active; } 
  // if($filters['loc_country']!='') { $locationStatus = $active; } 
?>

<button type="button" class="btn <?php echo $platformStatus; ?> btn-sm" onclick="showPopup('platform')" id="platformFilterBtn"><i class="fa fa-tags"></i>&nbsp; Platform</button>&nbsp;
<button type="button" class="btn <?php echo $locationStatus; ?> btn-sm" onclick="showPopup('location')" id="locationFilterBtn"><i class="fa fa-map-marker"></i>&nbsp; Location</button>&nbsp;                          
<!-- <button type="button" class="btn <?php //echo $advancedStatus; ?> btn-sm" onclick="showPopup('advanced')" id="advancedFilterBtn"><i class="fa fa-filter"></i>&nbsp; Advanced</button>&nbsp; -->
  
    <?php if($title=='All Companies'){ ?>
    <div class="form-group">
      <?php 
          $statusList = array(
                  'all'=>'Show All',
                  'Open'=>'Open',
                  'Closed'=>'Closed'
                );  
      ?>
      <select class="form-control input-sm" name="status" id="status">
          <?php foreach ($statusList as $k=>$v) { 
                  $def = '';
                  if($filters['status'] == $k) $def = 'selected';
          ?>
                 <option value="<?php echo $k; ?>" <?php echo $def; ?> ><?php echo $v; ?></option>
          <?php } ?>
      </select>
    </div>
    <?php } ?>

    <?php if($title=='Funded Deals'){ ?>
      <div class="form-group">
        <label for="fromDate">From</label>
        <input type="text" name="fromDate" id="fromDate" value="<?php echo $filters['fromDate']; ?>" class="form-control input-sm" style="width:94px;">
        <label for="toDate">to</label>
        <input type="text" name="toDate" id="toDate" value="<?php echo $filters['toDate']; ?>" class="form-control input-sm" style="width:94px;">  
      </div>
    <?php } ?>

  <?php if($title!='Investor Club'){ ?>
    <div class="form-group">
      <select class="form-control input-sm" name="sort" id="sort" style="width:90px;">
        <option value="">Sort By</option>
          <?php 
              $sortList = array(
                      'new-listings'=>'New Listings',
                      'new-commitments'=>'New Commitments' ,
                      'trending'=>'Trending',
                      'nearing-target'=>'Nearing Target',
                      'overfunded'=>'Overfunded',
                      'ending-soon'=>'Ending Soon'
                    );    
          ?>

          <?php foreach ($sortList as $k => $v) { 
                  $def = '';
                  if($filters['sort'] == $k) $def = 'selected';
          ?>
                 <option value="<?php echo $k; ?>" <?php echo $def; ?>><?php echo $v; ?></option>
          <?php } ?>  
      </select>
    </div>

    <div class="form-group">
      <label class="sr-only" for="keywords">Keywords</label>
      <input type="text" class="form-control input-sm" name="keywords"  id="keywords" value="<?php echo $filters['keywords']; ?>" maxlength='20' placeholder="Keywords">
    </div>
  <?php } ?>

  <button type="submit" class="btn btn-sm btn-default">Go</button>