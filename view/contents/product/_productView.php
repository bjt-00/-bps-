<?php

/* $totalInStock = "{{p.totalInStock}}";//(isset($_GET['totalInStock'])?$_GET['totalInStock']:'0');
$totalSold = "{{p.totalSold}}";//(isset($_GET['totalSold'])?$_GET['totalSold']:'0');

$percentSold = (($totalSold/($totalInStock+$totalSold))*100);
$percentSold = round($percentSold,0);

if($percentSold<25) $progressBarColor= 'bg-success';
if($percentSold>25 && $percentSold <50 ) $progressBarColor= 'bg-info';
if($percentSold>50 && $percentSold <75 ) $progressBarColor= 'bg-warning';
if($percentSold>75 ) $progressBarColor= 'bg-danger';
 */
$companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
?>
<table>
<tr>
<td rowspan="7" colspan="1" >
<div class="row">
<img id="productImage" alt="" class="pull-center" src="img/companies/<?php echo $companyPrefix;?>/products/{{p.productId}}.jpg" width="150" height="140"  >
</div>
<div class="row">
<input type="text" id="prodId" value="{{p.productId}}"/>
<div id="productBarCode"></div>
</div>
</td>
</tr>
<tr>
<td><label>Name :</label>{{p.productName}}</td>
</tr>
<tr><td><label>Size:</label>{{p.size}}</td></tr>
<tr><td><label>Purchase Price:</label>{{p.purchasePrice}}</td></tr>
<tr><td><label>Sale Price:</label>{{p.salePrice}}</td></tr>
<tr><td><label>In Stock:</label>{{p.totalInStock}} | <label>Sold:</label>{{p.totalSold}}</td></tr>
<tr><td>
<a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#productFormModal">
<i class="fas fa-pen"></i>
</a>
<span id="percentSold">{{((p.totalSold*1)/((p.totalInStock*1)+(p.totalSold*1)))*100|number:0}}</span>% Sold
<div class="progress progress-sm mr-2">
  <div id="progressBar" class="progress-bar" role="progressbar" style="width: {{((p.totalSold*1)/((p.totalInStock*1)+(p.totalSold*1)))*100}}%" aria-valuenow="{{p.totalSold*1}}" aria-valuemin="0" aria-valuemax="{{(p.totalInStock*1)+(p.totalSold*1)}}"></div>
</div>
</td></tr>
</table>

   <script>
        var prodId = $("#prodId").val();
        //prodId=prodId*1;
        $("#productBarCode").barcode(prodId,"datamatrix");
   </script>
   <script>
	var percentSold = $("#percentSold").html();
	percentSold=percentSold*1;
	var progressBarColor ='';
	if(percentSold<25) progressBarColor= 'bg-success';
	if(percentSold>25 && percentSold <50 ) progressBarColor= 'bg-info';
	if(percentSold>50 && percentSold <75 ) progressBarColor= 'bg-warning';
	if(percentSold>75 ) progressBarColor= 'bg-danger';

	$("#progressBar").attr("class","progress-bar "+progressBarColor);
	//$("#percentSoldLabel").html(percentSold);
   </script>