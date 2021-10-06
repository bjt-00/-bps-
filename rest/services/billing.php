<?php 
//session_start();
include '../util/AppConstants.php';
//include '../businesslayer/SecurityService.php';
include '../businesslayer/BillingService.php';
include '../util/FileUtils.php';

//$securityService = new SecurityService();
$billingService = new BillingService();

if(isset($_GET[AppConstants::$SEARCH])){ //&& $securityService->isAuthentic()){
    echo $billingService->search($_GET[AppConstants::$SEARCH],$_GET[AppConstants::$COMPANY_PREFIX]);
    
}else if(isset($_POST[AppConstants::$ACTION])){
    session_start();
    $response="default message ";
    $companyPrefix = $_POST[AppConstants::$COMPANY_PREFIX];
    
    if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UPDATE){
        $response = $billingService->update($companyPrefix,$_POST['billId'],$_POST['paymentTransactionId'],$_POST['paymentDate']);
    }
    
    if(isset($_FILES[AppConstants::$UPLOAD_PAYMENT_RECIEPT]) && $_FILES[AppConstants::$UPLOAD_PAYMENT_RECIEPT]['name']!=''){
        $fileUtils = new FileUtils();
        $uploadFileName = $_POST['billId'];
        $response .= $fileUtils->upload($companyPrefix,AppConstants::$UPLOAD_RECIEPTS_FOLDER,$_FILES[AppConstants::$UPLOAD_PAYMENT_RECIEPT],$uploadFileName);
    }
    echo $response;
}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}

?>