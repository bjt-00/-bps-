$(document).ready(function(){
	
	$("#companyFormPopupActionButton").click(function(){
		
		var restUrl = restServicesPath+"company.php";

		$.ajax({
	        type: 'POST',
	        url:restUrl,
	        data: new FormData($("#companyForm")[0]),
	        processData: false, 
	        contentType: false, 
	        success: function(returnval) {
	             successAlert(returnval);
	             $("#companyFormModal").modal("hide");
            	 setTimeout(location.reload(),9000);
	         }
	    });//end post call
		
	});//end saveProduct click

	//Image Preview
	$("#companyLogo").change(function(){
		
		//var file = $("input[type=file]").get(1).files[0];
		var file = $(this).prop('files')[0]; 
		
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#companyLogoPreview").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
	});
});

function editCompany(companyId){
	var restUrl = restServicesPath+"company.php";
	$.get(restUrl,{"sid":sid,"search":companyId,"companyPrefix":companyPrefix},
			function(companies){
				$.each(companies,function(i,c){
		        	editCompanyProfile(companyId,c.companyName,c.companyAddress,c.companyPhone,c.companyEmail);
				});//for end
				
			},"json");//get end
	
}//editCompanyProfile

function editCompanyProfile(companyId,companyName,companyAddress,companyPhone,companyEmail){
	$("#companyFormAction").val("Update");
	$("#companyFormPopupActionButton").val("Update");
	
	$("#companyId").val(companyId);
	$("#companyName").val(companyName);
	$("#companyName").attr("readonly","true");
	$("#companyAddress").val(companyAddress);
	$("#companyPhone").val(companyPhone);
	$("#companyEmail").val(companyEmail);
	$("#companyEmail").attr("readonly","true");
	$("#companyLogoPreview").attr("src","img/companies/"+companyPrefix+"/"+companyPrefix+".png");
	
	$("#registerButton").hide();
}
