<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Controller <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
     <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="wait_file.php">
            <i class="fas fa-fw fa-hourglass-half"></i>
            <span>Waiting Files</span></a>
    </li>
   
	
	<li class="nav-item">
        <a class="nav-link" href="file_view.php">
            <i class="fas fa-fw fa-file"></i>
            <span> Files</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>


    

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="user_view.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Users</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment"
            aria-expanded="true" aria-controls="file">
            <i class="fas fa-fw fa-money-bill-alt"></i>
            <span>Payments</span>
        </a>
        <div id="payment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="wallet_view.php">Wallet</a>
                 <a class="collapse-item" href="transaction_view.php">Transactions</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#folders"
            aria-expanded="true" aria-controls="file">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Folders</span>
        </a>
        <div id="folders" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="list_downloads.php">Downloads</a>
                 <a class="collapse-item" href="list_upload.php">Upload</a>
                  <a class="collapse-item" href="list_temp.php">Temp</a>
            </div>
        </div>
    </li>
    
       <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Package</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="add_package.php">Add Package</a>
                <a class="collapse-item" href="view_package.php">View Package</a>
            </div>
        </div>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>