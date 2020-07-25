<?php 
session_start();
include '../dataaccess/SecurityDAO.php';
include 'FrontController.php';
include '../util/AppConstants.php';

$dao = new SecurityDAO();
$frontController = new FrontController();
$url=$frontController->getUrlByRole(AppConstants::$ROLE_GUEST);
//login
if(isset($_POST['login'])){
    
    if($dao->login($_POST['companyId'],$_POST['loginId'], $_POST['password'])){
        $url= $frontController->getUrlByRole($_SESSION['role']);// "../../dashboard.php";
    }
}else if(isset($_GET['logout'])){
    $dao->logout();
}else if(isset($_SESSION['loginId'])){
    $url=$frontController->getUrlByRole($_SESSION['role']);
}

    header("location:".$url);
?>