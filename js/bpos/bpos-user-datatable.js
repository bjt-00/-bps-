// Call the dataTables jQuery plugin
$(document).ready(function() {
	var viewMode = $("#viewMode").val();
	
	var userTable = $('#userTable').DataTable( {
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
	            var selectedRow = userTable.row(this).data();
	            //$('#status').html('>>> '+selectedRow[1]);
	            for(var i=0;i<selectedRow.length;i++){
	            	//$('#status').html($('#status').html()+'>>>- '+selectedRow[i]);
	            	//$('#field'+i).val(selectedRow[i]);
	            	infoAlert(">>"+selectedRow[i]);
	            }
	            
	            //edit
	        }
	    } );
	
	 function prepareProductView(userId,firstName,lastName,role,userPhone,userEmail,storeId,storeName,status,emptySlotId){
		   // $('#recieptTable').DataTable().search( userName ).draw();
					//setProductDetails(,,,product.userEmail,discount,product.userEmail,product.role);
		 var url = restHost+"/view/contents/user/userView.php";
		$.get(url,{"sid":sid,"userId":userId,"firstName":firstName,"lastName":lastName,"role":role,"userPhone":userPhone,"storeId":storeId,"storeName":storeName,"userEmail":userEmail,"status":status,"viewMode":viewMode},
			function(searchResult){
			 $(emptySlotId).html(searchResult);
			});//get end
		}//getProductView end
	
	function getSearchContent(searchResult,i) {
		var searchContent='';
		if(i<searchResult.length){var p1 = searchResult[i];searchContent +=p1.userName+","+p1.userId+",";}
		//append send item for search
		if(i+1<searchResult.length){var p2 = searchResult[i+1];searchContent +=p2.userName+","+p2.userId+",";}
		//append third item for search
		if(i+2<searchResult.length){var p3 = searchResult[i+2];searchContent +=p3.userName+","+p3.userId;}
		return searchContent;
	}
	
	function loadUsers(){
	   // $('#recieptTable').DataTable().search( userName ).draw();
		
				//setProductDetails(,,,product.userEmail,discount,product.userEmail,product.role);
	 var url = restServicesPath+"user.php";
	 var colIndex=1;
	 var emptySlotId;
	 var rowIndex=0;
	$.get(url,{"sid":sid,"search":"*","companyPrefix":companyPrefix},
		function(searchResult){
			$.each(searchResult,function(i,u){
				var userName = u.firstName+" "+u.lastName;
				 //var newRow = [u.userId,u.firstName,u.lastName,u.role,u.storeName,3,2,1];
				var rowContent ="<div class='row'>"
	                 +"<div id='user1-"+u.userId+"' class='col-lg-4'></div>"
	                 +"<div id='user2-"+u.userId+"' class='col-lg-4 card'></div>"
	                 +"<div id='user3-"+u.userId+"' class='col-lg-4 card'></div>"
	                 +'</div>';
				
				
				if(colIndex==1){
					var searchContent = getSearchContent(searchResult,i);
					var newRow = [searchContent,rowContent];
					userTable.row.add(newRow).draw( false );
					prepareProductView(u.userId,u.firstName,u.lastName,u.role,u.phone,u.email,u.storeId,u.storeName,u.status,'#user1-'+u.userId);
					emptySlotId = u.userId;
					colIndex = colIndex+1;
				}else if(colIndex==2){
					prepareProductView(u.userId,u.firstName,u.lastName,u.role,u.phone,u.email,u.storeId,u.storeName,u.status,'#user2-'+emptySlotId);
					colIndex=colIndex+1;
				}else if(colIndex==3){
					prepareProductView(u.userId,u.firstName,u.lastName,u.role,u.phone,u.email,u.storeId,u.storeName,u.status,'#user3-'+emptySlotId);
					colIndex=1;
				}
				
				searchContent = $("#search-"+emptySlotId).html();
				searchContent +=userName+",";
				$("#search-"+emptySlotId).html(searchContent);
				
			});//for end

			//hide last empty slot
			if(colIndex==2 || colIndex==3 ){
			$(emptySlotId).hide();
			}
		},"json");//get end
	}//loadUsers end
	
	//for print label CSR will add products manually
	 loadUsers();
		
} );