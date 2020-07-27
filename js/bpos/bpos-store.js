// Call the dataTables jQuery plugin
$(document).ready(function() {

	function getStore(storeId,companyPrefix){
		
		 var url = restServicesPath+"store.php";
			$.get(url,{"sid":sid,"search":storeId,"companyPrefix":companyPrefix},
			function(searchResult){
				$.each(searchResult,function(i,store){
					$("#storeId").html(store.store_id);
					$("#storeAddress").html(store.store_address);

				});

			},"json");
	};
	getStore(storeId,companyPrefix);	
} );