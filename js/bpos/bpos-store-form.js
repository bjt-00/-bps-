$(document).ready(function(){
	
	$("#storeFormPopupActionButton").click(function(){
		
		var restUrl = restServicesPath+"store.php";
				
		$.ajax({
	        type: 'POST',
	        url:restUrl,
	        data: new FormData($("#storeForm")[0]),
	        processData: false, 
	        contentType: false, 
	        success: function(returnval) {
	             successAlert(returnval);
	             $("#storeFormModal").modal("hide");
            	 setTimeout(location.reload(),9000);
	             
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

function editStore(storeId,storeName,storePhone,storeAddress){
	$("#storeFormAction").val("Update");
	$("#storeFormPopupActionButton").val("Update");
	
	$("#storeId").val(storeId);
	$("#storeId").attr("readonly","true");
	$("#storeName").val(storeName);
	$("#storePhone").val(storePhone);
	$("#storeFormStoreId").val(storeId);
	$("#storeAddress").val(storeAddress);
}

function lockStore(companyId,storeId,storeName){
	var restUrl = restServicesPath+"store.php";
			
	$.ajax({
        type: 'POST',
        url:restUrl,
        data: {"sid":sid,"companyId":companyId,"companyPrefix":companyPrefix,"storeId":storeId,"action":"lock"},
        success: function(returnval) {
        	errorAlert(storeName+" locked Successfully.");
        	$("#store-"+storeId+"-icon").attr("class","fas fa-unlock");
        	$("#store-"+storeId+"-button").attr("onclick","unlockStore('"+companyId+"','"+storeId+"','"+storeName+"')");
        	$("#store-"+storeId+"-button").attr("class","editButton btn btn-danger btn-circle btn-sm");
        	$("#store-"+storeId+"-button").attr("title","Unlock "+storeId);
        	$("#store-"+storeId+"-edit").attr("class","editButton btn btn-danger btn-circle btn-sm");
         }
    });//end post call
	
}//lockAccount

function unlockStore(companyId,storeId,storeName){
	var restUrl = restServicesPath+"store.php";
			
	$.ajax({
        type: 'POST',
        url:restUrl,
        data: {"sid":sid,"companyId":companyId,"companyPrefix":companyPrefix,"storeId":storeId,"action":"unlock"},
        success: function(returnval) {
        	successAlert(storeName+" unlocked Successfully.");
        	$("#store-"+storeId+"-icon").attr("class","fas fa-lock");
        	$("#store-"+storeId+"-button").attr("onclick","lockStore('"+companyId+"','"+storeId+"','"+storeName+"')");
        	$("#store-"+storeId+"-button").attr("class","editButton btn btn-success btn-circle btn-sm");
        	$("#store-"+storeId+"-button").attr("title","lock "+storeId);
        	$("#store-"+storeId+"-edit").attr("class","editButton btn btn-success btn-circle btn-sm");
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
