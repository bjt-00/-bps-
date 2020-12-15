            <div class="col-xl-7 col-lg-5" id="productDetail">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                     <input type="text" id="searchReciept" value="" class="form-control" placeholder="Search Reciept"  />
                     <input type="text" id="searchProduct" value="" class="form-control" placeholder="Search Product"  />
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header" <?php echo $display?> >Dropdown Header:</div>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#productListModal">Product List</a>
                      <a class="dropdown-item" href="#" <?php echo $display?>>Another action</a>
                      <div class="dropdown-divider" <?php echo $display?>></div>
                      <a class="dropdown-item" href="#" <?php echo $display?>>Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                        <div class="row">
                          <div class="col-lg-12">
                            <table>
                            	<tr>
                            		<td rowspan="9">
                            		   <img id="productImage" alt="" class="pull-center" src="themes/common/images/0.png" width="200" height="200"  >
                            		   <span id="priceTag" class="badge badge-danger badge-counter"></span>
                            		   <input type="hidden" id="productId" value="0">
                            		   <input type="hidden" id="returnedProductId" value="-1">
                            		</td>
                            	</tr>
                            	<tr>
                            	    <td class="label">Name</td>
                            		<td id="productName"></td>
                            	</tr>
	                           	<tr>
                            	    <td class="label">Price</td>
                            		<td>
                            		  <span id="productPrice"></span>
                            		</td>
                            	</tr>
	                           	<tr>
                            	    <td class="label">Size</td>
                            		<td id="productSize"></td>
                            	</tr>
	                           	<tr>
                            	    <td class="label" colspan="2">Quantity<span id="quantity"></span></td>
                            	</tr>
	                           	<tr>
                            	    <td colspan="2">
                            	    <span id="minQuantity"></span>
                            	      <input type="range" id="productQuantity" min="1" max="1" value="1">
                            	      <span id="maxQuantity"></span>
                            	    </td>
                            	</tr>
	                           	<tr>
                            	    <td class="label" colspan="2">Discount<span id="discount"></span></td>
                            	</tr>
	                           	<tr>
                            	    <td colspan="2">
                            	      <span id="minDiscount"></span>
                            	      <input type="range" id="productDiscount" min="0" max="0" value="0">
                            	      <span id="maxDiscount"></span>
                            	    </td>
                            	</tr>
	                           	<tr>
                            	    <td colspan="2">
                            	      <label class="label"><input type="checkbox" id="autoAddMode" checked="checked"> Auto Mode</label>
                            	    </td>
                            	</tr>
                            </table>
                           </div>
                        </div>
                        <br>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<input type="button" id="addProduct" value="<<" class="form-control" />
                        	</div>
                        	<div class="col-lg-6">
                        		
                        	</div>
                        </div>

                </div>
              </div>
            </div>

<!-- Submit Reciept Modal-->
  <div class="modal fade" id="productListModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Product List</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           <?php $_GET['viewMode']="compact"; include 'productList.php';?>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
