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
              <h4 class="mb-3">View Menu</h4>
			     
               	<a href="menu_add.php" class="btn btn-sm  btn-outline-danger" >Add Record*</a>
               	<a href="menu_trash.php" class="btn btn-sm  btn-outline-warning " >Record Trash*</a>
              </div>
            </div>
                    <div class="card mb-3 bg-white">
                            
                            <div class="card-body ">

                    <?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "DELETE FROM menu WHERE menu_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('menu_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>

                                <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Page</th>
                                            <th>Action*</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                         <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM menu";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$menu_id = $row ['menu_id'];
								$page_id = $row ['page_id'];
								
								
								$select_page = "SELECT * FROM page WHERE page_id='$page_id' ";
								$run_page = mysqli_query($conn,$select_page);
								$row_page = mysqli_fetch_array($run_page);
									$page_title =  $row_page['page_title'];
                            ?>
                                        <tr>
                                            <td><?php echo $menu_id;?></td>
                                            <td><?php echo $page_title;?></td>
                                     		<td>
												<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <button class="btn btn-danger dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</i></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                     
                        <li>  <a class="dropdown-item" href="menu_view.php?del=<?php echo $menu_id; ?>">Delete</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>                                       <a class="dropdown-item" href="menu_edit.php?edit=<?php echo $menu_id; ?>">Edit</a></li>
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
