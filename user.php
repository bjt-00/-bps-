<!DOCTYPE html>
<html lang="en">
<?php 
$_GET['title']='Users';
include 'view/structure/header.php'; 
?>
<body id="page-top">
 
  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php include 'view/structure/sidebar.php';?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

		<?php include 'view/structure/menu.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

         <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 id="pageHader" class="h3 mb-0 text-gray-800"><?php echo $companyName;?> Users</h1>
              <a href="#" class="btn btn-secondary btn-icon-split btn-sm" data-toggle="modal" data-target="#userFormModal">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span>
              </a>
             
          </div>

		  <?php include 'view/structure/alert.php'; ?>


          <!-- Content Row -->

          <div class="row">
			
            <!-- Reciept -->
            <?php 
            $_GET['viewMode']=(isset($_GET['viewMode'])?$_GET['viewMode']:'printlabel'); 
             include 'view/contents/user/usersList.php';
            ?>
 
            
            
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'view/structure/footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


    <script src="js/bpos/bpos-user.js"></script>
  
</body>

</html>
