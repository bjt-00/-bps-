<?php 

//session_start();
include '../util/AppConstants.php';
include '../businesslayer/SecurityService.php';
include '../businesslayer/StoreService.php';

$securityService = new SecurityService();
$storeService = new StoreService();

if(isset($_GET[AppConstants::$SEARCH]) && $securityService->isAuthentic()){
    echo $storeService->search($_GET[AppConstants::$SEARCH],$_SESSION[AppConstants::$COMPANY_PREFIX]);
    
}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}

?>