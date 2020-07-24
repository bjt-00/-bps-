<?php 
session_start();
header('Access-Control-Allow-Origin: *');
if(!isset($_SESSION['loginId']) && !strpos($_SERVER['REQUEST_URI'],'login.php')){
    header('location:login.php');
}
?>
<div id="sid" style="display:none"><?php echo session_id();?></div>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo "BPOS".(isset($_GET['title'])?" :: ".$_GET['title']:"")?></title>

  <?php include 'imports.php';?>
</head>
