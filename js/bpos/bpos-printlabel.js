
// Call the dataTables jQuery plugin
$(document).ready(function() {

	$("#printLabels").click(function(){
		$("#accordionSidebar").hide();
		$("#pageHader").hide();
		$("th").hide();
		//$("td").attr("style","border:1px solid red;width:100%");
		$(".smallBox").attr("style","border:1px dotted red;width:275px");
		$("footer").hide();
		/*
		//prepare reciept for print
		var recieptWidth = "width:275px;color:black;font-weight:bold;margin-left:2px;";
		var recieptWidth2 = recieptWidth+"font-size:16px;";
		recieptWidth = recieptWidth+"font-size:18px;";
		
		$("#recieptHeader").attr("style",recieptWidth2);
		$("#recieptAddress").attr("style",recieptWidth2);
		$("#recieptPhone").attr("style",recieptWidth2);
		$("#recieptWeb").attr("style",recieptWidth2);
		$("#recieptHeader3").attr("style",recieptWidth);
		$("#recieptBarCode").attr("style",recieptWidth);
		$("#recieptTable").attr("style",recieptWidth);
		$("#recieptSummary").attr("style",recieptWidth);
		
		$("#cashRecievedPreview").attr("style","color:black;font-weight:bold;");
		$("#cashRecieved").hide();
		$("#cashRecievedPreview").html($("#cashRecieved").val());
		*/
		window.print();
		//location.reload();
	});
		
} );

function addToLabels(productId){
	//$("#productListModal").modal("hide");
	//$("#searchProduct").val(productId);
	//$("#searchProduct").change();
	successAlert(productId);
	addToLabelsTable(productId);
}