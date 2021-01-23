<!DOCTYPE html>
<html lang="en">
<?php 
$_GET['title']='Forgot Password';
include 'view/structure/header.php';
?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Forgot Password!</h1>
                    <h6>Please enter your registered eamil and loginId to send reset password link.</h6>
                  </div>
                  <div class="text-center">
                  	<?php include 'view/structure/alert.php'; ?>
                  </div>
                  <form class="user" action="rest/services/user.php" method="post" enctype="application/x-www-form-urlencoded" >
                    <div class="form-group">
                    	<select id="companyPrefix" name="companyPrefix" class="form-control">
                    	</select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="loginId" class="form-control form-control-user"  aria-describedby="emailHelp" placeholder="Enter login id * " required="true" autocomplete="off" >
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user"  aria-describedby="emailHelp" placeholder="Enter Email * " required="true" autocomplete="off" >
                    </div>
                    
                    <input type="submit" name="forgotPassword" value="Submit" class="btn btn-primary btn-user btn-block"/>
                    <hr>
                  </form>
                  
                  <div class="text-center">
                    <a class="small" href="login.php">Back to Login?</a> | 
                    <a class="small" href="register.php">Register Now!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
<script src="js/bpos/bpos-login.js"></script>
</body>
</html>
