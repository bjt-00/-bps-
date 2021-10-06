 <?php 
 $companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
 ?>
<form id="paymentForm" name="paymentForm" action="rest/services/billing.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="action"        id="paymentFormAction" value="Update">
	<input type="hidden" name="companyPrefix" id="companyPrefix" value="<?php echo $companyPrefix;?>">
	<input type="hidden" name="billId" id="billId">

    <select id="dueBills" name="dueBills" class="form-control">
    </select>
    <input type="text"   id="paymentTransactionId" name="paymentTransactionId" placeholder="Payment Reference Number" required="required" class="form-control">
    <input type="number" id="amountPaid"  name="amountPaid" placeholder="Amount Paid" class="form-control" readonly="readonly">
    <input type="date"   id="paymentDate" name="paymentDate" placeholder="Billing Month" class="form-control" pattern="yyyy-dd-mm" required="required" >
    <input type="file"   id="paymentReciept" name="paymentReciept" placeholder="Payment Receipt">
</form>
    <input type="submit" id="paymentButton" name="paymentButton" class="form-control">
<script src="js/bpos/billing/bpos-payment-form.js"></script>
