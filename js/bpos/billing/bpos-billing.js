$(document).ready(function(){
	
	function getBillSummary(companyPrefix,billType){
		
			 var url = restServicesPath+"billing.php";
				$.get(url,{"sid":sid,"search":billType,"companyPrefix":companyPrefix},
				function(searchResult){
					$.each(searchResult,function(i,bill){
						var paymentLink='';
						$("#"+billType).html(bill.totalBill+" "+bill.currency);
						$("#"+billType).attr("title",bill.feeUnit);
						if(bill.paymentStatus==1){
							var billDetailsLink=" <a href='billing.php?viewMode=view'>View Bill Details</a>";
						$("#"+billType+"Details").html(" Paid "+billDetailsLink);
						}else{
							paymentLink=" <a href='billing.php?viewMode=pay'>Pay Now</a>";
							$("#"+billType+"Details").html(bill.dueDate+paymentLink);
						}
						$("#billDueDate").html(bill.dueDate);
						
						if(bill.paymentStatus==0){
						var itemName=companyPrefix;
						var itemNumber=bill.billId;
						var amount = bill.totalBill;
						//paymentLink = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=DNB4QB9XHGYJ2&lc=AE&item_name='+itemName+'&item_number='+itemNumber+'&amount='+amount+'%2e00&currency_code=USD&button_subtype=services&no_note=1&no_shipping=1&rm=1&return=https%3a%2f%2fwww%2ebitguiders%2ecom%2ftraining%2ephp%3fpayment%3daccepted&cancel_return=https%3a%2f%2fwww%2ebitguiders%2ecom%2ftraining%2ephp%3fpayment%3dcanceled&bn=PP%2dBuyNowBF%3apayNow%2epng%3aNonHosted';
						paymentLink = getPaymentLink(itemName,itemNumber,amount);
						$("#payNow").attr("href",paymentLink);
						}else{
							$("#payNowLabel").html("Paid on: "+bill.paymentDate);
							$("#payNowLink").html("");
						}
					});

				},"json");
	};
	getBillSummary(companyPrefix,"billSummary");
});