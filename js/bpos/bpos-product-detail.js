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
	
	
	$("#searchProduct").focus();
	$("#addProduct").hide();
} );