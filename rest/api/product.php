<?php
//session_start();
include '../dataaccess/ProductDAO.php';
include '../util/AppConstants.php';
include '../services/SecurityService.php';

$securityService = new SecurityService();
$product = new ProductDAO();

if(isset($_GET[AppConstants::$SEARCH]) && $securityService->isAuthentic()){
    echo $product->search($_GET[AppConstants::$SEARCH],$_SESSION[AppConstants::$COMPANY_PREFIX]);
    
}else if(isset($_POST['recieptDetails']) && $securityService->isAuthentic()){
    $transactionId=$product->add($_POST['recieptDetails'],
        $_SESSION[AppConstants::$LOGIN_ID],
        $_SESSION[AppConstants::$USER_ROLE],
        $_SESSION[AppConstants::$COMPANY_PREFIX]);

    echo '{"transactionId":'.$transactionId.'}';
} else{
    echo '{"message":"Request Forbidden"}';
}
?>