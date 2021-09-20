<?php 
session_start();
include '../util/AppConstants.php';
//include '../businesslayer/SecurityService.php';
include '../businesslayer/StoreService.php';

//$securityService = new SecurityService();
$storeService = new StoreService();

if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]!=AppConstants::$SEARCH_ALL){// && $securityService->isAuthentic()){
    echo $storeService->search($_GET[AppConstants::$SEARCH],$_GET[AppConstants::$COMPANY_PREFIX]);
    
}else if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]==AppConstants::$SEARCH_ALL){
    echo $storeService->getStoreList($_GET[AppConstants::$COMPANY_PREFIX]);
}else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_ADD){
    
    $response=$storeService->add($_POST[AppConstants::$COMPANY_PREFIX],$_SESSION['companyId'],$_POST['storeName'],$_POST['storeAddress'],$_POST['storePhone'],$_POST['storeTax'],$_POST['storeTaxType'],AppConstants::$STATUS_ACTIVE);
    $_SESSION[AppConstants::$ALERT_TYPE_INFO]=$response;
}else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UPDATE){
    
    $response=$storeService->update($_POST[AppConstants::$COMPANY_PREFIX],$_SESSION['companyId'],$_POST['storeId'],$_POST['storeName'],$_POST['storeAddress'],$_POST['storePhone'],$_POST['storeTax'],$_POST['storeTaxType']);
    $_SESSION[AppConstants::$ALERT_TYPE_INFO]=$response;
}else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_LOCK){
    $response=$storeService->lockStore($_POST[AppConstants::$COMPANY_PREFIX],$_POST['companyId'],$_POST['storeId']);
}else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UNLOCK){
    $response=$storeService->unlockStore($_POST[AppConstants::$COMPANY_PREFIX],$_POST['companyId'],$_POST['storeId']);
}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}

?>