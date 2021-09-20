<?php 
$companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
$requestType = (isset($_SESSION['activate'])?'activate':'default');

/* $productId = (isset($_GET['productId'])?$_GET['productId']:'000');
$productName = (isset($_GET['productName'])?$_GET['productName']:'');
$size = (isset($_GET['size'])?$_GET['size']:'');
$purchasePrice = (isset($_GET['purchasePrice'])?$_GET['purchasePrice']:'0');
$salePrice = (isset($_GET['salePrice'])?$_GET['salePrice']:'0');
$totalInStock = (isset($_GET['totalInStock'])?$_GET['totalInStock']:'0');
$totalSold = (isset($_GET['totalSold'])?$_GET['totalSold']:'0'); */

?>
<form id="storeForm" enctype="multipart/form-data" >
	<input type="hidden" id="storeFormCompanyPrefix" name="companyPrefix" value="<?php echo $companyPrefix;?>" class="form-control" placeholder="Product Bar Code">
	<input type="hidden" name="action" id="storeFormAction" value="Add">
    <input type="hidden" id="storeId" name="storeId" value="" class="form-control" placeholder="Store Id" required="required" autocomplete="off">
<div class="form-group row">
    <div class="col-sm-12">
      <input type="text" id="storeName" name="storeName"  value="" class="form-control" placeholder="Store Name" required="required" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
      <input type="text" id="storeAddress" name="storeAddress"  value="" class="form-control" placeholder="Store Address" required="required" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-12">
      <input type="number" id="storePhone" name="storePhone"  value="" class="form-control" placeholder="Store Phone" required="required" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-6">
      <input type="number" id="storeTax" name="storeTax"  value="" class="form-control" placeholder="Govt applied tax" required="required" autocomplete="off">
    </div>
    <div class="col-sm-6">
      <input type="text" id="storeTaxType" name="storeTaxType"  value="" class="form-control" placeholder="Tax type % etc" required="required" autocomplete="off">
    </div>
</div>
</form>