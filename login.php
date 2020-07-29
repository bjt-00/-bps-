<!DOCTYPE html>
<html lang="en">
<?php 
$_GET['title']='Login';
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
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <div class="text-center">
                  	<?php include 'view/structure/alert.php'; ?>
                  </div>
                  <form class="user" action="rest/services/security.php" method="post" enctype="application/x-www-form-urlencoded" >
                    <div class="form-group">
                    	<select name="companyPrefix" class="form-control">
                    	    <option value="default">Default Company</option>
                    		<option value="ag">Abeera Garments</option>
                    	</select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="loginId" class="form-control form-control-user"  aria-describedby="emailHelp" placeholder="Enter login id" required="true" >
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required="true">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" style="display:none">
                        <label class="custom-control-label" for="customCheck" style="display:none">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block"/>
                    <hr>
                  </form>
                  
                  <div class="text-center" style="display:none">
                    <a class="small" href="forgot-password.html">Forgot Password?</a> | 
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</body>

</html>
