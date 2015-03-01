<form role="form" class="form-inline">
  <button type="button" class="btn btn-sm btn-info" onclick="showFilterModal()">Save Filters</button> 
  <select id="myFilters" class="form-control">
    <option value="0">Select Filter...</option>
    <?php foreach($filterOptions as $filter): ?>
      <option value="<?php echo $filter->id; ?>"><?php echo $filter->filter_name; ?></option>
    <?php endforeach; ?>
  </select>                
</form>