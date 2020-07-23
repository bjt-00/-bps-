<?php 
session_start();
include '../dataaccess/SecurityDAO.php';
include 'FrontController.php';
include '../util/ApplicationConstants.php';

$dao = new SecurityDAO();
$frontController = new FrontController();
$url=$frontController->getUrlByRole(ApplicationConstants::$ROLE_GUEST);
//login
if(isset($_POST['login'])){
    
    if($dao->login($_POST['loginId'], $_POST['password'])){
        $url= $frontController->getUrlByRole($_SESSION['role']);// "../../dashboard.php";
    }
}else if(isset($_GET['logout'])){
    $dao->logout();
}else if(isset($_SESSION['loginId'])){
    $url=$frontController->getUrlByRole($_SESSION['role']);
}

    header("location:".$url);
?>