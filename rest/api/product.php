<?php
//session_start();
include '../dataaccess/ProductDAO.php';
include '../util/ApplicationConstants.php';
include '../services/SecurityService.php';

$securityService = new SecurityService();
$product = new ProductDAO();

if(isset($_GET['search']) && $securityService->isAuthentic()){
    echo $product->search($_GET['search']);
    
}else if(isset($_POST['recieptDetails']) && $securityService->isAuthentic()){
    $transactionId=$product->add($_POST['recieptDetails'],$_SESSION['loginId'],$_SESSION['role']);
    //$transactionId=$product->add($_POST['recieptDetails'],'salesman','salesman');

    echo '{"transactionId":'.$transactionId.'}';
} else{
    echo '{"message":"Request Forbidden"}';
}
?>