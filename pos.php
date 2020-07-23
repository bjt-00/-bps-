<!DOCTYPE html>
<html lang="en">
<?php 
$_GET['title']='Point of Sale';
include 'view/structure/header.php'; 
?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php //include 'view/structure/sidebar.php';?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

		<?php include 'view/structure/menu.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

		  <?php include 'view/structure/alert.php'; ?>


          <!-- Content Row -->

          <div class="row">
			
            <!-- Reciept -->
            <?php include 'view/contents/pos/reciept.php'; ?>
 
            <!-- Item Details -->
            <?php include 'view/contents/pos/productDetail.php';?>
            
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

   <script>
   var settings = {
	          output:"css",
	          bgColor: "#FFFFFF",
	          color: "#000000",
	          barWidth: 1,
	          barHeight: 15,
	          moduleSize: 1,
	          width:25,
	          //posX: 10,
	          //posY: 20,
	          addQuietZone: 0
	        };
   //var value = {code:"0000000000056", rect: true};
   //$("#transactionIdBarcode").barcode("0000000000009","ean13",settings);
   $("#transactionIdBarcode").barcode("000","datamatrix");
   </script>
 
   <!-- Page level custom scripts -->
  <script src="js/bpos/bpos-datatable.js"></script>
  <script src="js/bpos/bpos-product-detail.js"></script>
  
</body>

</html>
