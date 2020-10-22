<?php 
$viewMode = (isset($_GET['viewMode'])?$_GET['viewMode']:'default');
?>
<input type="hidden" id="viewMode2" value="<?php echo $viewMode;?>">
<!-- table table-bordered -->
<table class="display cell-border compact nowrap" id="productTable2" width="100%">
    <thead>
        <tr>
            <th>Label Name</th>
            <th>Label Details</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
</table>


<!-- Submit Reciept Modal-->
  <div class="modal fade" id="productFormModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Product Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           <?php include 'productForm.php';?>
        </div>
        <div class="modal-footer">
          <input type="button" id="popupActionButton" class="btn btn-info" value="Add" >
          <button onclick="location.reload()" class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

   <!-- Page level custom scripts -->
  <script src="js/bpos/bpos-printlabel-datatable.js"></script>
   <script src="js/bpos/bpos-product-form.js"></script>

  