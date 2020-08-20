<!DOCTYPE html>
<html lang="en">
<?php 
$_GET['title']='Product';
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
            <h1 class="h3 mb-0 text-gray-800"><?php echo $companyName;?> Products</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

		  <?php include 'view/structure/alert.php'; ?>


          <!-- Content Row -->

          <div class="row">
			
            <!-- Reciept -->
            <?php include 'view/contents/product/productList.php'; ?>
 
            
            
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

   <!-- Page level custom scripts -->
  <script src="js/bpos/bpos-product-datatable.js"></script>
  
</body>

</html>
