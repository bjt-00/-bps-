<?php
//session_start();
include '../util/AppConstants.php';
include '../businesslayer/ProductService.php';
//include '../businesslayer/SecurityService.php';

//$securityService = new SecurityService();
$productService = new ProductService();

if(isset($_GET[AppConstants::$SEARCH])){// && $securityService->isAuthentic()){
    echo $productService->search($_GET[AppConstants::$SEARCH],$_GET[AppConstants::$COMPANY_PREFIX]);
    
} else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>