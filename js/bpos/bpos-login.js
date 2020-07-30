// Call the dataTables jQuery plugin
$(document).ready(function() {

	function getCompanies(){
		
		 var url = restServicesPath+"company.php";
			$.get(url,{"sid":sid},
			function(searchResult){
				$.each(searchResult,function(i,company){
					var option = "<option value='"+company.companyPrefix+"'>"+company.companyName+"</option>";
					$("#companyPrefix").empty().append(option);
				});

			},"json");
	};
	getCompanies();	
} );