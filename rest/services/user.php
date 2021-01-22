<?php
session_start();
include '../util/AppConstants.php';
include '../businesslayer/UserService.php';
//include '../businesslayer/SecurityService.php';
include '../util/FileUtils.php';
include 'FrontController.php';

$frontController = new FrontController();
$url = $frontController->getUrlByRole(AppConstants::$ROLE_GUEST);
//$securityService = new SecurityService();
if(isset($_GET[AppConstants::$COMPANY_PREFIX]) || isset($_POST[AppConstants::$COMPANY_PREFIX])){
    $companyPrefix = (isset($_GET[AppConstants::$COMPANY_PREFIX])?
        $_GET[AppConstants::$COMPANY_PREFIX]:$_POST[AppConstants::$COMPANY_PREFIX]);
       $userService = new UserService();

        if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]!=AppConstants::$SEARCH_ALL){// && $securityService->isAuthentic()){
            echo $userService->search($companyPrefix,$_GET[AppConstants::$SEARCH]);
            
        }else if(isset($_GET[AppConstants::$SEARCH]) && $_GET[AppConstants::$SEARCH]==AppConstants::$SEARCH_ALL){
            echo $userService->getUserList($companyPrefix);
        }else if(isset($_POST[AppConstants::$ACTION])){
            session_start();
            $response='';
            $storeId = (isset($_POST['storeId'])?$_POST['storeId']:'');
            $role = (isset($_POST['role'])?$_POST['role']:'');
            $role = (isset($_SESSION[AppConstants::$ACTION_ACTIVATED])?AppConstants::$ROLE_SALES_MANAGER:$role);
            
            if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_ADD){
                //$companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone
                $response = $userService->add($companyPrefix,$_POST['loginId'],$storeId,
                    $role,$_POST['email'],$_POST['firstName'],$_POST['lastName'],$_POST['password'],$_POST['phone']);
            }else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UPDATE){
                $response = $userService->update($companyPrefix,$_POST['loginId'],$storeId,
                    $role,$_POST['email'],$_POST['firstName'],$_POST['lastName'],$_POST['password'],$_POST['phone']);
            }else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_LOCK){
                $response=$userService->lockAccount($companyPrefix,$_POST['loginId']);
            }else if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UNLOCK){
                $response=$userService->unlockAccount($companyPrefix,$_POST['loginId']);
            }
            
            if(isset($_FILES['userImage']) && $_FILES['userImage']['name']!=''){
            $fileUtils = new FileUtils();
            $response .= $fileUtils->upload($companyPrefix,AppConstants::$UPLOAD_USERS_FOLDER,$_FILES['userImage'],$userService->getUserId());
            }
            //echo $response;
            $_SESSION[AppConstants::$ALERT_TYPE_INFO]=$response;
            
            if(isset($_SESSION[AppConstants::$ACTION_ACTIVATED])){
                unset($_SESSION['accountActivationMessage']);
                unset($_SESSION['activate']);
                $url = $frontController->getUrlByRole(AppConstants::$ROLE_GUEST);
                header("location:".$url);
            }
            
        }else{
            echo AppConstants::$MESSAGE_BAD_REQUEST;
        }

}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}
?>