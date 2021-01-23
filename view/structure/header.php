<?php 
session_start();
header('Access-Control-Allow-Origin: *');
$requestUri = $_SERVER['REQUEST_URI'];
if(!strpos($requestUri,'http://www.bitguiders.com')&& !strpos($requestUri,'localhost') && !isset($_SESSION['dontRedirectAgain'])){
    header('location:http://www.bitguiders.com/bpos');
    $_SESSION['dontRedirectAgain']='yes';
}

if(!isset($_SESSION['loginId']) && (!strpos($requestUri,'login.php') &&!strpos($requestUri,'register.php')
    &&!strpos($requestUri,'forgot-password.php'))){
    header('location:login.php');
}
$display="style='display:none'";
?>

<?php 
  
  $companyName = (isset($_SESSION['companyName'])?$_SESSION['companyName']:'BPOS');
  $companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
  $storeId = (isset($_SESSION['storeId'])?$_SESSION['storeId']:'0');
  
?>
<span id="varSid" style="display:none"><?php echo session_id();?></span>
<span id="varCompanyPrefix" style="display:none"><?php echo $companyPrefix;?></span>
<span id="varStoreId" style="display:none"><?php echo $storeId;?></span>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo "BPOS".(isset($_GET['title'])?" :: ".$_GET['title']:"")?></title>

  <?php include 'imports.php';?>
</head>
