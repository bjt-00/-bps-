<?php 
session_start();
include '../util/AppConstants.php';
include 'FrontController.php';
include '../businesslayer/SecurityService.php';

$securityService = new SecurityService();
$frontController = new FrontController();
$url=$frontController->getUrlByRole(AppConstants::$ROLE_GUEST);
//login
if(isset($_POST['login'])){
    
    if($securityService->login($_POST['companyPrefix'],$_POST['loginId'], $_POST['password'])){
        $_SESSION['companyPrefix']=$_POST['companyPrefix'];
        $url= $frontController->getUrlByRole($_SESSION['role']);// "../../dashboard.php";
    }
}else if(isset($_GET['logout'])){
    $securityService->logout();
}else if(isset($_SESSION['loginId'])){
    $url=$frontController->getUrlByRole($_SESSION['role']);
}
    header("location:".$url);
?>