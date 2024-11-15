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
              <h4 class="mb-3">View Calculator Trash</h4>
			     
               	<a href="calculator_add.php" class="btn btn-sm  btn-outline-danger" >Add Record</a>
               	<a href="calculator_trash.php" class="btn btn-sm  btn-outline-warning " >Record Trash</a>
              </div>
            </div>
                    <div class="card mb-3 bg-white">
                            
                            <div class="card-body ">

                    <?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "UPDATE calculator SET  calculator_status='publish' WHERE calculator_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
							echo "<script>window.open('calculator_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>

                                <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>URL</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                         <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM calculator";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$calculator_id = $row ['calculator_id'];
								$calculator_title = $row ['calculator_title'];
								$calculator_url = $row ['calculator_url'];
								$calculator_code = $row['calculator_code'];

                            ?>
                                        <tr>
                                            <td><?php echo $calculator_id;?></td>
                                            <td><?php echo $calculator_title;?></td>
                                            <td><?php echo $calculator_url;?></td>
                                            <td>
												<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <button class="btn btn-danger dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</i></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                     
                        <li>  <a class="dropdown-item" href="calculator_trash.php?del=<?php echo $calculator_id; ?>">Delete</a></li>
                        <li><hr class="dropdown-divider" /></li>
                       
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
