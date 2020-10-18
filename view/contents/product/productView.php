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
$viewMode = (isset($_GET['viewMode'])?$_GET['viewMode']:'default');
$displayComponent=($viewMode!='full'?"style='display:none'":'');
$imagePreview=($viewMode!='full'?"style='width:100px;height:90px;'":"style='width:150px;height:140px;'");
?>
<div class="row">
           <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-12 mb-4">
              <div class="card border-left-<?php echo ($totalInStock>0?'success':'danger'); ?> shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <img id="productImage" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/products/<?php echo $productId;?>.jpg" <?php echo $imagePreview;?>  >
                    </div>
                    <?php echo ($viewMode=='full'?'':'</div>');//for compact view keep barcode in second row?>
                    <div class="col-auto" >
                      <div id="product<?php echo $productId;?>BarCode"></div>
                    </div>
                   <?php echo ($viewMode=='full'?'</div>':'')?>
                    
                      <div class=" row h5 mb-0 font-weight-bold text-gray-800">
                        <span title="Sale Price"><?php echo $salePrice;?></span>
                        <span title="Purchase Price" <?php echo $displayComponent;?>>/<?php echo $purchasePrice;?></span>
                      </div>
                      
                      <div class=" row text-xs font-weight-bold text-primary mb-1">
                      	<?php echo $productName;?> - (<?php echo $size;?>)
                      </div>

                      <div class=" row text-xs">
                        <?php echo ($totalInStock>0?($totalInStock>3?'In Stock:'.$totalInStock:'<span style="color:orange">Only '.$totalInStock.' left</span'):'<strike style="font-weight:bold;color:red;">Sold</strike>');?>&nbsp; <span <?php echo $displayComponent;?>> | Sold:<?php echo $totalSold;?></span>
                      </div>
                      
                        <?php $editProductParams = "'".$productId."','".$productName."','".$size."',".$purchasePrice.",".$salePrice.",".$totalInStock;?>
                       <div class="row">
                            <a title="Edit" href="#?productId=<?php echo $productId;?>" onclick="editProduct(<?php echo $editProductParams;?>)" class="editProduct btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#productFormModal" <?php echo $displayComponent;?>>
                            <i class="fas fa-pen"></i>
                            </a>
                             <a title="Add to Reciept" id="addToReciept" href="#?productId=<?php echo $productId;?>" onclick="addToReciept('<?php echo $productId;?>')" class="editProduct btn btn-info btn-circle btn-sm"  <?php echo (($viewMode=='compact'&& $totalInStock>0)?'':'style="display:none"');?>>
                            <i class="fas fa-plus"></i>
                            </a>
                            <span <?php echo $displayComponent;?>><?php echo $percentSold;?>% Sold</span>
                        </div>
                        <div class="row progress progress-sm mr-2" <?php echo $displayComponent;?>>
                          <div class="progress-bar <?php echo $progressBarColor;?>" role="progressbar" style="width: <?php echo $percentSold;?>%" aria-valuenow="<?php echo $totalSold;?>" aria-valuemin="0" aria-valuemax="<?php echo ($totalInStock+$totalSold);?>"></div>
                        </div>
                 
                </div>
              </div>
            </div>
</div>


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