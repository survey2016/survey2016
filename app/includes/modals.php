<!-- PLATFORM FILTER -->
<div class="modal fade" id="platformModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Platform</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php
              
              $ctr = 1; $limit = round(count($platformOptions) / 3) + 1;
              $defFilters = $filters['platform'];
              $defFilters = explode('|', $defFilters); 
              foreach ($platformOptions as $p) { 
                  $def = '';
                  if(in_array($p->platform, $defFilters) ) $def = 'checked';
          ?>    

            <?php if($ctr==1){ ?>    
            <div class="col-md-4">
            <?php } ?>

              <div class="form-group">
                <label class="checkbox-inline i-checks">
                  <input type="checkbox" class="platformBoxes" name="platformBoxes" value="<?php echo  $p->platform; ?>" <?php echo $def; ?> ><i></i> <?php echo  $p->platform; ?>
                </label>
              </div>

            <?php 
              if($ctr==$limit){
                $ctr=0; //reset
            ?> 
            </div>
            <?php } ?>

          <?php 
              $ctr++;
              } 
          ?> 
          </div>       
        </div>      
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-primary" onclick="applyFilter('platform')">Apply</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- LOCATION FILTER 1-->
  <?php if(count($loc_countryOptions)<=10){ ?>
      <div class="modal fade" id="locationModal">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Select Location</h4>
            </div>
            <div class="modal-body">
              <?php
                  $defFilters = $filters['loc_country'];
                  $defFilters = explode('|', $defFilters);
                  $ctr = 0; 
                  foreach ($loc_countryOptions as $p) { 
                      $def = '';
                      if(in_array($p->loc_country, $defFilters) ) $def = 'checked';
              ?>                        
                  <div class="form-group">
                    <label class="checkbox-inline i-checks">
                      <input type="checkbox" class="locationBoxes" name="locationBoxes" value="<?php echo  $p->loc_country; ?>" <?php echo $def; ?> ><i></i> <?php echo  $p->loc_country; ?>
                    </label>
                  </div>
              <?php 
                  $ctr++;
                  } 
              ?>       
            </div>
            <div class="modal-footer">        
              <button type="button" class="btn btn-primary" onclick="applyFilter('location')">Apply</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

  <?php }else{ ?>
      <div class="modal fade" id="locationModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Select Location</h4>
            </div>
            <div class="modal-body">
              <div class="row">
              <?php
                  $defFilters = $filters['loc_country'];
                  $defFilters = explode('|', $defFilters);
                  $ctr = 1; $limit = round(count($loc_countryOptions) / 3) + 1;
                  foreach ($loc_countryOptions as $p) { 
                      $def = '';
                      if(in_array($p->loc_country, $defFilters) ) $def = 'checked';
              ?>    

                <?php if($ctr==1){ ?>    
                <div class="col-md-4">
                <?php } ?>

                  <div class="form-group">
                    <label class="checkbox-inline i-checks">
                      <input type="checkbox" class="locationBoxes" name="locationBoxes" value="<?php echo  $p->loc_country; ?>" <?php echo $def; ?> ><i></i> <?php echo  $p->loc_country; ?>
                    </label>
                  </div>

                <?php 
                  if($ctr==$limit){
                    $ctr=0; //reset
                ?> 
                </div>
                <?php } ?>

              <?php 
                  $ctr++;
                  } 
              ?> 
              </div>       
            </div>
            <div class="modal-footer">        
              <button type="button" class="btn btn-primary" onclick="applyFilter('location')">Apply</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
  <?php }?>

<!-- SORT FILTER -->
<div class="modal fade" id="advancedModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Advanced Filter</h4>
      </div>
      <div class="modal-body">
                
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-primary btn-sm" onclick="applyFilter('sort')">Apply</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- SAVE FILTER -->
<div class="modal fade" id="filterModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Save Filters</h4>
      </div>
      <div class="modal-body">
        <input type="text" value="" class="form-control" placeholder="Enter name..." id="filterName" maxlength="50">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveFilter('<?php echo $page;?>')">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

