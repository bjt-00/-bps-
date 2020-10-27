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
            <h1 id="pageHader" class="h3 mb-0 text-gray-800"><?php echo $companyName;?> Labels</h1>
              <a href="#" class="btn btn-secondary btn-icon-split btn-sm" data-toggle="modal" data-target="#productListModal">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span>
              </a>
             <a href="#" id="printLabels" class="btn btn-secondary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print</span>
              </a>
          </div>

		  <?php include 'view/structure/alert.php'; ?>


          <!-- Content Row -->

          <div class="row">
			
            <!-- Reciept -->
            <?php 
            $_GET['viewMode']=(isset($_GET['viewMode'])?$_GET['viewMode']:'printlabel'); 
             include 'view/contents/product/labelsList.php';
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

<!-- ProductList Modal-->
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
           <?php $_GET['viewMode']="pcompact"; include 'view/contents/product/productList.php';?>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <script src="js/bpos/bpos-printlabel.js"></script>
  
</body>

</html>
