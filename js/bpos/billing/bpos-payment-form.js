// Call the dataTables jQuery plugin
$(document).ready(function() {

	function getBills(billType,companyPrefix){
		
		 var url = restServicesPath+"billing.php";
			$.get(url,{"sid":sid,"search":billType,"companyPrefix":companyPrefix},
			function(searchResult){
				$("#dueBills").empty();
				$.each(searchResult,function(i,bill){
					var option = "<option value='"+bill.billId+"' totalBill='"+bill.totalBill+"'>"+bill.billId+"</option>";
					$("#dueBills").append(option);
					$("#amountPaid").val(bill.totalBill);
					$("#billId").val(bill.billId);
				});
				if(searchResult.length==0){
					$("#bankdDepositDiv").html("");
				}
			},"json");
	};
	
	$("#dueBills").change(function(){
		var totalBill = $(this).find('option:selected').attr('totalBill');
		var billId = $(this).val();
		$("#amountPaid").val(totalBill);
		$("#billId").val(billId);
	});
	
	$("#paymentButton").click(function(){
		 var paymentTransactionId = $("#paymentTransactionId").val();
		 var paymentDate = $("#paymentDate").val();
		 if(paymentTransactionId=='' || paymentDate==''){
			 errorAlert('One of required field is empty');
			 return;
		 }
		 
		 var url = restServicesPath+"billing.php";
		 $.ajax({
		        type: 'POST',
		        url:url,
		        data: new FormData($("#paymentForm")[0]),
		        processData: false, 
		        contentType: false, 
		        success: function(returnval) {
		             successAlert(returnval);
		             setTimeout(location.reload(),9000);
		         }
		    });//end post call
	});
	getBills("dueBills",companyPrefix);	
} );