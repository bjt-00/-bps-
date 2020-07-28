	var recieptDetails = {"entries":0,"tax":0,"totalAmount":0,"cashRecieved":0,"balance":0,"customerId":"Guest","recieptProducts":[]};

// Call the dataTables jQuery plugin
$(document).ready(function() {

	$("#submitReciept").click(function(){
		
		//setProductDetails(0,"","","",0,"","");
		
		 var url = restServicesPath+"reciept.php";

				 
		$.post( url, {"recieptDetails":recieptDetails,"companyPrefix":companyPrefix},function( data ) {
			var transactionId =data.transactionId+"";
			  $('#transactionId').html(transactionId);
			  $("#transactionIdBarcode").html("").show().barcode(transactionId,"datamatrix");
			  
		  },'json');
		
		
		  $(this).hide();
		  $('#cancelReciept').hide();
		  $('#printReciept').show();
		  $('#sendEmail').show();
	});
	
    $('#submitReciept').hide();
    $('#cancelReciept').hide();
    $('#printReciept').hide();
    $('#sendEmail').hide();
		
} );