$(document).ready(function(){
	
	function getReportSummary(companyPrefix,reportType){
		
			 var url = restServicesPath+"report.php";
				$.get(url,{"sid":sid,"search":reportType,"companyPrefix":companyPrefix},
				function(searchResult){
					$.each(searchResult,function(i,report){
						$("#"+reportType).html(report.totalSaleAmount+" "+report.currency);
					});

				},"json");
	};
	getReportSummary(companyPrefix,"dailySummary");
	getReportSummary(companyPrefix,"monthlySummary");
	getReportSummary(companyPrefix,"annualSummary");
});