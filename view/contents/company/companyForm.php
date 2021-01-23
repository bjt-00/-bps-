 <?php 
 $companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
 ?>
 <form id="companyForm" class="user" action="rest/services/company.php" method="post" enctype="multipart/form-data" >
   <div class="form-group">
 	<input type="hidden" id="companyFormCompanyPrefix" name="companyPrefix" value="<?php echo $companyPrefix;?>" class="form-control" placeholder="Product Bar Code">
	<input type="hidden" name="action" id="companyFormAction" value="Add">
	<input type="hidden" name="companyId" id="companyId" value="<?php echo $companyPrefix;?>">
   	<input type="text" id="companyName" name="companyName" class="form-control" placeholder="Your Business Name" required="required" >
   </div>
   <div class="form-group">
    <input type="text" id="companyAddress" name="companyAddress" class="form-control" placeholder="Your Business Address" required="required">
   </div>
   <div class="form-group">
    <input type="phone" id="companyPhone" name="companyPhone" class="form-control" placeholder="Your Business Phone" required="required">
   </div>
  <div class="form-group">
    <input type="email" id="companyEmail" name="companyEmail" class="form-control" placeholder="Your Business Email" required="required">
   </div>
   <div class="form-group">
     <div class="custom-control custom-checkbox small">
       <input type="checkbox" class="custom-control-input" id="customCheck" style="display:none">
       <label class="custom-control-label" for="customCheck" style="display:none">Remember Me</label>
     </div>
   </div>
    <div class="form-group">
    	<img id="companyLogoPreview" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/<?php echo $companyPrefix;?>.png" width="180" height="60" alt="Company Logo" >
    	<input type="file" id="companyLogo" name="companyLogo" class="form-control" >
    </div>

   <input type="submit" id="registerButton" name="register" value="Register" class="btn btn-primary btn-user btn-block"/>
   <hr>
 </form>

