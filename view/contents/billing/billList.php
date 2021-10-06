<?php
$viewMode = (isset($_GET['viewMode'])?$_GET['viewMode']:'default');
?>
<input type="hidden" id="viewMode" value="<?php echo $viewMode;?>">
<table class="table table-bordered" id="billingTable" width="100%">
    <thead>
        <tr>
            <th>Bill Id</th>
            <th>Bill</th>
            <th>Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
</table>



<!-- Submit Reciept Modal-->
  <div class="modal fade" id="storeFormModal" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="storeModalLabel">Store Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           <?php include 'storeForm.php';?>
        </div>
        <div class="modal-footer">
          <input type="button" id="storeFormPopupActionButton" class="btn btn-info" value="Add" >
          <button onclick="location.reload()" class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

   <!-- Page level custom scripts -->
  <script src="js/bpos/billing/bpos-billing-datatable.js"></script>
  