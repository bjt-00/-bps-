<?php 
$companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');

/* $productId = (isset($_GET['productId'])?$_GET['productId']:'000');
$productName = (isset($_GET['productName'])?$_GET['productName']:'');
$size = (isset($_GET['size'])?$_GET['size']:'');
$purchasePrice = (isset($_GET['purchasePrice'])?$_GET['purchasePrice']:'0');
$salePrice = (isset($_GET['salePrice'])?$_GET['salePrice']:'0');
$totalInStock = (isset($_GET['totalInStock'])?$_GET['totalInStock']:'0');
$totalSold = (isset($_GET['totalSold'])?$_GET['totalSold']:'0'); */

?>
<form id="productForm" enctype="multipart/form-data" >
<div class="form-group">
	<input type="hidden" id="companyPrefix" name="companyPrefix" value="<?php echo $companyPrefix;?>" class="form-control" placeholder="Product Bar Code">
	<input type="number" id="productId" name="productId" value="" class="form-control" placeholder="Product Bar Code">
	<input type="hidden" name="action" id="action" value="Add">
</div>
<div class="form-group">
	<input type="text" id="productName" name="productName" value="" class="form-control" placeholder="Name" required="required">
</div>
<div class="form-group row">
    <div class="col-sm-6">
      <input type="number" id="purchasePrice" name="purchasePrice" value="" class="form-control" placeholder="Purchase Price" required="required">
    </div>
    <div class="col-sm-6">
      <input type="number" id="salePrice" name="salePrice"  value="" class="form-control" placeholder="Sale Price" required="required">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
	<select id="size" name="size" class="form-control">
		<option value="S">Small</option>
		<option value="M">Medium</option>
		<option value="L">Large</option>
		<option value="XL">X-Large</option>
	</select>
    </div>
    <div class="col-sm-6">
	  <input type="number" id="noOfItems" name="noOfItems" value="" class="form-control" placeholder="No of Items" required="required">
    </div>
</div>
<div class="form-group">
	<img id="productImagePreview" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/products/0.png" width="150" height="140"  >
	<input type="file" id="productImage" name="productImage" class="form-control" >
</div>
</form>