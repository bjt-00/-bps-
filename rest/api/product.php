<?php
//session_start();
include '../util/AppConstants.php';
include '../businesslayer/ProductService.php';
//include '../businesslayer/SecurityService.php';
include '../util/FileUtils.php';

//$securityService = new SecurityService();
if(isset($_GET[AppConstants::$COMPANY_PREFIX]) || isset($_POST[AppConstants::$COMPANY_PREFIX])){
    $companyPrefix = (isset($_GET[AppConstants::$COMPANY_PREFIX])?
        $_GET[AppConstants::$COMPANY_PREFIX]:$_POST[AppConstants::$COMPANY_PREFIX]);
       $productService = new ProductService();

        if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]!="*"){// && $securityService->isAuthentic()){
            echo $productService->search($companyPrefix,$_GET[AppConstants::$SEARCH]);
            
        }else if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]=="*"){
            echo $productService->getProductList($companyPrefix);
        }else if(isset($_POST[AppConstants::$ACTION])&& isset($_POST[AppConstants::$ACTION])){
            $response='';
            if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_ADD){
                $response = $productService->add($companyPrefix,$_POST['productId'],$_POST['productName'],
                    $_POST['noOfItems'],$_POST['purchasePrice'],$_POST['salePrice'],$_POST['size']);
            }else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UPDATE){
                $response = $productService->update($companyPrefix,$_POST['productId'],$_POST['productName'],
                    $_POST['noOfItems'],$_POST['purchasePrice'],$_POST['salePrice'],$_POST['size']);
            }
            
            if(isset($_FILES['productImage']) && $_FILES['productImage']['name']!=''){
            $fileUtils = new FileUtils();
            $response .= $fileUtils->upload($companyPrefix,AppConstants::$UPLOAD_PRODUCTS_FOLDER,$_FILES['productImage'],$productService->getProductId());
            }
            echo $response;
            $_SESSION[AppConstants::$ALERT_TYPE_INFO]=$response;
            
        }else{
            echo AppConstants::$MESSAGE_BAD_REQUEST;
        }

}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>