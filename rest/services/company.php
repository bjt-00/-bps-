<?php 

include '../util/AppConstants.php';
include '../businesslayer/CompanyService.php';
//include '../businesslayer/SecurityService.php';

//$securityService = new SecurityService();
$companyService = new CompanyService();

 echo $companyService->getList();

?>