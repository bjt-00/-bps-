	var restHost="http://localhost/-bps-";
	//var restHost="http://www.bitguiders.com/bpos";

	var companyPrefix = $("#varCompanyPrefix").html();
	var sid = $("#varSid").html();
	var storeId = $("#varStoreId").html();
	
	var productImagesPath= "img/companies/"+companyPrefix+"/products/";
	var restApiPath=restHost+"/rest/api/";
	var restServicesPath=restHost+"/rest/services/";
	

$(document).ready(function() {


} );

   function getPaymentLink(itemName,itemNumber,amount){
		var paymentLink = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=DNB4QB9XHGYJ2&lc=AE&item_name='+itemName+'&item_number='+itemNumber+'&amount='+amount+'%2e00&currency_code=USD&button_subtype=services&no_note=1&no_shipping=1&rm=1&return=https%3a%2f%2fwww%2ebitguiders%2ecom%2ftraining%2ephp%3fpayment%3daccepted&cancel_return=https%3a%2f%2fwww%2ebitguiders%2ecom%2ftraining%2ephp%3fpayment%3dcanceled&bn=PP%2dBuyNowBF%3apayNow%2epng%3aNonHosted';
		return paymentLink;
   }