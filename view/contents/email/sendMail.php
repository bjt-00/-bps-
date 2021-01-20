 <?php include '../../../rest/businesslayer/EmailService.php';?>


<?php
/*
		$messageTemplate='';
			try{
	    			$templateName ='orderConfirmationTemplate';
	
					$filename = "../../../view/contents/email/templates/".$templateName.".php";
					$file = fopen($filename, "r");
					$messageTemplate = fread($file, filesize($filename));
					fclose($file);
							
				}catch (Exception $ex){
					$ex->getMessage();
				}
*/
?>
<?php 
	
?>

 <?php 
$emailService = new EmailService();
$messageTemplate = $emailService->getTemplate('orderConfirmationTemplate');
$messageTemplate = str_replace("<ORDER_NO>", 13, $messageTemplate);
echo $messageTemplate;


//$emailService->mail("",$_GET['email'].",info@bitguiders.com","bitguiders ::: Reforming bits [ Order Confirmation ]",$messageTemplate);
?>
