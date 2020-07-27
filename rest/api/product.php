<?php
//session_start();
include '../businesslayer/ProductService.php';
include '../util/AppConstants.php';
include '../businesslayer/SecurityService.php';

$securityService = new SecurityService();
$productService = new ProductService();

if(isset($_GET[AppConstants::$SEARCH]) && $securityService->isAuthentic()){
    echo $productService->search($_GET[AppConstants::$SEARCH],$_SESSION[AppConstants::$COMPANY_PREFIX]);
    
}else if(isset($_POST['recieptDetails']) && $securityService->isAuthentic()){
    $transactionId=$productService->add($_POST['recieptDetails'],
        $_SESSION[AppConstants::$LOGIN_ID],
        $_SESSION[AppConstants::$USER_ROLE],
        $_SESSION[AppConstants::$COMPANY_PREFIX]);

    echo '{"transactionId":'.$transactionId.'}';
} else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>