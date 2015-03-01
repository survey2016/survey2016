
<?php include_once(app_path().'/includes/header.php');  ?>
<div class="app app-header-fixed  ">  
  <?php include_once(app_path().'/includes/header-menu.php');  ?>

  <?php 
    if(Session::get('userType')!='T'){
      include_once(app_path().'/includes/side-menu.php');  
    }
  ?>

  <style type="text/css">
  table#tagTable td{ vertical-align: middle; }
  </style>

  <?php
    $defaults = array(7);
    $defaultMarginLeft = 200;
    if(Session::get('userType')=='T'){
      $defaultMarginLeft = 0;
    }
  ?>

  <!-- content -->

  <div id="content" class="app-content" role="main" style="margin-left:{{ $defaultMarginLeft }}">
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
          <?php
            $positionArr = array(); 
            foreach($listOfPositions as $pos){ 

          ?>
                  <button class="btn btn-md btn-info" onclick="showPosition({{ $pos->id }})">{{ $pos->name }} </button>
          <?php 
            } 
          ?>
          </div>
        </div>
      </div>
      <!-- stats -->
      <div class="row">
        <div class="wrapper-md">
          <div class="panel panel-default">
            <div class="panel-heading">
              List of Voters
            </div>
            <div class="panel-body b-b b-light">
              Search: <input id="filter" type="text" class="form-control input-sm w-sm inline m-r"/>
            </div>
            <div>
            <?php
              $score = array();
              foreach($listOfVoters as $voters){   
                if($voters->presID!='-1')
                  $score[$voters->presID]['yn'][] = $voters->presID; 
                else
                  $score[1]['u'][] = $voters->presID;

                if($voters->vpresID!='-1')
                  $score[$voters->vpresID]['yn'][] = $voters->vpresID; 
                else
                  $score[2]['u'][] = $voters->vpresID;

                if($voters->govID!='-1')
                  $score[$voters->govID]['yn'][] = $voters->govID;
                else
                  $score[3]['u'][] = $voters->govID;

                if($voters->vgovID!='-1') 
                  $score[$voters->vgovID]['yn'][] = $voters->vgovID;  
                else
                  $score[4]['u'][] = $voters->vgovID;

                if($voters->congID!='-1')
                  $score[$voters->congID]['yn'][] = $voters->congID;
                else
                  $score[5]['u'][] = $voters->congID;

                if($voters->vocalID!='-1')  
                  $score[$voters->vocalID]['yn'][] = $voters->vocalID;
                else
                  $score[6]['u'][] = $voters->vocalID;

                if($voters->mayorID!='-1') 
                  $score[$voters->mayorID]['yn'][] = $voters->mayorID;
                else
                  $score[7]['u'][] = $voters->mayorID;

                if($voters->vmayorID!='-1') 
                  $score[$voters->vmayorID]['yn'][] = $voters->vmayorID; 
                else
                  $score[8]['u'][] = $voters->vmayorID;
              }

              // echo "<pre>";
              // print_r($score);
              // echo "</pre>";
            ?>
              <table id="tagTable" class="table m-b-none" ui-jq="footable" data-filter="#filter" data-page-size="5">
                <thead>
                  <tr>
                      <th data-toggle="true">
                          Name
                      </th>
                      <?php 
                        foreach ($listOfCandidates as $cand) { 
                          $display = 'none';
                          if(in_array( $cand->positionID, $defaults) ){
                            $display = 'table-cell';
                          }
                          $candidateID = $cand->id;
                          $scoreDisp = 0;
                          if(isset($score[$candidateID])){
                            $scoreDisp = count($score[$candidateID]['yn']);
                          }
                      ?>
                        <th class="text-center pos_{{ $cand->positionID }} pos" style="display: {{ $display }}">
                          <div class="text-info" id="candidateTotal_{{ $cand->id }}">{{ $scoreDisp }}</div>
                          {{ strtoupper($cand->lastName) }}, {{ $cand->firstName }}
                        </th>
                      <?php 
                        
                      }
                      ?>  
                      <?php 
                        $posIDArr = array();
                        foreach ($listOfCandidates as $cand) { 
                          $positionID = $cand->positionID;
                          if(!in_array($positionID, $posIDArr)){
                            $posIDArr[] = $positionID;
                            $display = 'none';
                            if(in_array($positionID, $defaults) ){
                              $display = 'table-cell';
                            }

                          $scoreDisp = 0;
                          if(isset($score[$positionID])){
                            $scoreDisp = count($score[$positionID]['u']);
                          }
                      ?>
                      <th class="text-center pos_{{ $cand->positionID }} pos" style="display: {{ $display }}">
                        <div class="text-info" id="undecidedTotal_{{  $positionID }}">{{ $scoreDisp }}</div>
                        Undecided
                      </th>
                      <?php 
                        }
                      }
                      ?>  
                  </tr>
                </thead>

                <tbody>
                  <?php 
                    foreach($listOfVoters as $voters){ 
                      $votersID = $voters->voters_id;
                  ?>

                  <tr>
                      <td>{{ strtoupper($voters->lastName) }}, {{ $voters->firstName }}</td>
                      
                      <?php 
                        foreach ($listOfCandidates as $cand) { 
                          $positionID = $cand->positionID;
                          $display = 'none';
                          if(in_array($positionID, $defaults) ){
                            $display = 'table-cell';
                          }
                          $field = '';
                          switch($positionID){
                            case 1: $field = $voters->presID; break;
                            case 2: $field = $voters->vpresID; break;
                            case 3: $field = $voters->govID; break;
                            case 4: $field = $voters->vgovID; break;
                            case 5: $field = $voters->congID; break;
                            case 6: $field = $voters->vocalID; break;
                            case 7: $field = $voters->mayorID; break;
                            case 8: $field = $voters->vmayorID; break;
                          }                      
                        
                          $ticked = '';
                          if($field==$cand->id){
                            $ticked = 'checked';
                          }
                      ?>
                        <td class="text-center pos_{{ $positionID }} pos" style="display: {{ $display }}">
                          <div class="m-b-xs m-t">
                            <label class="i-checks i-checks-lg">
                              <input type="radio" {{ $ticked }} name="voter_{{ $votersID }}_{{ $positionID }}" class="box_{{ $cand->id }}" value="{{ $cand->id }}" onclick="castSurvey({{ $votersID }}, {{ $positionID }}, {{ $cand->id }} )">
                              <i id="circle_{{ $votersID }}_{{ $positionID }}_{{ $cand->id}}"></i>                            
                            </label>
                          </div>
                          <small>{{ strtoupper($cand->lastName).', '.$cand->firstName }}</small>
                        </td>
                      <?php 
                      }
                      ?> 
                      <?php 
                        $posIDArr = array();
                        foreach ($listOfCandidates as $cand) { 
                          $positionID = $cand->positionID;
                          if(!in_array($positionID, $posIDArr)){
                            $posIDArr[] = $positionID;
                            $display = 'none';
                            if(in_array($positionID, $defaults) ){
                              $display = 'table-cell';
                            }

                            $field = '';
                            switch($positionID){
                              case 1: $field = $voters->presID; break;
                              case 2: $field = $voters->vpresID; break;
                              case 3: $field = $voters->govID; break;
                              case 4: $field = $voters->vgovID; break;
                              case 5: $field = $voters->congID; break;
                              case 6: $field = $voters->vocalID; break;
                              case 7: $field = $voters->mayorID; break;
                              case 8: $field = $voters->vmayorID; break;
                            }

                            $ticked = '';
                            if($field=='-1'){
                              $ticked = 'checked';
                            }
                      ?>
                      <td class="text-center pos_{{ $positionID }} pos" style="display: {{ $display }}">
                        <div class="m-b-xs m-t">
                          <label class="i-checks i-checks-lg">
                            <input type="radio" {{ $ticked }} name="voter_{{ $votersID }}_{{ $positionID }}" class="box_{{ $positionID }}" value="-1" onclick="castSurvey({{ $votersID }}, {{ $positionID }}, -1 )">>
                            <i id="circle_{{ $votersID }}_{{ $positionID }}_0"></i>                            
                          </label>
                        </div>
                        <small>Undecided</small>
                      </td> 
                      <?php 
                        }
                      }
                      ?>  
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

  function showPosition(posID){
    $('.pos').hide();
    $('.pos_'+posID).show();
  }

  function castSurvey(votersID, positionID, candidateID){    
    //update HEADER TOTALS
    if(candidateID=='-1'){
      $('#circle_'+votersID+'_'+positionID+'_0').css('border-color','orange');
    }else{
      $('#circle_'+votersID+'_'+positionID+'_'+candidateID).css('border-color','orange');
    }

    $.post('updateSurveySingle', { votersID:votersID, candidateID:candidateID, positionID:positionID }, function(res){
      if(res.success){
        if(candidateID=='-1'){
          $('#circle_'+votersID+'_'+positionID+'_0').css('border-color','#23b7e5');
        }else{
          $('#circle_'+votersID+'_'+positionID+'_'+candidateID).css('border-color','#23b7e5');
        }
        //UPDATE TOTALS
        $("input[name=voter_"+votersID+"_"+positionID+"]").each(function(){
          var total = 0;
          var candID = $(this).val();
          if(candID=='-1'){
            $(".box_"+positionID).each(function(){
              if($(this).is(':checked')){
                total++;
              }      
            });
            $('#undecidedTotal_'+positionID).html(total);
          }else{
            $(".box_"+candID).each(function(){
              if($(this).is(':checked')){
                total++;
              }      
            });
            $('#candidateTotal_'+candID).html(total);
          }      
        });   
      }
    },'json');

  }

  
    
  
</script>
</body>
</html>
