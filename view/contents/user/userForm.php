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
<form id="userForm" enctype="multipart/form-data" >
	<input type="hidden" id="userFormCompanyPrefix" name="companyPrefix" value="<?php echo $companyPrefix;?>" class="form-control" placeholder="Product Bar Code">
	<input type="hidden" name="action" id="userFormAction" value="Add">
<div class="form-group row">
    <div class="col-sm-6">
      <input type="text" id="loginId" name="loginId" value="" class="form-control" placeholder="Login Id" required="required" autocomplete="off">
    </div>
    <div class="col-sm-6">
      <input type="password" id="password" name="password"  value="" class="form-control" placeholder="Password" required="required" autocomplete="off">
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-6">
      <input type="text" id="firstName" name="firstName" value="" class="form-control" placeholder="First Name" required="required">
    </div>
    <div class="col-sm-6">
      <input type="text" id="lastName" name="lastName"  value="" class="form-control" placeholder="Last Name" required="required">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
	<select id="role" name="role" class="form-control">
		<option value="Sales Manager">Sales Manager</option>
		<option value="Sales Person">Sales Person</option>
	</select>
    </div>
    <div class="col-sm-6">
	<select id="userFormStoreId" name="storeId" class="form-control">
		<option value="1">Savoy Arcade F-11 Markaz, Islamabad,Pakistan</option>
		<option value="1">Abeera Garments,Haripur Branch 1</option>
	</select>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6">
      <input type="email" id="email" name="email" value="" class="form-control" placeholder="email@abc" required="required">
    </div>
    <div class="col-sm-6">
      <input type="number" id="phone" name="phone"  value="" class="form-control" placeholder="Phone" required="required">
    </div>
</div>

<div class="form-group">
	<img id="userImagePreview" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/users/0.jpg" width="150" height="140"  >
	<input type="file" id="userImage" name="userImage" class="form-control" >
</div>
</form>