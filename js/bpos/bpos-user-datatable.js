// Call the dataTables jQuery plugin
var addToLabelsTable;
$(document).ready(function() {
	var viewMode = $("#viewMode2").val();
	var userTable = $('#userTable').DataTable( {
		"language": {
            "lengthMenu": "Show _MENU_",
            "zeroRecords": "--Empty Users List--",
             "info": "Page: _PAGE_/_PAGES_ ,Total Users: _MAX_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Total of _MAX_ Records)",
             "search":"Search"
		},"columnDefs": [
            {
                "targets": [ 0 ],
                "visible": true,
                "searchable": true
            }
        ],
        //"scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         true,
        "info":true,
        "searching":true,
        "ordering":true
        //dom: "Bfrtip",
        //buttons: ['copy','excel','print','csv', 'pdf']
    } );
	
	 $('#userTable tbody').on( 'clickX', 'tr', function () {
	    	
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	            $('#selectedCauseId').val(-1);
	            $('#delete').hide();//.attr("style","display:none");
	            $('#modalTitle').html("");
	        }
	        else {
	            userTable.$('tr.selected').removeClass('selected');
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
	
	function loadUsers(){
	   // $('#recieptTable').DataTable().search( productName ).draw();
		
				//setProductDetails(,,,product.totalInStock,discount,product.totalInStock,product.size);
	 var url = restServicesPath+"user.php";
	 var colIndex=1;
	 var emptySlotId;
	 var rowIndex=0;
	$.get(url,{"sid":sid,"search":"*","companyPrefix":companyPrefix},
		function(searchResult){
			$.each(searchResult,function(i,u){
					
				var csvUserParams="'"+u.userId+"','"+u.firstName+"','"+u.lastName+"','"+u.role+"','"+u.storeId+"','"+u.email+"',"+u.status+","+u.phone;
    
                var userProfilePhoto = "img/companies/"+companyPrefix+"/users/"+u.userId+".png";
                userProfilePhoto ="<img class=\"rounded-circle\" src=\""+userProfilePhoto+"\" alt=\"\" style=\"width:25px;height:25px\">";
 
                var editButton ="<a id=\""+u.userId+"-edit\" title=\"Edit\" href=\"#\" onclick=\"editUser("+csvUserParams+")\" class=\"editUser btn btn-"+(u.status==1?"success":"danger")+" btn-circle btn-sm\" data-toggle=\"modal\" data-target=\"#userFormModal\">"
                //+"<i class=\"fas fa-pen\"></i>"
                +userProfilePhoto
                +"</a>";

                var lockButton ="<a id=\""+u.userId+"-button\" title=\""+(u.status==1?"Lock":"Unlock")+" "+u.userId+"\" href=\"#\" onclick=\""+(u.status==1?"lockAccount":"unlockAccount")+"('"+u.userId+"')\" class=\"editUser btn btn-"+(u.status==1?"success":"danger")+" btn-circle btn-sm\" >"
                +"<i id=\""+u.userId+"-icon\" class=\"fas fa-"+(u.status==1?"lock":"unlock")+"\"></i>"
                 +"</a>";

				var newRow = [u.userId,u.firstName,u.lastName,u.role,u.storeName,u.email,u.phone,editButton+lockButton];//,p.size,p.purchasePrice,p.salePrice,p.totalInStock,p.totalSold];
				userTable.row.add(newRow).draw( false );
				
			});//for end

			
		},"json");//get end
	}//loadProducts end
	
	var rowIndex=0;
	addToLabels = function(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold){
		rowIndex++;
		//errorAlert("addToLabels click function rowIndex:"+rowIndex+", productId:"+productId+" totalSold:"+totalSold+" totalInStock:"+totalInStock);
		
		var emptySlotId1="label"+rowIndex+"1-"+productId;
		var emptySlotId2="label"+rowIndex+"2-"+productId;
		var emptySlotId3="label"+rowIndex+"3-"+productId;
		var emptySlotId4="label"+rowIndex+"4-"+productId;
		
		var rowContent ="<div class='row'>"
            +"<div id='"+emptySlotId1+"' class='col-lg-3'></div>"
            +"<div id='"+emptySlotId2+"' class='col-lg-3 card'></div>"
            +"<div id='"+emptySlotId3+"' class='col-lg-3 card'></div>"
            +"<div id='"+emptySlotId4+"' class='col-lg-3 card'></div>"
            +'</div>';
		var newRow = [productId,rowContent];
		productTable.row.add(newRow).draw( false );
		
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId1);
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId2);
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId3);
		prepareProductView(productId,productName,size,purchasePrice,salePrice,totalInStock,totalSold,emptySlotId4);
	}//addToLabelsTable end
	
	//for print label CSR will add products manually
	 loadUsers();
		
} );
