// Call the dataTables jQuery plugin
$(document).ready(function() {

	function getCompanies(){
		
		 var url = restServicesPath+"company.php";
			$.get(url,{"sid":sid},
			function(searchResult){
				$("#companyPrefix").empty();
				$.each(searchResult,function(i,company){
					var option = "<option value='"+company.companyPrefix+"'>"+company.companyName+"</option>";
					$("#companyPrefix").append(option);
				});

			},"json");
	};
	getCompanies();	
} );