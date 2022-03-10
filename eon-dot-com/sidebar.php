<?php 
echo '<ul class="navbar-nav sidebar noprint accordion" id="accordionShttps://localhost'.$_SERVER['PHP_SELF'].'">';
?>

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-globe"></i>
        </div>
        <div class="sidebar-brand-text mx-3">EON DOTCOM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Part - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Masters
    </div>

    <!-- Nav Part - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="user-master.php">
            <i class="fas fa-fw fa-user"></i>
            <span>User Master</span>
        </a>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-address-card"></i>
        <span>Vendor Master</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="vendor-master.php">Vendor Master</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="vendor-master2.php">Contact Person Details</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="vendor-master3.php">Parts Provided By Vendor</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-tools"></i>
        <span>Part Masters</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="part-master1.php">Part Master</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master22.php">Part Price List Entry</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master2.php">Part Details Entry</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master7.php">Part GST Details Entry</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master3.php">Part Opening Stock Entry</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master4.php">Repairable Part Entry</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master5.php">Part Annexure Details</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master6.php">Part Brand Details</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="part-master10.php">Part Wise Track Machine Entry</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Track Machine Masters</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="tmem-master.php">Track Machine Engine Detail</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="track-machine-master1.php">Track Machine Master</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="track-machine-master2.php">Track Machine Wise Part Entry</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="tm4-reg.php">Track Machine Wise QTY-POH Entry</a>   
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
   <!--  <div class="sidebar-heading">
        Transactions
    </div> -->

    <!-- Nav Part - Pages Collapse Menu -->
   <!--  <li class="nav-item">
        <a class="nav-link collapsed" href="pifs-reg.php">
            <i class="fas fa-fw fa-tools"></i>
            <span>Part Issue From Store</span>
        </a>
    </li> -->

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="schedule-entry.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Schedule Entry</span>
        </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

</ul>