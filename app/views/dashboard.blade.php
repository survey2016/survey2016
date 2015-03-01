
<?php include_once(app_path().'/includes/header.php');  ?>
<div class="app app-header-fixed  ">  
  <?php include_once(app_path().'/includes/header-menu.php');  ?>
  <?php include_once(app_path().'/includes/side-menu.php');  ?>
  


  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <h1 class="m-n font-thin h3 text-black">Dashboard</h1>
          <small class="text-muted">Overview </small>

        </div>
        <div class="col-sm-6 text-right hidden-xs">
          <div class="inline m-r text-left">
            <button id="forceUpdateBtn" class="btn btn-danger btn-sm" onclick="forceUpdate()" style="margin-top:10px;">Force Update</button>
          </div>
          <!-- <div class="inline m-r text-left">
            <div class="m-b-xs">1290 <span class="text-muted">items</span></div>
            <div
              ui-jq="sparkline" 
              ui-options="[ 106,108,110,105,110,109,105,104,107,109,105,100,105,102,101,99,98 ], {type:'bar', height:20, barWidth:5, barSpacing:1, barColor:'#dce5ec'}" 
              class="sparkline inline">loading...
            </div>
          </div>
          <div class="inline text-left">
            <div class="m-b-xs">$30,000 <span class="text-muted">revenue</span></div>
            <div
              ui-jq="sparkline" 
              ui-options="[ 105,102,106,107,105,104,101,99,98,109,105,100,108,110,105,110,109 ], {type:'bar', height:20, barWidth:5, barSpacing:1, barColor:'#dce5ec'}" 
              class="sparkline inline">loading...
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
      <!-- stats -->
      <div class="row">
        <div class="col-md-5">
          <div class="row row-sm text-center">
            <div class="col-xs-6">
              <div class="panel padder-v bg-warning item">
                <div class="h1 font-thin h1">{{ $numberOfProvinces }}</div>
                <span class="text-xs">provinces</span>
                <div class="top text-right w-full">
                  <i class="fa fa-caret-down text-default m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <a href class="block panel padder-v bg-primary item">
                <span class="text-white font-thin h1 block">{{ $numberOfDistricts }}</span>
                <span class="text-muted text-xs">Districts</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-cloud-upload text-muted m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block">{{  $numberOfTowns }}</span>
                <span class="text-muted text-xs">Towns</span>
                <span class="top text-left">
                  <i class="fa fa-caret-up text-warning m-l-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <div class="panel padder-v bg-success item">
                <div class="font-thin h1">{{ number_format($numberOfBrgys) }}</div>
                <span class="text-xs">Brgys</span>
                <div class="bottom text-left">
                  <i class="fa fa-caret-up text-success m-l-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-12 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col w-xs v-middle hidden-md">
                  <h2><i class="fa fa-users"></i></h2><br>
                </div>
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span>{{ number_format($numberOfVoters) }}</span></div>
                  <span class="text-muted text-xs">Voters</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel panel-default hbox hbox-auto-xs">
            <div class="panel wrapper">
              <h4 class="font-thin m-t-none m-b text-muted">Latest Commits</h4>
              <div id="statusChart" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- / stats -->

      <!-- PRESIDENTS -->
      <?php 
        foreach($positionArr as $posID=>$posName){
          $chartHeight = 200;
          if($posID==9) $chartHeight = 500;
      ?>
              <div class="panel panel-default hbox hbox-auto-xs">
                <div class="col wrapper">
                  <i class="fa fa-circle-o text-info m-r-sm pull-right"></i>
                  <h4 class="font-thin m-t-none m-b-none text-primary-lt">
                    {{ $posName }}
                    </h4>
                  <span class="m-b block text-sm text-muted"></span>

                  <div id="chart{{ $posID }}" style="height: {{ $chartHeight }}px"></div>
                </div>
                <div class="col wrapper-lg w-lg bg-light dk r-r">
                  <h4 class="font-thin m-t-none m-b">votes</h4>
                  <div class="">
                    <?php 
                        $total = array_sum($nameVote[$posID]);
                        $ctr = 1;
                        foreach($nameVote[$posID] as $name=>$votes){ 
                          $barColor = getRankColor($ctr);
                          $percentage = 0;
                          if($votes>0){
                            $percentage = ($votes / $total)*100; 
                          }  
                    ?>
                    <div class="m-b">
                      <span class="pull-right text-primary">{{ number_format($votes) }}</span>
                      <span>{{ $name }}</span>
                    </div>
                    <div class="progress progress-xs">
                      <div class="progress-bar" data-toggle="tooltip" data-original-title="{{ $percentage }}%" style="width: {{ $percentage }}%; background-color:{{ $barColor }}"></div>
                    </div>
                    <?php 
                      $ctr++;
                      }
                    ?>   
                  </div>
                  <!-- <p class="text-muted">Dales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis</p> -->
                </div>
              </div>
      <?php } ?>     
   

      <!-- tasks -->
      
      <!-- / tasks -->

      <!-- tasks -->
      
      <!-- / tasks -->
    </div>
  </div>
  <!-- / main -->
  <!-- right col -->
  <div class="col w-md bg-white-only b-l bg-auto no-border-xs">
    <!-- <div class="nav-tabs-alt">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#candidates" data-toggle="tab"><i class="glyphicon glyphicon-user text-md text-muted wrapper-sm"></i></a></li>
      </ul>
    </div> -->
    <div class="tab-content">
      <div class="tab-pane active" id="candidates">
        <div class="wrapper-md">
          <div class="m-b-sm text-md">Candidates</div>
          <ul class="list-group no-bg no-borders pull-in">
            <?php 
                for($i=0; $i<count($candidateStatus); $i++){
                  $cand = $candidateStatus[$i]; 
                  $stat1 = $cand['stat1'];
                  $stat2 = $cand['stat2'];
                  $stat3 = $cand['stat3'];
                  $stat4 = $cand['stat4'];
                  $win = '<i class="fa fa-thumbs-up text-info"></i>'; 
                  $loss = '<i class="fa fa-thumbs-down text-danger"></i>';
                  $none = ''; 
                  if($stat1=='Y'){ $stat1 = $win; }elseif($stat1=='N'){ $stat1 = $loss; }else{ $stat1 = $none; }
                  if($stat2=='Y'){ $stat2 = $win; }elseif($stat2=='N'){ $stat1 = $loss; }else{ $stat2 = $none; }
                  if($stat3=='Y'){ $stat3 = $win; }elseif($stat3=='N'){ $stat1 = $loss; }else{ $stat3 = $none; }
                  if($stat4=='Y'){ $stat4 = $win; }elseif($stat4=='N'){ $stat1 = $loss; }else{ $stat4 = $none; }
                  $statDisp = $stat1.' '.$stat2.' '.$stat3.' '.$stat4;

            ?>
            <li class="list-group-item">
              <a herf class="pull-left thumb-sm avatar m-r">
                <img src="img/a4.jpg" alt="..." class="img-circle">                
              </a>
              <div class="clear">
                <div><a href="/candidate/{{ $cand['id'] }}">{{ $cand['name'] }} </a></div>                
                <small class="text-muted">{{ $cand['position'] }}</small><br>
                <small class="text-muted">{{ $statDisp }}</small>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
                
    </div>
    
  </div>
  <!-- / right col -->
</div>


    </div>
  </div>
  <!-- / content -->

  
  <?php include_once(app_path().'/includes/footer.php');  ?>
</div>

<?php include_once(app_path().'/includes/common-js.php');  ?>

<script type="text/javascript">
  $(function () {

      Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        $('#statusChart').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {
                            var x = (new Date()).getTime(), // current time
                                y = Math.random();
                            series.addPoint([x, y], true, true);
                        }, 5000);
                    }
                }
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Commits'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Random data',
                data: [ [1,2], [2,2] ]
                //   (function () {
                //     // generate an array of random data
                //     var data = [],
                //         time = (new Date()).getTime(),
                //         i;

                //     for (i = -19; i <= 0; i += 1) {
                //         data.push({
                //             x: time + i * 1000,
                //             y: Math.round( Math.random() )
                //         });
                //     }
                //     console.log('status', data);
                //     return data;
                // }())
            }]
        });

      Highcharts.setOptions({
       // colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
       colors: ['#7266ba', '#23b7e5', '#27c24c', '#fad733', '#f05050']
      });

      drawPie( 'chart1', [<?php echo implode(',',$pieChartData[1]); ?>] );
      drawPie( 'chart2', [<?php echo implode(',',$pieChartData[2]); ?>] );
      drawPie( 'chart3', [<?php echo implode(',',$pieChartData[3]); ?>] );
      drawPie( 'chart4', [<?php echo implode(',',$pieChartData[4]); ?>] );
      drawPie( 'chart5', [<?php echo implode(',',$pieChartData[5]); ?>] );
      drawPie( 'chart6', [<?php echo implode(',',$pieChartData[6]); ?>] );
      drawPie( 'chart7', [<?php echo implode(',',$pieChartData[7]); ?>] );
      drawPie( 'chart8', [<?php echo implode(',',$pieChartData[8]); ?>] );
      drawPie( 'chart9', [<?php echo implode(',',$pieChartData[9]); ?>] );



  });

  function drawPie(targetChart, dataToPlot){    
    // console.log(dataToPlot);
    $('#'+targetChart).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,//null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        exporting: {
          enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Votes',
            data: dataToPlot
        }]
    });
  }

  var candidateIDs = [<?php echo $candidateIDs; ?>];
  var positionIDs = [<?php echo $positionIDs; ?>];
  // console.log('positionIDs',positionIDs);
  var i = 0; 
  function forceUpdate(){
    if (i < candidateIDs.length) {
      var ctr = i + 1;
      $('#forceUpdateBtn').html("updating... "+ctr+" of "+candidateIDs.length+"." );

      var candidateID = candidateIDs[i];
      var positionID = positionIDs[i];
      $.post('updateSingle', { candidateID:candidateID, positionID:positionID }, function(res){
        if(res.success){
          // $('#survey_1_'+candidateID).html(res.total);
          console.log('total',res.total);
          i++;
          forceUpdate();          
        }else{
          console.log('Please try again later.');
        }
      },'json');

    }else{
        $.post('updateStatus',{}, function(res){
          if(res.success){          
            console.log('status updated');
            location.reload();
          }
        },'json');
        $('#forceUpdateBtn').html("Force Update" );
        i = 0;
      } 
  }
</script>
</body>
</html>
