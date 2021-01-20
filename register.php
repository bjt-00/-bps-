<!DOCTYPE html>
<html lang="en">
<?php 
$_GET['title']='Register';
include 'view/structure/header.php';
?>

<body class="bg-gradient-primary">

  <div class="container" style="<?php echo (isset($_SESSION['accountActivationMessage'])?"display:none":"");?>">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-registration-image">
              
              	<?php
              	if(isset($_SESSION['activate'])){
              	 echo 'This will be your super admin account to manager other users';
              	 //include 'view/contents/plans/basic-plan.php';
              	}else{
              	 include 'view/contents/plans/basic-plan.php';
              	}?>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register..!</h1>
                  </div>
                  <div class="text-center">
                  	<?php 
                  	  if(!isset($_SESSION['activate'])){
                  	    include 'view/structure/alert.php'; 
                  	  }
                  	 ?>
                  </div>
                  	<?php 
                  	if(!isset($_SESSION['activate'])){
                  	    include 'view/contents/company/companyForm.php';
                  	}                  	
                  	?>
                  <div class="text-center">
                    <a class="small" href="login.php">Back to Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

<?php if(isset($_SESSION['activate'])){
    
    echo (isset($_SESSION['accountActivationMessage'])?$_SESSION['accountActivationMessage']:"");
    unset($_SESSION['accountActivationMessage']);
    unset($_SESSION['activate']);
    
    include 'view/structure/footer.php';
    
    $_SESSION['activated']='yes';
    echo '<script> $("#userFormModal").modal("show");</script>';
}?>

<script src="js/bpos/bpos-login.js"></script>
<!-- script src="js/bpos/bpos-user-form.js"></script-->
</body>
</html>
