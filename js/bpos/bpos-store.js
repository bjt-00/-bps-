// Call the dataTables jQuery plugin
$(document).ready(function() {

	function getStore(storeId,companyPrefix){
		
		 var url = restServicesPath+"store.php";
			$.get(url,{"sid":sid,"search":storeId,"companyPrefix":companyPrefix},
			function(searchResult){
				$.each(searchResult,function(i,store){
					$("#storeId").html(store.storeId);
					$("#storeAddress").html(store.storeAddress);
					$("#storePhone").html(store.storePhone);
				});

			},"json");
	};
	
	function loadStores(){
		
		 var url = restServicesPath+"store.php";
		 $.get(url,{"sid":sid,"search":"*","companyPrefix":companyPrefix},
			function(searchResult){
				$("#userFormStoreId").empty();
				$.each(searchResult,function(i,store){
					var option = "<option value='"+store.storeId+"'>"+store.storeName+"</option>";
					$("#userFormStoreId").append(option);
				});

			},"json");
	};
	getStore(storeId,companyPrefix);//for login form
	loadStores();//for userForm
} );