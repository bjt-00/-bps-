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
		  $('#newReciept').show();
	});
	
	$("#printReciept").click(function(){
		$("#sendEmailRecieptModal").modal("hide");
		
		//prepare reciept for print
		var recieptWidth = "width:275px;color:black;font-weight:bold;margin-left:2px;";
		var recieptWidth2 = recieptWidth+"font-size:16px;";
		recieptWidth = recieptWidth+"font-size:18px;";
		
		$("#recieptHeader").attr("style",recieptWidth2);
		$("#recieptAddress").attr("style",recieptWidth2);
		$("#recieptPhone").attr("style",recieptWidth2);
		$("#recieptWeb").attr("style",recieptWidth2);
		$("#recieptHeader3").attr("style",recieptWidth);
		$("#recieptBarCode").attr("style",recieptWidth);
		$("#recieptTable").attr("style",recieptWidth);
		$("#recieptSummary").attr("style",recieptWidth);
		
		$("#cashRecievedPreview").attr("style","color:black;font-weight:bold;");
		$("#cashRecieved").hide();
		$("#cashRecievedPreview").html($("#cashRecieved").val());
		
		window.print();
		location.reload();
	});

    $('#submitReciept').hide();
    $('#cancelReciept').hide();
    $('#printReciept').hide();
    $('#sendEmail').hide();
    $('#newReciept').hide();
    $('#deleteRecieptItem').hide();
		
} );

function addToReciept(productId){
	//$("#productListModal").modal("hide");
	$("#searchProduct").val(productId);
	$("#searchProduct").change();
}
