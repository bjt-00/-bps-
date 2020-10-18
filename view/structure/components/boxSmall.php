            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-<?php echo (isset($_GET['type'])?$_GET['type']:'primary');?> shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-<?php echo (isset($_GET['type'])?$_GET['type']:'primary');?> text-uppercase mb-1"><?php echo (isset($_GET['heading'])?$_GET['heading']:'Heading');?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailySummary"><?php echo (isset($_GET['content'])?$_GET['content']:'Content');?></div>
                      <div class="text-xs" title="<?php echo (isset($_GET['title'])?$_GET['title']:'Title');?>"><?php echo (isset($_GET['description'])?$_GET['description']:'Description');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
