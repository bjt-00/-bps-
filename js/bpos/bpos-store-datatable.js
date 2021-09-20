// Call the dataTables jQuery plugin
$(document).ready(function() {
	var viewMode = $("#viewMode").val();
	
	var storeTable = $('#storeTable').DataTable( {
		"language": {
            "lengthMenu": "Show _MENU_",
            "zeroRecords": "--Empty Store List--",
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
	 

	 $('#storeTable tbody').on( 'clickX', 'tr', function () {
	    	
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	            $('#selectedCauseId').val(-1);
	            $('#delete').hide();//.attr("style","display:none");
	            $('#modalTitle').html("");
	        }
	        else {
	            storeTable.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	            $('#selectedCauseId').val(this.id);
	            
	            var selectedCauseTitle =  $('#'+this.id+'Title').html();
	            $('#selectedCauseTitle').val(selectedCauseTitle);
	            
	            //delete
	            //$('#delete').attr("style","display:");
	            //$('#delete').show();
	            //$('#modalTitle').html("Do you really want to delete "+this.id);
	            
	            
	            //$('#edit').show();
	            var selectedRow = storeTable.row(this).data();
	            //$('#status').html('>>> '+selectedRow[1]);
	            for(var i=0;i<selectedRow.length;i++){
	            	//$('#status').html($('#status').html()+'>>>- '+selectedRow[i]);
	            	//$('#field'+i).val(selectedRow[i]);
	            	infoAlert(">>"+selectedRow[i]);
	            }
	            
	            //edit
	        }
	    } );
	
	 function prepareStoreView(companyId,storeId,storeName,storeAddress,storePhone,managerName,managerPhone,managerEmail,status,tax,taxType,emptySlotId){
		   // $('#recieptTable').DataTable().search( userName ).draw();
					//setProductDetails(,,,product.userEmail,discount,product.userEmail,product.role);
		 var url = restHost+"/view/contents/store/storeView.php";
		$.get(url,{"sid":sid,"companyId":companyId,"storeId":storeId,"storeName":storeName,"storeAddress":storeAddress,"storePhone":storePhone,"managerName":managerName,"managerPhone":managerPhone,"managerEmail":managerEmail,"status":status,"viewMode":viewMode,"tax":tax,"taxType":taxType},
			function(searchResult){
			 $(emptySlotId).html(searchResult);
			});//get end
		}//getProductView end
	
	function getSearchContent(searchResult,i) {
		var searchContent='';
		if(i<searchResult.length){var p1 = searchResult[i];searchContent +=p1.userName+","+p1.storeId+",";}
		//append send item for search
		if(i+1<searchResult.length){var p2 = searchResult[i+1];searchContent +=p2.userName+","+p2.storeId+",";}
		//append third item for search
		if(i+2<searchResult.length){var p3 = searchResult[i+2];searchContent +=p3.userName+","+p3.storeId;}
		return searchContent;
	}
	
	function loadStores(){
	   // $('#recieptTable').DataTable().search( userName ).draw();
		
				//setProductDetails(,,,product.userEmail,discount,product.userEmail,product.role);
	 var url = restServicesPath+"store.php";
	 var colIndex=1;
	 var emptySlotId;
	 var rowIndex=0;
	$.get(url,{"sid":sid,"search":"*","companyPrefix":companyPrefix},
		function(searchResult){
			$.each(searchResult,function(i,s){
				 //var newRow = [s.storeId,s.storeName,s.storeAddress,s.storeAddress,u.storeName,3,2,1];
				var rowContent ="<div class='row'>"
	                 +"<div id='store1-"+s.storeId+"' class='col-lg-4'></div>"
	                 +"<div id='store2-"+s.storeId+"' class='col-lg-4 card'></div>"
	                 +"<div id='store3-"+s.storeId+"' class='col-lg-4 card'></div>"
	                 +'</div>';
				
				
				if(colIndex==1){
					var searchContent = getSearchContent(searchResult,i);
					var newRow = [searchContent,rowContent];
					storeTable.row.add(newRow).draw( false );
					prepareStoreView(s.companyId,s.storeId,s.storeName,s.storeAddress,s.storePhone,s.managerName,s.managerPhone,s.managerEmail,s.isActive,s.tax,s.taxType,'#store1-'+s.storeId);
					emptySlotId = s.storeId;
					colIndex = colIndex+1;
				}else if(colIndex==2){
					prepareStoreView(s.companyId,s.storeId,s.storeName,s.storeAddress,s.storePhone,s.managerName,s.managerPhone,s.managerEmail,s.isActive,s.tax,s.taxType,'#store2-'+emptySlotId);
					colIndex=colIndex+1;
				}else if(colIndex==3){
					prepareStoreView(s.companyId,s.storeId,s.storeName,s.storeAddress,s.storePhone,s.managerName,s.managerPhone,s.managerEmail,s.isActive,s.tax,s.taxType,'#store3-'+emptySlotId);
					colIndex=1;
				}
				
				searchContent = $("#search-"+emptySlotId).html();
				searchContent +=s.storeName+",";
				$("#search-"+emptySlotId).html(searchContent);
				
			});//for end

			//hide last empty slot
			if(colIndex==2 || colIndex==3 ){
			$(emptySlotId).hide();
			}
		},"json");//get end
	}//loadUsers end
	
	//for print label CSR will add products manually
	 loadStores();
		
} );