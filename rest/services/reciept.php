<?php
session_start();
include '../businesslayer/RecieptService.php';
include '../util/AppConstants.php';
//include '../businesslayer/SecurityService.php';

//$securityService = new SecurityService();
$recieptService = new RecieptService();

if(isset($_GET[AppConstants::$SEARCH])){// && $securityService->isAuthentic()){
   // echo $recieptService->search($_GET[AppConstants::$SEARCH],$_GET[AppConstants::$COMPANY_PREFIX]);
    
}else if(isset($_POST['recieptDetails'])){// && $securityService->isAuthentic()){
    $transactionId=$recieptService->add($_POST['recieptDetails'],
        $_SESSION[AppConstants::$LOGIN_ID],
        $_SESSION[AppConstants::$USER_ROLE],
        $_POST[AppConstants::$COMPANY_PREFIX]);

    echo '{"transactionId":'.$transactionId.'}';
} else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>