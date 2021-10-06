// Call the dataTables jQuery plugin
$(document).ready(function() {
	var viewMode = $("#viewMode").val();
	
	var billingTable = $('#billingTable').DataTable( {
		"language": {
            "lengthMenu": "Show _MENU_",
            "zeroRecords": "--Empty Product List--",
             "info": "Page: _PAGE_/_PAGES_ ,Total Records: _MAX_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Total of _MAX_ Records)",
             "search":"Search"
		},"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": true
            }
        ],
        //"scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         true,
        "info":true,
        "searching":true,
        "ordering":true,
        "bSort" : true
        //dom: 'Bfrtip',
        //buttons:['print']
    } );
	 

	 $('#billingTable tbody').on( 'clickX', 'tr', function () {
	    	
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	            $('#selectedCauseId').val(-1);
	            $('#delete').hide();//.attr("style","display:none");
	            $('#modalTitle').html("");
	        }
	        else {
	            billingTable.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	            $('#selectedCauseId').val(this.id);
	            
	            var selectedCauseTitle =  $('#'+this.id+'Title').html();
	            $('#selectedCauseTitle').val(selectedCauseTitle);
	            
	            //delete
	            //$('#delete').attr("style","display:");
	            //$('#delete').show();
	            //$('#modalTitle').html("Do you really want to delete "+this.id);
	            
	            
	            //$('#edit').show();
	            var selectedRow = billingTable.row(this).data();
	            //$('#status').html('>>> '+selectedRow[1]);
	            for(var i=0;i<selectedRow.length;i++){
	            	//$('#status').html($('#status').html()+'>>>- '+selectedRow[i]);
	            	//$('#field'+i).val(selectedRow[i]);
	            	infoAlert(">>"+selectedRow[i]);
	            }
	            
	            //edit
	        }
	    } );
	
	 function prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId){
		   // $('#recieptTable').DataTable().search( productName ).draw();
			
					//setProductDetails(,,,product.totalInStock,discount,product.totalInStock,product.size);
		 var url = restHost+"/view/contents/product/productView.php";
		$.get(url,{"sid":sid,"productId":productId,"productName":productName,"size":size,"purchasePrice":purchasePrice,"salePrice":salePrice,"totalInStock":totalInStock,"totalSold":totalSold,"viewMode":viewMode},
			function(searchResult){
			 $(emptySlotId).html(searchResult);
			});//get end
		}//getProductView end
	
	
	
	function loadBills(){
	 var url = restServicesPath+"billing.php";
	 var colIndex=1;
	 var emptySlotId;
	 var rowIndex=0;
	$.get(url,{"sid":sid,"search":"*","companyPrefix":companyPrefix},
		function(searchResult){
			$.each(searchResult,function(i,bill){
				
				var paymentIconType = (bill.paymentStatus==1?'fa-check-circle':'fa-paypal');
				var paymentIconColor=(bill.paymentStatus==1?'color:green':'color:red');
				var paymentTitle=(bill.paymentStatus==1?'Paid on:'+bill.paymentDate:'Due Date: '+bill.dueDate);
				var paymentUrl = getPaymentLink(companyPrefix,bill.billId,bill.totalBill);
				var paymentIcon = "<i style='"+paymentIconColor+"' class='fas "+paymentIconType+"' title='"+paymentTitle+"'></i>";
				var paymentLink = "<a href='"+paymentUrl+"' target='new'>Pay"+paymentIcon+"</a>";
				var newRow = [bill.billId,bill.billId,bill.totalBill+" "+bill.currency,(bill.paymentStatus==1?paymentIcon:paymentLink)];
				billingTable.row.add(newRow).draw( false );
				
			});//for end
			
		},"json");//get end
	}//loadProducts end
	
	//for print label CSR will add products manually
	 loadBills();
		
} );