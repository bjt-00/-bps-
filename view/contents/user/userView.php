<?php
session_start();
$userId4uv = (isset($_GET['userId'])?$_GET['userId']:'000');
$firstName4uv = (isset($_GET['firstName'])?$_GET['firstName']:'');
$lastName4uv = (isset($_GET['lastName'])?$_GET['lastName']:'');
$userName4uv = $firstName4uv." ".$lastName4uv;
$role4uv = (isset($_GET['role'])?$_GET['role']:'');
$userPhone = (isset($_GET['userPhone'])?$_GET['userPhone']:'10');
$storeId = (isset($_GET['storeId'])?$_GET['storeId']:'1');
$storeName = (isset($_GET['storeName'])?$_GET['storeName']:'');
$userEmail = (isset($_GET['userEmail'])?$_GET['userEmail']:'');
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
                    <div class="col mr-2">
                      <img id="userImage" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/users/<?php echo $userId4uv;?>.png" <?php echo $imagePreview;?>  >
                    </div>
                    <?php echo (($viewMode=='full' || $viewMode=='printlabel')?'':'</div>');//for compact view keep barcode in second row?>
                    <div class="col-auto" >
                      <div id="product<?php echo $userId4uv.$emptySlotId;?>BarCode"></div>
                    </div>
                   <?php echo (($viewMode=='full' || $viewMode=='printlabel')?'</div>':'')?>
                    
                      <div class=" row h5 mb-0 font-weight-bold text-gray-800">
                        <span title="User Name"><?php echo $userName4uv;?></span>
                      </div>
                      
                      <div class=" row text-xs font-weight-bold text-primary mb-1">
                      	( <?php echo $role4uv;?> )
                      </div>
                      
                      <div class=" row text-xs font-weight-bold text-primary mb-1">
                      	<i class="fas fa-building">&nbsp;<?php echo $storeName;?></i>
                      </div>
                      
                      <div class=" row text-xs" <?php echo $labelModeControll;?>>
                        <i class="fas fa-phone">&nbsp;<?php echo $userPhone;?></i>
                      </div>
                      
                       <div class=" row text-xs" <?php echo $labelModeControll;?>>
                        <i class="fas fa-envelope">&nbsp;<?php echo $userEmail;?></i>
                      </div>
                      
                        <?php 
                        $csvUserParams="'".$userId4uv."','".$firstName4uv."','".$lastName4uv."','".$role4uv."','".$storeId."','".$userEmail."',".$status.",".$userPhone;
                        ?>
                       <div class="row">
                            <a id"<?php echo $userId4uv."-edit";?>" title="Edit" href="#" onclick="editUser(<?php echo $csvUserParams;?>)" class="editProduct btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#userFormModal" <?php echo $fullModeControll;?>>
                            <i class="fas fa-pen"></i>
                            </a>
                           
                           <a id="<?php echo $userId4uv."-button";?>" title="<?php echo ($status==1?"Lock":"Unlock")." ".$userId4uv; ?>" href="#" onclick="<?php echo ($status==1?"lockAccount":"unlockAccount")."('".$userId4uv."')";?>" class="editUser btn btn-<?php echo ($status==1?"success":"danger");?> btn-circle btn-sm" >
                            <i id="<?php echo $userId4uv;?>-icon" class="fas fa-<?php echo ($status==1?"unlock":"lock");?>"></i>
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
   $("#product<?php echo $userId4uv.$emptySlotId;?>BarCode").barcode("<?php echo $userId4uv;?>","datamatrix");
   </script>