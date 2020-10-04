
<table class="display" id="productTable" width="100%">
    <thead>
        <tr>
            <th>Product Details</th>
            <th></th>
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

  