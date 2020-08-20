<?php
//session_start();
include '../util/AppConstants.php';
include '../businesslayer/ProductService.php';
//include '../businesslayer/SecurityService.php';

//$securityService = new SecurityService();
if(isset($_GET[AppConstants::$COMPANY_PREFIX])){
       $companyPrefix = $_GET[AppConstants::$COMPANY_PREFIX];
       $productService = new ProductService();

        if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]!="*"){// && $securityService->isAuthentic()){
            echo $productService->search($_GET[AppConstants::$SEARCH],$companyPrefix);
            
        }else if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]=="*"){
            echo $productService->getProductList($companyPrefix);
        }else{
            echo AppConstants::$MESSAGE_BAD_REQUEST;
        }

}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>