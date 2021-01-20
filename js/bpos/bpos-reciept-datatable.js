// Call the dataTables jQuery plugin
var recieptTable;
var balance=0;
var totalAmount=0;
var tax=0;
var entries=0;
var isReturnMode=false;
$(document).ready(function() {

	recieptTable = $('#recieptTable').DataTable( {
		"language": {
            "lengthMenu": "Show _MENU_",
            "zeroRecords": "--Empty Reciept--",
             "info": "Page: _PAGE_/_PAGES_ ,Total Records: _MAX_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Total of _MAX_ Records)",
             "search":"Search"
		},
        //"scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false,
        "info":false,
        "searching":false,
        "ordering":false
    } );
	
	 var selectedRow;
	 $('#recieptTable tbody').on( 'click', 'tr', function () {
	    	
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	            $('#selectedCauseId').val(-1);
	            $('#delete').hide();//.attr("style","display:none");
	            $('#modalTitle').html("");
	        }
	        else {
	        	recieptTable.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	            $('#selectedCauseId').val(this.id);
	            
	            var selectedCauseTitle =  $('#'+this.id+'Title').html();
	            $('#selectedCauseTitle').val(selectedCauseTitle);
	            
	            //delete
	            //$('#delete').attr("style","display:");
	            $('#deleteRecieptItem').show();
	            //$('#modalTitle').html("Do you really want to delete "+this.id);
	            
	            
	            //$('#edit').show();
	            selectedRow = recieptTable.row(this).data();
	            //$('#status').html('>>> '+selectedRow[2]);
	            infoAlert(">>"+selectedRow[0]);
	            for(var i=0;i<selectedRow.length;i++){
	            	//$('#status').html($('#status').html()+'>>>- '+selectedRow[i]);
	            	//$('#field'+i).val(selectedRow[i]);
	            	//infoAlert(">>"+selectedRow[i]);
	            }
	            
	            //edit
	        }
	    } );
	
	//addproduct
	$("#addProduct").click(function(){
		addProductIntoReciept($('#productId').val(),
				$('#productName').html());
	});//addproduct
	
	//var recieptDetails = {"entries":0,"tax":0,"totalAmount":0,"cashRecieved":0,"balance":0,"customerId":"Guest","recieptProducts":[]};
	function addProductIntoReciept(productId,productName){
		//var productName=$("#productName").html();
		if(productName==""){return;}
		
		var productSize=$("#productSize").val();
		var discount = $("#productDiscount").val();
		
		var returnedProductId = $("#returnedProductId").val();
		if(discount>0){
		productName=productName+" [-"+productSize+(discount>0?discount:"")+"]";
		}
		
		
		var productQuantity=$("#productQuantity").val();
		var productPrice=$("#productPrice").html();
		var totalPrice=productQuantity*productPrice
		
		if(isReturnMode && (productPrice<0)){
			productName="<span style='color:red;' title='Previous Returned Item'>"+productName+"</span>";
		}
		//discount= (totalPrice/100)*discount;
		totalPrice = totalPrice-discount;
		var totalPrice=(isReturnMode && (productId==returnedProductId) && ((productPrice+0)>0)?-totalPrice:totalPrice);
		
		totalAmount +=(totalPrice>0?totalPrice:0);
		entries=entries+1;
	    
		var newRow = [entries+": "+productName,productQuantity,totalPrice];
		var newProduct = {"productId":productId,"productName":productName,"productQuantity":productQuantity,"totalPrice":totalPrice};
		recieptDetails.recieptProducts.push(newProduct);
		
		recieptTable.row.add(newRow).draw( false );
	   // $('#recieptTable').DataTable().search( productName ).draw();
	    
		
	    //tax=totalAmount*0.01;
	    tax=0;
	    
	    recieptDetails.totalAmount=(totalAmount+tax);
	    $("#totalAmount").html(recieptDetails.totalAmount);
	    
	    recieptDetails.entries=entries;
	    $("#entries").html(recieptDetails.entries);
	    
	    recieptDetails.tax=tax.toFixed(2);
	    $('#tax').html(recieptDetails.tax);
	    
	    $('#submitReciept').show();
	    $('#cancelReciept').show();
	    
	    updateBalance();
	    //infoAlert(productName+" added into reciept.")
	}
	
	//Recieve Cash
	function updateBalance(){
		
		var cashRecieved = $("#cashRecieved").val();
		recieptDetails.cashRecieved=cashRecieved;
		
	    balance = cashRecieved-(totalAmount+tax);
	    recieptDetails.balance=balance.toFixed(2);
	    $('#balance').html(recieptDetails.balance);
	    
	    
	}
	
	$("#cashRecieved").change(function(){
		updateBalance();
	});//addproduct
	
	function setProductDetails(productId,productName,productPrice,productQuantity,productDiscount,productQuantity,productSize){
		$('#productId').val(productId);
		$('#productName').html(productName);
		$('#productPrice').html(productPrice);
		$('#priceTag').html(productPrice);
		$('#productQuantity').attr("max",productQuantity);
		//$('#productQuantity').val(1);
		$('#minQuantity').html($('#productQuantity').attr("min"));
	    $('#maxQuantity').html(productQuantity);
		
		$('#quantity').html(" - 1");
	    $('#productDiscount').attr("max",productDiscount);
	    $('#productDiscount').val(0);
	    $('#minDiscount').html($('#productDiscount').attr("min"));
	    $('#maxDiscount').html(productDiscount);
	    $('#discount').html(" - 0");
	    $('#productQuantity').attr("max",productQuantity);
	    $('#productSize').html(productSize);
	    var productImage =productImagesPath+productId+".png";
	    
	    //out of stock
	    if(productQuantity<=0){
	    	//productImage =productImagesPath+"-1"+".jpg";
	    	$('#productQuantity').attr("disabled","disabled");
	    	$('#productDiscount').attr("disabled","disabled");
	    	$('#autoAddMode').attr("disabled","disabled");
	    	
	    	$('#priceTag').html("Out of stock");
	    }else{
	    	$('#productQuantity').removeAttr("disabled");
	    	$('#productDiscount').removeAttr("disabled");
	    	$('#autoAddMode').removeAttr("disabled");
	    	$('#productStatus').html("");
	    	$('#productStatus').hide();
	    }
	    
		 $("#productImage").attr("src",productImage);
	}
	
	$("#searchProduct").change(function(){
		var searchText = $(this).val();
		setProductDetails(0,"","","",0,"","");
		 var returnedProductId = $("#returnedProductId").val();
		 var url = restApiPath+"product.php";
			$.get(url,{"sid":sid,"search":searchText,"companyPrefix":companyPrefix,"returnedProductId":returnedProductId},
			function(searchResult){
				$.each(searchResult,function(i,product){
					
					var discount= (product.salePrice-product.purchasePrice);
					 
					var totalPrice=product.salePrice;
					totalPrice = (isReturnMode && ((product.productId==returnedProductId) && totalPrice>0)?-totalPrice:totalPrice);
					var quantity = (isReturnMode?$("#productQuantity").val():1);
					//sit product details
					setProductDetails(product.productId,product.productName,totalPrice,product.totalInStock,discount
							,product.totalInStock,product.size);
					 
					$("#productQuantity").val(quantity);
					
					//add product into reciept
					var isAutoMode=$("#autoAddMode").prop("checked");
					if(isAutoMode && product.totalInStock>0){
						addProductIntoReciept(product.productId,product.productName);
					}


				});
				
				    //No match found
				    if(searchResult.length==0){
				    	setProductDetails(-1,"","","",0,"","");
				    }

			},"json");
			
		$(this).val("");
		$(this).focus();
		

	});
	
	   //delete selected row
    $('#deleteRecieptItem').click( function () {
    	//var selectedCaseId = $('#selectedCaseId').val();
    	//var selectedCaseTitle = $('#selectedCaseTitle').val();
   		totalAmount -= selectedRow[2];
   		
    	$("#totalAmount").html(totalAmount);
    	
    	if(isReturnMode){
    		recieptDetails.totalAmount -=selectedRow[2];
    		recieptDetails.entries -=selectedRow[1];  
    		var selectedRowIndex = recieptTable.row('.selected').index();
    		recieptDetails.recieptProducts.splice(selectedRowIndex,1);
    		
    	}

    	entries -= 1;
    	$("#entries").html(entries);

    	warningAlert("Selected Item '"+selectedRow[0]+"' Deleted Successfully ");
    	
    	//var url = restHost+"/case/index.php?s=case";
    	//$.post(url,{causeId:selectedCaseId,title:selectedCaseTitle,action:'delete'}).done(
    	//function(data){
    	//	$('#status').html('Data Loaded '+data.causeId);
    	//});
    	
    	//call delete services
        recieptTable.row('.selected').remove().draw( false );
        $('#deleteRecieptItem').hide();
        //$('#edit').hide();
        updateBalance();
    } );

		
} );