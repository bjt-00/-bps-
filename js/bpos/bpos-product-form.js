$(document).ready(function(){
	
	$("#popupActionButton").click(function(){
		
		var restUrl = restApiPath+"product.php";
				
		$.ajax({
	        type: 'POST',
	        url:restUrl,
	        data: new FormData($("#productForm")[0]),
	        processData: false, 
	        contentType: false, 
	        success: function(returnval) {
	             successAlert(returnval);
	             $("#productFormModal").modal("hide");
	             setTimeout(location.reload(),9000);
	         }
	    });//end post call
		
	});//end saveProduct click
	
	
	//Image Preview
	$("#productImage").change(function(){
		
		var file = $("input[type=file]").get(0).files[0];
		 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#productImagePreview").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
	});
	
	
});

function editProduct(productId,productName,size,purchasePrice,salePrice,totalInStock){
	$("#action").val("Update");
	$("#popupActionButton").val("Update");
	
	$("#productId").val(productId);
	$("#productId").attr("readonly","true");
	$("#productName").val(productName);
	$("#size").val(size);
	$("#purchasePrice").val(purchasePrice);
	$("#salePrice").val(salePrice);
	$("#noOfItems").val(totalInStock);
	$("#productImagePreview").attr("src","img/companies/"+companyPrefix+"/products/"+productId+".png");
}