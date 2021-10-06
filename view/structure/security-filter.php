<?php 
include 'rest/util/AppConstants.php';

$sfUserRole = (isset($_SESSION[AppConstants::$USER_ROLE])?$_SESSION[AppConstants::$USER_ROLE]:AppConstants::$ROLE_GUEST);
$sfUserName = (isset($_SESSION[AppConstants::$USER_NAME])?$_SESSION[AppConstants::$USER_NAME]:AppConstants::$ROLE_GUEST);

$requestUri = $_SERVER['REQUEST_URI'];

//Step-1: Protocol Filter http to https conversion
if(!strpos($requestUri,'https://www.bitguiders.com')&& !strpos($requestUri,'localhost') && !isset($_SESSION['dontRedirectAgain'])){
    header('location:https://www.bitguiders.com/bpos');
    $_SESSION['dontRedirectAgain']='yes';
}

//Step-2: Authentication Filter, verify if user is logged in
if(!isset($_SESSION['loginId']) && (!strpos($requestUri,'login.php') &&!strpos($requestUri,'register.php')
    &&!strpos($requestUri,'forgot-password.php'))){
    header('location:login.php');
}
//Step-3: Authorization Filter, verify if logged in user is authorized to view this resource
if( (strpos($requestUri,'dashboard.php')||strpos($requestUri,'user.php')
    ||strpos($requestUri,'product.php')||strpos($requestUri,'printlabel.php')
    ||strpos($requestUri,'store.php')) 
    && ($sfUserRole!=AppConstants::$ROLE_ADMIN && $sfUserRole!=AppConstants::$ROLE_SALES_MANAGER)){
    $_SESSION[AppConstants::$ALERT_TYPE_INFO]="Sorry, you are not authorized to access this resource.";
    header('location:pos.php');
} 
?>