<?php $title = 'Error 404';?>
<?php include_once(app_path().'/includes/header.php');  ?>
<div class="app app-header-fixed  ">  
  <?php include_once(app_path().'/includes/header-menu.php');  ?>
  <?php include_once(app_path().'/includes/side-menu.php');  ?>
  
  <!-- content -->
  <div class="app app-header-fixed  ">
  

<div class="container w-xxl w-auto-xs" ng-init="app.settings.container = false;">
  <div class="text-center m-b-lg">
    <div class="text-shadow text-white" style="font-size: 40px;">Sorry, but I can't find that page</div>
  </div>
  
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
    <p>
  <h4 class="text-muted">Please check the url and try again.</h4>
</p>
  </div>
</div>


</div>
  <!-- / content -->

  
  <?php include_once(app_path().'/includes/footer.php');  ?>
</div>

<?php include_once(app_path().'/includes/common-js.php');  ?>
<script type="text/javascript">
  $(document).ready(function() {

  
    $('#platformOptions').multiselect({
        onChange: function(element, checked) {
          var values = [];
          $('#platformOptions option').each(function() {
              if ($(this).is(":checked")) {
                  values.push($(this).val());
              }
          });       
          $('#platform').val(values.join('|'));  
        }
    });

    $('#loc_countryOptions').multiselect({
        onChange: function(element, checked) {
          var values = [];
          $('#loc_countryOptions option').each(function() {
              if ($(this).is(":checked")) {
                  values.push($(this).val());
              }
          });         
          $('#loc_country').val(values.join('|'));
        }
    });

    $('#dataTables').dataTable({
      "paging": false,
      "info":false,
      "searching":false,
      "columnDefs": [ { targets: [0], orderable: false } ]
    });  

    $('#myFilters').on('change',function(){
      var id = $(this).val();
      $.post( "/filters/getFilter", { id:id }, function( res ) {
          if(res.success){    
            console.log('pull ',res.filterData);
            var data = JSON.parse(res.filterData.filter_data);
            $('#platform').val(data.platform);
            $('#loc_country').val(data.loc_country);
            $("#status option[value='"+data.status+"']").attr("selected", "selected");
            $("#sort option[value='"+data.sort+"']").attr("selected", "selected");
            $('#keywords').val(data.keywords);
            $('#filterForm2').submit();

          }else{
              alert('Ups! Please try again later.');;
          }
      },'json');
    });
  }); 

  //SAVE FILTER MODAL
    //==========================================

    function showFilterModal(){
      $('#filterModal').modal('show');
    }

    function saveFilter(){
      var filterName = $('#filterName').val();
      var filterData = {
        platform: $('#platform').val(),
        loc_country: $('#loc_country').val(),
        status: $('#status').val(),
        sort: $('#sort').val(),
        keywords: $('#keywords').val()
      }
      console.log('filter data', filterData);
      $.post( "/filters/saveFilter", { page:'all-companies', filterName:filterName, filterData:filterData }, function( res ) {
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

</body>
</html>