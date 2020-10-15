<?php 
//session_start();
include '../util/AppConstants.php';
//include '../businesslayer/SecurityService.php';
include '../businesslayer/ReportService.php';

//$securityService = new SecurityService();
$reportService = new ReportService();

if(isset($_GET[AppConstants::$SEARCH])){ //&& $securityService->isAuthentic()){
    echo $reportService->search($_GET[AppConstants::$SEARCH],$_GET[AppConstants::$COMPANY_PREFIX]);
    
}else{
    echo AppConstants::$MESSAGE_FORBIDDEN;
}

?>