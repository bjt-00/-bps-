$(document).ready(function() {

	//itemMode checkbox
	$("#autoAddMode").click(function(){
		var isAutoMode=$("#autoAddMode").prop("checked");
		if(isAutoMode){
			$("#addProduct").hide();
		}else{
			$("#addProduct").show();
		}
		$("#searchProduct").focus();
	});
	
	//itemDiscount range input
	$("#productDiscount").click(function(){
		var discount = $(this).val();
		
		if(discount>0){
			$("#discount").html(" - "+discount);
			var productPrice = $("#productPrice").html();
			$("#priceTag").html(productPrice-discount);
		}else{
			$("#discount").html(" - 0");
		}
		$("#searchProduct").focus();
	});
		
	//itemQuantity range input
	$("#productQuantity").click(function(){
		var quantity = $(this).val();
		
		if(quantity>0){
			$("#quantity").html(" - "+quantity);
		}else{
			$("#quantity").html(" - 1");
		}
		$("#searchProduct").focus();
	});
	
	$("#printReciept").click(function(){
		$("#sendEmailRecieptModal").modal("hide");
		
		//prepare reciept for print
		var recieptWidth = "width:275px;color:black;font-weight:bold;margin-left:2px;";
		$("#recieptHeader1").attr("style",recieptWidth);
		$("#recieptHeader2").attr("style",recieptWidth);
		$("#recieptHeader3").attr("style",recieptWidth);
		$("#recieptBarCode").attr("style",recieptWidth);
		$("#dTable").attr("style",recieptWidth);
		$("#recieptSummary").attr("style",recieptWidth);
		
		$("#cashRecievedPreview").attr("style","color:black;font-weight:bold;");
		$("#cashRecieved").hide();
		$("#cashRecievedPreview").html($("#cashRecieved").val());
		
		window.print();
		location.reload();
	});
	
	$("#searchProduct").focus();
	$("#addProduct").hide();
} );