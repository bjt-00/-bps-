<?php 

include '../util/AppConstants.php';
include '../businesslayer/CompanyService.php';
include '../util/FileUtils.php';
include 'FrontController.php';

$frontController = new FrontController();
$url=$frontController->getUrlByRole(AppConstants::$ROLE_GUEST);

//include '../businesslayer/SecurityService.php';

//$securityService = new SecurityService();
$companyService = new CompanyService();

if(isset($_POST['register'])){
   session_start();
   $status= $companyService->register($_POST['companyName'], $_POST['companyAddress'], $_POST['companyPhone'], $_POST['companyEmail']);
   //echo $status;
   if(!strpos($status,'error')){
    header("location:".$url);
   }
}else if(isset($_POST[AppConstants::$ACTION])){
    session_start();
    $response="default message ";
    $companyPrefix = $_POST[AppConstants::$COMPANY_PREFIX];
    
    if($_POST[AppConstants::$ACTION]==AppConstants::$ACTION_UPDATE){
        $response=$companyService->update($companyPrefix, $_POST['companyId'], $_POST['companyAddress'], $_POST['companyPhone']);
    }
    
    if(isset($_FILES['companyLogo']) && $_FILES['companyLogo']['name']!=''){
        $fileUtils = new FileUtils();
        $response .= $fileUtils->upload($companyPrefix,AppConstants::$UPLOAD_COMPANY_LOGO,$_FILES['companyLogo'],$companyPrefix);
    }
    echo $response;
    
}else if(isset($_GET[AppConstants::$COMPANY_ACTIVATION_CODE])){
    session_start();
    $status= $companyService->verifyEmail($_GET[AppConstants::$COMPANY_ACTIVATION_CODE]);
    //echo $status;
    $url=$frontController->getUrlByRole(AppConstants::$ROLE_NEW_USER);
    header("location:".$url);
}else if(isset($_GET[AppConstants::$SEARCH])){
    echo $companyService->getCompanyById($_GET[AppConstants::$SEARCH]);
}else{
 echo $companyService->getList();
}

?>