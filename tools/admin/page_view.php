<?php require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php  require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php require_once('parts/sidebar.php');?>
	
            <div id="layoutSidenav_content" class="">
                <main class="">
                    <div class="container-fluid  px-4">
                         
            <div class="page-header">
              <div class="col-12 mt-4 mb-4">
              <h4 class="mb-3">View Page</h4>
			     
               	<a href="page_add.php" class="btn btn-sm  btn-outline-danger" >Add Record*</a>
              </div>
            </div>
                    <div class="card mb-3 bg-white">
                            
                            <div class="card-body ">

                    

                                <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Action*</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                         <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM page ";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$page_id = $row ['page_id'];
								$page_title = $row ['page_title'];
								

                            ?>
                                        <tr>
                                            <td><?php echo $page_id;?></td>
                                            <td><?php echo $page_title;?></td>
                                           
											<td>
												<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <button class="btn btn-danger dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</i></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                     
                        <li>  <a class="dropdown-item" href="">View</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>                                       <a class="dropdown-item" href="page_edit.php?edit=<?php echo $page_id; ?>">Edit</a></li>
                    </ul>
                </li>
				</ul>
											</td>
                                        </tr>
                                        <?php    }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
						
                          
                </main>
                <?php require_once('parts/footer.php');?>
            </div>
			   
        </div>
    <!--Footercdn--->
			<?php require_once('parts/footercdn.php');?>

    </body>
</html>
