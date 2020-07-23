 
 <div class="col-xl-5 col-lg-7 card card-body">

 <div id="recieptHeader" style="display:block">
 <center>Abeera Garments</center>
 <center>www.bitguiders.com/bpos</center>

 <table class="cell-border" width="100%">
 	<tr>
 		<td><?php echo date('m/d/y');?></td>
 		<td style="width:180px"><?php echo date('h:i:sa');?></td>
 	</tr>
 	<tr>
 		<td>Trans: <span id="transactionId"></span></td>
 		<td>Store: 00191</td>
 	</tr>
 	<tr>
 		<td>Reg:011</td>
 		<td>Cashier: <?php echo (isset($_SESSION['userName'])?$_SESSION['userName']:"Guest");?></td>
 	</tr>
 </table>
<center><div id="transactionIdBarcode"></div></center>

</div>
                       <!-- Page Wrapper -->
                      <div id="content" class="print">
                    
                              <!-- DataTales Example -->
                    
                                    <table class="cell-border" id="dTable" width="100%" heith="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th style="width:50px">Sr.No</th>
                                          <th>Item</th>
                                          <th style="width:50px">Qty</th>
                                          <th style="width:100px">Price</th>
                                        </tr>
                                      </thead>
                                      <tfoot>
                                      	<tr>
                                          <td style="width:50px"></td>
                                          <td></td>
                                          <td style="width:50px"></td>
                                          <td style="width:100px"></td>
                                        </tr>
                                      </tfoot>
                                      <tbody>
                                      </tbody>
                                    </table>
                      </div>
                      <!-- End of Page Wrapper -->
					 <div class="row">
                      <table class="cell-border" width="100%">
                      	<tr>
                      		<td colspan="3">Entries</td>
                      		<td style="width:100px"><span id="entries">0</span></td>
                      	</tr>
                     	<tr>
                      		<td colspan="3">Tax</td>
                      		<td><span id="tax">0</span></td>
                      	</tr>
                     	<tr>
                      		<td colspan="3">Total Amount</td>
                      		<td><span id="totalAmount">0.000000</span></td>
                      	</tr>
                     	<tr>
                      		<td colspan="3">Cash Recieved</td>
                      		<td><input type="text" id="cashRecieved" class="form-control small" placeholder="0.0" size="5"></td>
                      	</tr>
                     	<tr>
                      		<td colspan="3">Balance</td>
                      		<td><span id="balance">0</span></td>
                      	</tr>
                    	<tr>
                      		<td colspan="4">
                      			<input type="button" id="submitReciept" class="btn btn-success" data-toggle="modal" data-target="#submitRecieptModal" value="Submit" >
                      			<input type="button" id="cancelReciept" onclick="location.reload()" class="btn btn-danger" value="Cancel" >
                      		</td>
                      	</tr>
                      </table>
                    </div>
 				</div>
 				
            <div class="col-xl-6 col-lg-7" style="display:none">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Scanned Items</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">

               </div>
                <div class="card-footer">
                	<div class="row">
                	  <div class="col-lg-8">Status:<span id="status"></span></div>
                	  <div class="col-lg-4"><span>Cashier: <?php echo (isset($_SESSION['userName'])?$_SESSION['userName']:"Guest");?></span></div>
                   </div>
                </div>
              </div>
            </div>
            
 <!-- Submit Reciept Modal-->
  <div class="modal fade" id="submitRecieptModal" tabindex="-1" role="dialog" aria-labelledby="recieptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="recieptModalLabel">Transaction Completed Successfully</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           Email: <input type="email" id="customeEmail" class="form-control" placeholder="customer@email.com">
        </div>
        <div class="modal-footer">
          <input type="button" id="print" class="btn btn-info" value="Print" >
          <input type="button" id="sendEmail" class="btn btn-info" value="Email" >
          <button onclick="location.reload()" class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
