     <div id="layoutSidenav_nav">
         <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
             <div class="sb-sidenav-menu">
                 <div class="nav">

                     <a class="nav-link" href="index.php">
                         <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                         Dashboard
                     </a>
                     <!--Admin-->
                     <ul class="navbar-nav p-3 btn ">
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown " id="navbarDropdown" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">Admin<div
                                     class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="admin_add.php">New Add*</a></li>
                                 <li><a class="dropdown-item" href="admin_view.php">View Record*</a></li>
                                 <li><a class="dropdown-item" href="admin_trash.php">Trash*</a></li>
                             </ul>
                         </li>
                         <!--End Admin-->

                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown " id="navbarDropdown" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">Devices<div
                                     class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="device.php">View Record*</a></li>
                             </ul>
                         </li>

                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown " id="navbarDropdown" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">Page<div
                                     class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="page_view.php">View Record*</a></li>
                                 <li><a class="dropdown-item" href="page_add.php">Add Record</a></li>
                             </ul>
                         </li>
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown " id="navbarDropdown" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">Blog<div
                                     class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="post_view.php">View Record*</a></li>
                                 <li><a class="dropdown-item" href="post_add.php">Add Record</a></li>
                             </ul>
                         </li>


                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown " id="navbarDropdown" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">Menu<div
                                     class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="menu_add.php">View Record</a></li>
                             </ul>
                         </li>
                         <!--End tool-->

                         <!--Category-->
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown" id="navbarDropdown" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">Category<div
                                     class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="category_add.php">New Add*</a></li>
                                 <li><a class="dropdown-item" href="category_view.php">View Record*</a></li>
                                 <li><a class="dropdown-item" href="category_trash.php">Trash*</a></li>
                             </ul>
                         </li>
                         <!--End Category-->





                     </ul>
                     <a class="nav-link" href="contactform_view.php">
                         <div class="sb-nav-link-icon"><i class="fas fa-phone"></i></div>
                         Form Entries
                     </a>
                     <a class="nav-link" href="setting.php">
                         <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                         Settings
                     </a>

                 </div>
             </div>
             <div class="sb-sidenav-footer">
                 <div class="small">Logged in as:</div>
                 <?php echo ucfirst($admin_name); ?>
             </div>
         </nav>
     </div>