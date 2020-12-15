	var recieptDetails = {"transactionId":-1,"entries":0,"tax":0,"totalAmount":0,"cashRecieved":0,"balance":0,"customerId":"Guest","recieptProducts":[]};

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
		
		$("#recieptDiv").attr("style",recieptWidth2);
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

function resetReciept(){
	recieptTable.rows().remove().draw( false );
	recieptDetails.transactionId=-1;
	$("#returnedProductId").val(-1);
	balance=0;
	totalAmount=0;
	tax=0;
	entries=0;
	$("#totalAmount").html(totalAmount);
    $("#entries").html(entries);
    $('#balance').html(balance);
    $("#productPrice").html(0);
	var transactionId ="000";
	  $('#transactionId').html(transactionId);
	  $("#transactionIdBarcode").html("").show().barcode(transactionId,"datamatrix");
	  
}
$("#searchReciept").change(function(){
	isReturnMode=true;
	resetReciept();//clear existing reciept
	
	var searchText = $(this).val();
	$(this).val("");
	
	 var url = restServicesPath+"reciept.php";
		$.get(url,{"sid":sid,"search":searchText,"companyPrefix":companyPrefix},
		function(searchResult){
			$("#recieptDescription").show();
			$("#recieptDescription").html("Return Following Items!");
			$.each(searchResult,function(i,recieptItem){
				
				if(recieptItem.price<0){
					$("#returnedProductId").val(recieptItem.productId);
				}else{
					$("#returnedProductId").val(-1);
					$("#productQuantity").val(1);
				}
				$("#productQuantity").val(recieptItem.quantity);
				
				addToReciept(recieptItem.productId);
				recieptDetails.transactionId=recieptItem.transactionId;
				
				var transactionId =recieptItem.transactionId+"";
				  $('#transactionId').html(transactionId);
				  $("#transactionIdBarcode").html("").show().barcode(transactionId,"datamatrix");

				  
			});

		},"json");
		
	$(this).focus();
});
