// Call the dataTables jQuery plugin
var addToLabelsTable;
$(document).ready(function() {
	var viewMode = $("#viewMode2").val();
	var productTable = $('#productTable2').DataTable( {
		"language": {
            "lengthMenu": "Show _MENU_",
            "zeroRecords": "--Empty Labels List--",
             "info": "Page: _PAGE_/_PAGES_ ,Total Labels: _MAX_",
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
        "paging":         false,
        "info":true,
        "searching":false,
        "ordering":true,
      //dom: "Bfrtip",
        buttons: ['copy','excel','print','csv', 'pdf']
    } );
	
	 $('#productTable tbody').on( 'clickX', 'tr', function () {
	    	
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	            $('#selectedCauseId').val(-1);
	            $('#delete').hide();//.attr("style","display:none");
	            $('#modalTitle').html("");
	        }
	        else {
	            productTable.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	            $('#selectedCauseId').val(this.id);
	            
	            var selectedCauseTitle =  $('#'+this.id+'Title').html();
	            $('#selectedCauseTitle').val(selectedCauseTitle);
	            
	            //delete
	            //$('#delete').attr("style","display:");
	            //$('#delete').show();
	            //$('#modalTitle').html("Do you really want to delete "+this.id);
	            
	            
	            //$('#edit').show();
	            var selectedRow = productTable.row(this).data();
	            //$('#status').html('>>> '+selectedRow[1]);
	            for(var i=0;i<selectedRow.length;i++){
	            	//$('#status').html($('#status').html()+'>>>- '+selectedRow[i]);
	            	//$('#field'+i).val(selectedRow[i]);
	            	//infoAlert(">>"+selectedRow[i]);
	            }
	            
	            //edit
	        }
	    } );
	
	 function prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId){
		   // $('#recieptTable').DataTable().search( productName ).draw();
			
					//setProductDetails(,,,product.totalInStock,discount,product.totalInStock,product.size);
		 var url = restHost+"/view/contents/product/productView.php";
		$.get(url,{"sid":sid,"productId":productId,"productName":productName,"size":size,"purchasePrice":purchasePrice,"salePrice":salePrice,"totalInStock":totalInStock,"totalSold":totalSold,"viewMode":viewMode,"emptySlotId":emptySlotId},
			function(searchResult){
			 $("#"+emptySlotId).html(searchResult);
			});//get end
		}//getProductView end
	
	function getSearchContent(searchResult,i) {
		var searchContent='';
		if(i<searchResult.length){var p1 = searchResult[i];searchContent +=p1.productName+","+p1.productId+",";}
		//append send item for search
		if(i+1<searchResult.length){var p2 = searchResult[i+1];searchContent +=p2.productName+","+p2.productId+",";}
		//append third item for search
		if(i+2<searchResult.length){var p3 = searchResult[i+2];searchContent +=p3.productName+","+p3.productId;}
		return searchContent;
	}
	
	function loadProducts(){
	   // $('#recieptTable').DataTable().search( productName ).draw();
		
				//setProductDetails(,,,product.totalInStock,discount,product.totalInStock,product.size);
	 var url = restApiPath+"product.php";
	 var colIndex=1;
	 var emptySlotId;
	 var rowIndex=0;
	$.get(url,{"sid":sid,"search":"*","companyPrefix":companyPrefix},
		function(searchResult){
			$.each(searchResult,function(i,p){
					
				 //var newRow = [p.productId,p.productName,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold];
				var rowContent ="<div class='row'>"
	                 +"<div id='prod1-"+p.productId+"' class='col-lg-4'></div>"
	                 +"<div id='prod2-"+p.productId+"' class='col-lg-4 card'></div>"
	                 +"<div id='prod3-"+p.productId+"' class='col-lg-4 card'></div>"
	                 +'</div>';
				
				
				if(colIndex==1){
					var searchContent = getSearchContent(searchResult,i);
					var newRow = [searchContent,rowContent];
					productTable.row.add(newRow).draw( false );
					prepareProductView(p.productId,p.productName,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold,'prod1-'+p.productId);
					emptySlotId = p.productId;
					colIndex = colIndex+1;
				}else if(colIndex==2){
					prepareProductView(p.productId,p.productName,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold,'prod2-'+emptySlotId);
					colIndex=colIndex+1;
				}else if(colIndex==3){
					prepareProductView(p.productId,p.productName,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold,'prod3-'+emptySlotId);
					colIndex=1;
				}
				
				searchContent = $("#search-"+emptySlotId).html();
				searchContent +=p.productName+",";
				$("#search-"+emptySlotId).html(searchContent);
				
			});//for end

			//hide last empty slot
			if(colIndex==2 || colIndex==3 ){
			$(emptySlotId).hide();
			}
		},"json");//get end
	}//loadProducts end
	
	var rowIndex=0;
	addToLabels = function(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold){
		rowIndex++;
		//errorAlert("addToLabels click function rowIndex:"+rowIndex+", productId:"+productId+" totalSold:"+totalSold+" totalInStock:"+totalInStock);
		
		var emptySlotId1="label"+rowIndex+"1-"+productId;
		var emptySlotId2="label"+rowIndex+"2-"+productId;
		var emptySlotId3="label"+rowIndex+"3-"+productId;
		
		var rowContent ="<div class='row'>"
            +"<div id='"+emptySlotId1+"' class='col-lg-4'></div>"
            +"<div id='"+emptySlotId2+"' class='col-lg-4 card'></div>"
            +"<div id='"+emptySlotId3+"' class='col-lg-4 card'></div>"
            +'</div>';
		var newRow = [productId,rowContent];
		productTable.row.add(newRow).draw( false );
		
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId1);
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId2);
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId3);
	}//addToLabelsTable end
	
	//for print label CSR will add products manually
	if(viewMode!='printlabel'){
	 loadProducts();
	}
		
} );
