// Call the dataTables jQuery plugin
$(document).ready(function() {

	var productTable = $('#productTable').DataTable( {
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
        "ordering":true
    } );
	
	 $('#productTable tbody').on( 'click', 'tr', function () {
	    	
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
	            	infoAlert(">>"+selectedRow[i]);
	            }
	            
	            //edit
	        }
	    } );
	
	 function prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId){
		   // $('#dTable').DataTable().search( productName ).draw();
			
					//setProductDetails(,,,product.totalInStock,discount,product.totalInStock,product.size);
		 var viewMode = $("#viewMode").val();
		 var url = restHost+"/view/contents/product/productView.php";
		$.get(url,{"sid":sid,"productId":productId,"productName":productName,"size":size,"purchasePrice":purchasePrice,"salePrice":salePrice,"totalInStock":totalInStock,"totalSold":totalSold,"viewMode":viewMode},
			function(searchResult){
			 $(emptySlotId).html(searchResult);
			});//get end
		}//getProductView end
	
	function loadProducts(){
	   // $('#dTable').DataTable().search( productName ).draw();
		
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
	                 +"<div id='prod1-"+p.productId+"' class='col-lg-3 card border-left-primary shadow py-1'>--</div>"
	                 +"<div class='col-lg-1'>&nbsp;</div>"
	                 +"<div id='prod3-"+p.productId+"' class='col-lg-3 card border-left-success shadow py-1'>--</div>"
	                 +"<div class='col-lg-1'>&nbsp;</div>"
	                 +"<div id='prod2-"+p.productId+"' class='col-lg-3 card border-left-warning shadow py-1'>--</div>"
	                 +'</div>';
				rowContent ="<div class='row'>"
	                 +"<div id='prod1-"+p.productId+"' class='col-lg-4'></div>"
	                 //+"<div class='col-lg-1'>&nbsp;</div>"
	                 +"<div id='prod2-"+p.productId+"' class='col-lg-4 card'></div>"
	                 //+"<div class='col-lg-1'>&nbsp;</div>"
	                 +"<div id='prod3-"+p.productId+"' class='col-lg-4 card'></div>"
	                 +'</div>';
				var searchContent ="<div id='search-"+p.productId+"'></div>";
				if(colIndex==1){
					var newRow = [searchContent,rowContent];
					productTable.row.add(newRow).draw( false );
					prepareProductView(p.productId,p.productName,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold,'#prod1-'+p.productId);
					emptySlotId = p.productId;
					colIndex = colIndex+1;
				}else if(colIndex==2){
					prepareProductView(p.productId,p.productName+"-"+colIndex,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold,'#prod2-'+emptySlotId);
					colIndex=colIndex+1;
				}else if(colIndex==3){
					prepareProductView(p.productId,p.productName,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold,'#prod3-'+emptySlotId);
					colIndex=1;
				}
				
				searchContent = $("#search-"+emptySlotId).html();
				searchContent +=p.productName+",";
				$("#search-"+emptySlotId).html(searchContent);
				
			});//for end

			//hide last empty slot
			if(colIndex==2 || colIndex==3 ){$(emptySlotId).hide();}
		},"json");//get end
	}//loadProducts end
	
	loadProducts();
		
} );