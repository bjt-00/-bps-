
<table id="productTable" width="100%">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
    </tfoot>
</table>



<!-- Submit Reciept Modal-->
  <div class="modal fade" id="productFormModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Transaction Completed Successfully</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           Email: <input type="email" id="customeEmail" class="form-control" placeholder="customer@email.com">
        </div>
        <div class="modal-footer">
          <input type="button" id="sendEmailNow" class="btn btn-info" value="Send" >
          <button onclick="location.reload()" class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  