<script src="<?php echo asset('js/jquery.min.js'); ?>"></script>
<script src="<?php echo asset('js/bootstrap.js'); ?>"></script>
<script src="<?php echo asset('js/ui-load.js'); ?>"></script>
<script src="<?php echo asset('js/ui-jp.config.js'); ?>"></script>
<script src="<?php echo asset('js/ui-jp.js'); ?>"></script>
<script src="<?php echo asset('js/ui-nav.js'); ?>"></script>
<script src="<?php echo asset('js/ui-toggle.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/highcharts.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/highcharts-3d.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/highcharts-more.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/highcharts-more.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?php echo asset('js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo asset('js/datatables/dataTables.bootstrap.js'); ?>"></script>
<script src="<?php echo asset('js/jquery-ui.js'); ?>"></script>
<script src="<?php echo asset('js/bootstrap-multiselect.js'); ?>"></script>

    <script type="text/javascript">
    $(document).ready(function(){

        var nameCount = $('#availableNames').val();
        // var nameCount = 2;
       
        if (typeof(Storage) != "undefined"){
            if(localStorage["autofill"] != undefined){
                var storedNames = JSON.parse(localStorage["autofill"]);
                // console.log('count',storedNames.count);
                if(storedNames.length == nameCount){
                    var availableNames = [];
                    availableNames = storedNames;
                    console.log('autofill list is up-to-date');
                }else{
                    console.log('autofill list is outdated. Updating...');
                    //update list from db
                    $.post( "/search/getAutoFill", {}, function( response ) {     
                        if(response.success){                                             
                            localStorage["autofill"] = JSON.stringify(response.autofill);  
                            availableNames = JSON.parse(localStorage["autofill"]);                 
                        }else{
                            console.log('update failed!');
                        }
                    },'json');
                   
                }   
            }else{
                //create temp           
                localStorage["autofill"] = JSON.stringify(['none']);
                // location.reload();
            }
            // console.log('availableNames',availableNames);
        }else{
          console.log("Sorry, your browser does not support Web Storage...");
        }
        
        if(localStorage["autofill"] != undefined){
            // console.log('loaded');
            availableNames = JSON.parse(localStorage["autofill"]);
        }


        // console.log('availableNames',availableNames);
        // AUTOCOMPLETE
        $( "#q" ).autocomplete({
            max:10,
            source: availableNames
        });

         $( "#from" ).datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
          onClose: function( selectedDate ) {
            $( "#to" ).datepicker( "option", "minDate", selectedDate );
          }
        });
        $( "#to" ).datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
          onClose: function( selectedDate ) {
            $( "#from" ).datepicker( "option", "maxDate", selectedDate );
          }
        });

        $('#keywords').on('keyup',function (e){
            if(e.keyCode == 13){
                loadPage();
            }
        })

        $('#myFilters').on('change',function(){
          var id = $(this).val();
          $.post( "/filters/getFilter", { id:id }, function( res ) {
              if(res.success){    
                console.log(res.filterData);
                var data = JSON.parse(res.filterData.filter_data);
                $("#platformInput").val(data.platform);
                $("#locationInput").val(data.loc_country);
                $("#sort option[value='"+data.sort+"']").attr("selected", "selected");
                if(data.status!=undefined){
                    $("#status option[value='"+data.status+"']").attr("selected", "selected");
                }
                if(data.fromDate!=undefined){
                    $('#fromDate').val(data.fromDate);
                }
                if(data.toDate!=undefined){
                    $('#toDate').val(data.toDate);
                }
                $('#keywords').val(data.keywords);
                $('#filterForm2').submit();
              }else{
                  alert('Ups! Please try again later.');;
              }
          },'json');
        });

       
    });
    
    //===========================================
    //POPUP FUNCTIONS
    //===========================================

    function showPopup(target){
        $('#'+target+'Modal').modal('show');
    }

    function applyFilter(filter){
        var values = [];
        $('.'+filter+'Boxes').each(function() {
            if ($(this).is(":checked")) {
                values.push($(this).val());
            }
        });       
        $('#'+filter+'Input').val(values.join('|'));
        $('#'+filter+'Modal').modal('hide');
        //apply color
        if(values.length>0){
            $('#'+filter+'FilterBtn').removeClass('btn-default');
            $('#'+filter+'FilterBtn').addClass('btn-warning');
        }else{
            $('#'+filter+'FilterBtn').removeClass('btn-warning');
            $('#'+filter+'FilterBtn').addClass('btn-default');            
        }
    }

    function showFilterModal(){
      $('#filterModal').modal('show');
    }

    function saveFilter(page){
      var filterName = $('#filterName').val();

      var status = '';
      if(page=='all-companies'){
        var status = $('#status').val();
      }
      var fromDate = ''; var toDate = '';
      if(page=='funded-deals'){
        fromDate: $('#fromDate').val();
        toDate: $('#toDate').val();
      }

      var filterData = {
        platform: $('#platformInput').val(),
        loc_country: $('#locationInput').val(),
        status: status,
        fromDate: fromDate,
        toDate: toDate,
        sort: $('#sort').val(),
        keywords: $('#keywords').val()
      }
      $.post( "/filters/saveFilter", { page:page, filterName:filterName, filterData:filterData }, function( res ) {
          if(res.success){    
            var newOption = '<option value="'+res.id+'">'+filterName+'</option>';        
            $('#myFilters').append(newOption);                                 
            alert('success');
            $('#filterName').val('');
            $('#filterModal').modal('hide');
          }else{
              alert('Ups! Please try again later.');;
          }
      },'json');
    }

    </script>
