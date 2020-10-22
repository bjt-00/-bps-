// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [],//["Direct", "Referral", "Social"],
    datasets: [{
      data: [],//[55, 30, 15],
      backgroundColor: [],//['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: [],//['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

//load data for chart
$(document).ready(function(){
	
	function addData(chart, label, data) {
	    chart.data.labels.push(label);
	    chart.data.datasets.forEach((dataset) => {
	        dataset.data.push(data);
	        var successColor="#17a673";
	        var backgroundColor = (data<5000?"red":(data<10000?"orange":successColor));
	        dataset.backgroundColor.push(backgroundColor);
	        dataset.hoverBackgroundColor.push('#e1e1e1');
	        
	        var descHtml = $("#myPieChartDesc").html();
	        descHtml +="<span class=\"mr-2\"><i class=\"fas fa-circle\" style=\"color:"+backgroundColor+"\" ></i> "+label+"</span>";
	        $("#myPieChartDesc").html(descHtml);
	    });
	    chart.update();
	}
	function removeData(chart) {
	    chart.data.labels.pop();
	    chart.data.datasets.forEach((dataset) => {
	        dataset.data.pop();
	    });
	    chart.update();
	}
	function getChartData(companyPrefix,reportType){
		     removeData(myPieChart);
			 var url = restServicesPath+"report.php";
				$.get(url,{"sid":sid,"search":reportType,"companyPrefix":companyPrefix},
				function(searchResult){
					$.each(searchResult,function(i,report){
						var summaryMonth = report.month; 
						addData(myPieChart,summaryMonth,report.totalSaleAmount);
					});
				},"json");
	};
	getChartData(companyPrefix,"annualSummaryByMonth");
});
