    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink" <?php echo $display;?>></i>
        </div>
        <div class="sidebar-brand-text mx-3">
          <img class="BposLogo" alt="Bitguider Point of Sale" src="themes/common/images/bposLogo.png">
        </div>
      </a>

      <!-- Divider -->
      <?php $showHideItem= (strpos($_SERVER['REQUEST_URI'],'dashboard.php')?"style='display:none'":'')?>
      <hr class="sidebar-divider my-0" <?php echo $showHideItem?>>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active" <?php echo $showHideItem?>>
        <a class="nav-link" href="dashboard.php" target="new">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <?php $showHideItem= (strpos($_SERVER['REQUEST_URI'],'pos.php')?"style='display:none'":'')?>
      <hr class="sidebar-divider my-0" <?php echo $showHideItem?>>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active" <?php echo $showHideItem?>>
        <a class="nav-link" href="pos.php" target="new">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Point of Sale</span></a>
      </li>

     <!-- Divider -->
     <?php $showHideItem= (strpos($_SERVER['REQUEST_URI'],'product.php')?"style='display:none'":'')?>
      <hr class="sidebar-divider my-0" <?php echo $showHideItem?>>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active" <?php echo $showHideItem?>>
        <a class="nav-link" href="product.php" target="new">
          <i class="fas fa-fw fa-shopping-bag"></i>
          <span>Product</span></a>
      </li>

     <!-- Divider -->
     <?php $showHideItem= "";//(strpos($_SERVER['REQUEST_URI'],'product.php')?"style='display:none'":'')?>
      <hr class="sidebar-divider my-0" <?php echo $showHideItem?>>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active" <?php echo $showHideItem?>>
        <a class="nav-link" href="printlabel.php" target="new">
          <i class="fas fa-fw fa-barcode"></i>
          <span>Print Labels</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" <?php echo $display;?>>

      <!-- Heading -->
      <div class="sidebar-heading" <?php echo $display;?>>
        Menu
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item" <?php echo $display;?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Manage</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="product.php" target="new">Products</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item" <?php echo $display;?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" <?php echo $display;?>>

      <!-- Heading -->
      <div class="sidebar-heading" <?php echo $display;?>>
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item" <?php echo $display;?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item" <?php echo $display;?>>
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item" <?php echo $display;?>>
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" <?php echo $display;?>>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline" <?php echo $display;?>>
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

