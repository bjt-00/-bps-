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
	getStore(storeId,companyPrefix);	
} );