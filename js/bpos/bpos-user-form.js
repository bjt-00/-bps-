$(document).ready(function(){
	
	$("#userFormPopupActionButton").click(function(){
		
		var restUrl = restServicesPath+"user.php";
				
		$.ajax({
	        type: 'POST',
	        url:restUrl,
	        data: new FormData($("#userForm")[0]),
	        processData: false, 
	        contentType: false, 
	        success: function(returnval) {
	             successAlert(returnval);
	             $("#userFormModal").modal("hide");
	             
	             var requestType= $("#requestType").val();
	             if(requestType=='activate'){
	            	 window.location="login.php";
	             }else{
	            	 setTimeout(location.reload(),9000);
	             }
	             
	         }
	    });//end post call
		
	});//end saveProduct click
	
	
	//Image Preview
	$("#userImage").change(function(){
		
		var file = $("input[type=file]").get(0).files[0];
		 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#userImagePreview").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
	});
	
	
});

function editUser(loginId,firstName,lastName,role,storeId,email,status,phone){
	$("#userFormAction").val("Update");
	$("#userFormPopupActionButton").val("Update");
	
	$("#loginId").val(loginId);
	$("#loginId").attr("readonly","true");
	$("#firstName").val(firstName);
	$("#lastName").val(lastName);
	$("#role").val(role);
	$("#userFormStoreId").val(storeId);
	$("#email").val(email);
	$("#phone").val(phone);
	$("#password").val("");
	$("#userImagePreview").attr("src","img/companies/"+companyPrefix+"/users/"+loginId+".png");
}

function lockAccount(loginId){
	var restUrl = restServicesPath+"user.php";
			
	$.ajax({
        type: 'POST',
        url:restUrl,
        data: {"sid":sid,"loginId":loginId,"companyPrefix":companyPrefix,"action":"lock"},
        success: function(returnval) {
        	errorAlert(loginId+" locked Successfully.");
        	$("#"+loginId+"-icon").attr("class","fas fa-unlock");
        	$("#"+loginId+"-button").attr("onclick","unlockAccount('"+loginId+"')");
        	$("#"+loginId+"-button").attr("class","editButton btn btn-danger btn-circle btn-sm");
        	$("#"+loginId+"-button").attr("title","Unlock "+loginId);
        	$("#"+loginId+"-edit").attr("class","editButton btn btn-danger btn-circle btn-sm");
         }
    });//end post call
	
}//lockAccount

function unlockAccount(loginId){
	var restUrl = restServicesPath+"user.php";
			
	$.ajax({
        type: 'POST',
        url:restUrl,
        data: {"sid":sid,"loginId":loginId,"companyPrefix":companyPrefix,"action":"unlock"},
        success: function(returnval) {
        	successAlert(loginId+" unlocked Successfully.");
        	$("#"+loginId+"-icon").attr("class","fas fa-lock");
        	$("#"+loginId+"-button").attr("onclick","lockAccount('"+loginId+"')");
        	$("#"+loginId+"-button").attr("class","editButton btn btn-success btn-circle btn-sm");
        	$("#"+loginId+"-button").attr("title","lock "+loginId);
        	$("#"+loginId+"-edit").attr("class","editButton btn btn-success btn-circle btn-sm");
         }
    });//end post call
	
}//unlockAccount

function editProfile(loginId){
	var restUrl = restServicesPath+"user.php";
	$("#role").hide();
	$("#userFormStoreId").hide();
	$.get(restUrl,{"sid":sid,"search":loginId,"companyPrefix":companyPrefix},
			function(users){
				$.each(users,function(i,u){
		        	editUser(loginId,u.firstName,u.lastName,u.role,u.storeId,u.email,u.status,u.phone);
				});//for end
				
			},"json");//get end
	$("#role").show();
	$("#userFormStoreId").show();
}//unlockAccount
