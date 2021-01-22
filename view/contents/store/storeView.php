<?php
session_start();
$companyId = (isset($_GET['companyId'])?$_GET['companyId']:'000');
$storeId = (isset($_GET['storeId'])?$_GET['storeId']:'000');
$storeName = (isset($_GET['storeName'])?$_GET['storeName']:'');
$storeAddress = (isset($_GET['storeAddress'])?$_GET['storeAddress']:'');
$storePhone = (isset($_GET['storePhone'])?$_GET['storePhone']:'10');
$managerName = (isset($_GET['managerName'])?$_GET['managerName']:'');
$managerPhone = (isset($_GET['managerPhone'])?$_GET['managerPhone']:'');
$managerEmail = (isset($_GET['managerEmail'])?$_GET['managerEmail']:'');
$status = (isset($_GET['status'])?$_GET['status']:'0');
$emptySlotId =(isset($_GET['emptySlotId'])?$_GET['emptySlotId']:'0');


$companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
$viewMode = (isset($_GET['viewMode'])?$_GET['viewMode']:'default');
$fullModeControll=($viewMode!='full'?"style='display:none'":'');
$labelModeControll=($viewMode=='printlabel'?'style="display:none"':'');
$imagePreview=(($viewMode!='full' && $viewMode!='printlabel')?"style='width:100px;height:90px;'":"style='width:150px;height:140px;'");
?>

<div class="row smallBox">
           <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-12 mb-4">
              <div class="card border-left-<?php echo ($status>0?'success':'danger'); ?> shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <!-- div class="col mr-2">
                      img id="userImage" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/users/<?php echo $storeId;?>.png" <?php echo $imagePreview;?>  >
                    </div-->
                    <?php echo (($viewMode=='full' || $viewMode=='printlabel')?'':'</div>');//for compact view keep barcode in second row?>
                    <!-- div class="col-auto" >
                      <div id="product<?php echo $storeId.$emptySlotId;?>BarCode"></div>
                    </div-->
                   <?php echo (($viewMode=='full' || $viewMode=='printlabel')?'</div>':'')?>
                    
                      <div class=" row h5 mb-0 font-weight-bold text-gray-800">
                        <span title="Store Name"><?php echo $storeName;?></span>
                      </div>
                      
                      <div class=" row text-xs font-weight-bold text-primary mb-1">
                      	(Manager: <?php echo $managerName;?> )
                      </div>
                      
                      <div class=" row text-xs font-weight-bold text-primary mb-1">
                      	<i class="fas fa-building">&nbsp;<?php echo $storeAddress;?></i>
                      </div>
                      
                      <div class=" row text-xs" <?php echo $labelModeControll;?>>
                        <i class="fas fa-phone">&nbsp;<?php echo $storePhone;?></i>
                      </div>
                      
                      <div class=" row text-xs" <?php echo $labelModeControll;?>>
                        <i class="fas fa-phone" title="Manager Phone">&nbsp;<?php echo $managerPhone;?></i>
                      </div>
                      
                       <div class=" row text-xs" <?php echo $labelModeControll;?>>
                        <i class="fas fa-envelope" title="Manager Email">&nbsp;<?php echo $managerEmail;?></i>
                      </div>
                      
                        <?php 
                        $csvUserParams="'".$storeId."','".$storeName."','".$storePhone."','".$storeAddress."'";
                        ?>
                       <div class="row">
                            <a id"store-<?php echo $storeId."-edit";?>" title="Edit" href="#" onclick="editStore(<?php echo $csvUserParams;?>)" class="editProduct btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#storeFormModal" <?php echo $fullModeControll;?>>
                            <i class="fas fa-pen"></i>
                            </a>
                           
                           <a id="store-<?php echo $storeId."-button";?>" title="<?php echo ($status==1?"Lock":"Unlock")." ".$storeId; ?>" href="#" onclick="<?php echo ($status==1?"lockStore":"unlockStore")."('".$companyId."','".$storeId."','".$storeName."')";?>" class="editUser btn btn-<?php echo ($status==1?"success":"danger");?> btn-circle btn-sm" >
                            <i id="store-<?php echo $storeId;?>-icon" class="fas fa-<?php echo ($status==1?"unlock":"lock");?>"></i>
                           </a>
                        </div>
                 
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
   $("#product<?php echo $storeId.$emptySlotId;?>BarCode").barcode("<?php echo $storeId;?>","datamatrix");
   </script>