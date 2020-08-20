<?php 

$productId = (isset($_GET['productId'])?$_GET['productId']:'000');
$productName = (isset($_GET['productName'])?$_GET['productName']:'');
$size = (isset($_GET['size'])?$_GET['size']:'');
$purchasePrice = (isset($_GET['purchasePrice'])?$_GET['purchasePrice']:'0');
$salePrice = (isset($_GET['salePrice'])?$_GET['salePrice']:'0');
$totalInStock = (isset($_GET['totalInStock'])?$_GET['totalInStock']:'0');
$totalSold = (isset($_GET['totalSold'])?$_GET['totalSold']:'0');

$percentSold = (($totalSold/($totalInStock+$totalSold))*100);
$percentSold = round($percentSold,0);

$progressBarColor ='bg-dark';
if($percentSold<=25) $progressBarColor= 'bg-success';
if($percentSold>=25 && $percentSold <50 ) $progressBarColor= 'bg-info';
if($percentSold>=50 && $percentSold <75 ) $progressBarColor= 'bg-warning';
if($percentSold>=75 ) $progressBarColor= 'bg-danger';

$companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
?>
<table>
<tr>
<td rowspan="7" colspan="1" >
<div class="row">
<img id="productImage" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/products/<?php echo $productId;?>.jpg" width="150" height="140"  >
</div>
<div class="row">
<div id="product<?php echo $productId;?>BarCode"></div>
</div>
</td>
</tr>
<tr>
<td><label>Name :</label><?php echo $productName;?></td>
</tr>
<tr><td><label>Size:</label><?php echo $size;?></td></tr>
<tr><td><label>Purchase Price:</label><?php echo $purchasePrice;?></td></tr>
<tr><td><label>Sale Price:</label><?php echo $salePrice;?></td></tr>
<tr><td><label>In Stock:</label><?php echo $totalInStock;?> | <label>Sold:</label><?php echo $totalSold;?></td></tr>
<tr><td>
<a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#productFormModal">
<i class="fas fa-pen"></i>
</a>
<?php echo $percentSold;?>% Sold
<div class="progress progress-sm mr-2">
  <div class="progress-bar <?php echo $progressBarColor;?>" role="progressbar" style="width: <?php echo $percentSold;?>%" aria-valuenow="<?php echo $totalSold;?>" aria-valuemin="0" aria-valuemax="<?php echo ($totalInStock+$totalSold);?>"></div>
</div>
</td></tr>
</table>

   <script>
   var settings = {
	          output:"css",
	          bgColor: "#FFFFFF",
	          color: "#000000",
	          barWidth: 0,
	          barHeight: 20,
	          moduleSize: 1,
	          //width:25,
	          //posX: 10,
	          //posY: 20,
	          addQuietZone: 0
	        };
   //var value = {code:"0000000000056", rect: true};
   //$("#transactionIdBarcode").barcode("0000000000009","ean13",settings);
   $("#product<?php echo $productId;?>BarCode").barcode("<?php echo $productId;?>","datamatrix");
   </script>