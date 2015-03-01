<script src="<?php echo asset('js/jquery.min.js'); ?>"></script>
<script src="<?php echo asset('js/bootstrap.js'); ?>"></script>
<script src="<?php echo asset('js/ui-load.js'); ?>"></script>
<script src="<?php echo asset('js/ui-jp.config.js'); ?>"></script>
<script src="<?php echo asset('js/ui-jp.js'); ?>"></script>
<script src="<?php echo asset('js/ui-nav.js'); ?>"></script>
<script src="<?php echo asset('js/ui-toggle.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/highcharts.js'); ?>"></script>
<script src="<?php echo asset('js/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?php echo asset('js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo asset('js/datatables/dataTables.bootstrap.js'); ?>"></script>
<script src="<?php echo asset('js/jquery-ui.js'); ?>"></script>

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
    });

    
    </script>
