<?php
$companyPrefix = (isset($_SESSION['companyPrefix'])?$_SESSION['companyPrefix']:'default');
$viewMode = (isset($_GET['viewMode'])?$_GET['viewMode']:'view');
?>

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Bill Summary</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="chartDiv">
                  <!-- bill summary -->
                  <div>
                  	<center>
                  	<h4>Current Due</h4>
                  	<h4 class="alert-warning" id="billSummary">0</h4>
                  	Due Date: <span id="billDueDate"></span><br>
                  	<span id="payNowLabel">Pay Online(PayPal): </span>
                  	<span id="payNowLink"><a id="payNow" class="button" target="new">Pay Now</a></span>
                  	</center>
                  </div>
                  <div id="bankdDepositDiv">
                      <div class="row">
                         <div class="col-lg-10">Bank Deposit <span id="billDueDate2"></span></div>
                         <div id="billSummary2" class="col-lg-2">MCB </div>
                      </div>
                      <div class="row">
                      	<div class="col-lg-5"><b>Step-I (Pay)</b></div>
                      	<div class="col-lg-5"><b>Step-II (Acknowledge)</b></div>
                      </div>
                      <div class="row">
                       <div class="col-lg-5">
                         <b>Account Title:</b> Abdul Kareem
                         <br><b>Bank Branch:</b> MCB G-8/4, Islamabad, Pakistan
                         <br><b>Account(IBAN) #: </b> PK24MUCB0130002010086452
                       </div>
                       <div class="col-lg-5"><?php include 'paymentForm.php';?></div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
