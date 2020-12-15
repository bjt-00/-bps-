<?php
session_start();
include '../businesslayer/RecieptService.php';
include '../util/AppConstants.php';
//include '../businesslayer/SecurityService.php';

//$securityService = new SecurityService();
$recieptService = new RecieptService();

if(isset($_GET[AppConstants::$SEARCH])){// && $securityService->isAuthentic()){
    echo $recieptService->search($_GET[AppConstants::$COMPANY_PREFIX],$_GET[AppConstants::$SEARCH]);
    
}else if(isset($_POST['recieptDetails'])){// && $securityService->isAuthentic()){
    $recieptDetails = $_POST['recieptDetails'];
    $transactionId = $recieptDetails['transactionId'];
    
    if($transactionId>0){
        $transactionId=$recieptService->update($_POST['recieptDetails'],
            $_SESSION[AppConstants::$LOGIN_ID],
            $_SESSION[AppConstants::$USER_ROLE],
            $_POST[AppConstants::$COMPANY_PREFIX]);
    }else{
      $transactionId=$recieptService->add($_POST['recieptDetails'],
        $_SESSION[AppConstants::$LOGIN_ID],
        $_SESSION[AppConstants::$USER_ROLE],
        $_POST[AppConstants::$COMPANY_PREFIX]);
    }
    
    echo '{"transactionId":'.$transactionId.'}';
} else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>