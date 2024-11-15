<?php require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php  require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php  require_once('parts/sidebar.php');?>
	
            <div id="layoutSidenav_content" class="">
                <main class="">
                    <div class="container-fluid  px-4">
                         
            <div class="page-header">
              <div class="col-12 mt-4  mb-4">
              <h4 class="mb-3">View Category*</h4>
			     
               	<a href="category_add.php" class="btn  btn-sm  btn-outline-danger" >Add Record*</a>
              </div>
            </div>
                    <div class="card mb-3 bg-white">
                            
                            <div class="card-body ">

                    <?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "DELETE FROM category WHERE category_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Deleted');</script>";
								$run_meta = mysqli_query($conn,$delete_meta);
							echo "<script>window.open('category_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>

                                <table id="datatablesSimple"  class="table table-hover table-sm table-responsive ">
                                     <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
											<th>URL</th>
									       <th>Action*</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                         <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM category ";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$category_id = $row ['category_id'];
								$category_name = $row ['category_name'];
								$category_url = $row['category_url'];
								
                            ?>
                                        <tr>
                                            <td><?php echo $category_id;?></td>
                                            <td><?php echo $category_name;?></td>
                                            <td><?php echo $category_url;?></td>
                                            
                              			<td>
						<ul class="navbar-nav ">
                <li class="nav-item dropdown">
                    <button class="btn btn-danger dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</i></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                     
                        <li> 
							<a class="dropdown-item" href="category_view.php?del=<?php echo $category_id; ?>">Delete</a>
						</li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>                                     
							<a class="dropdown-item" href="category_edit.php?edit=<?php echo $category_id; ?>">Edit</a>
						</li>
                        <li><hr class="dropdown-divider" /></li>
						<li>       
						  <a class="dropdown-item" href="category_detail_page.php?detail_page=<?php echo $category_id; ?>">Detail</a>
						</li>
                    </ul>
                </li>
				</ul>
											</td>
                                        </tr>
								<?php  }?>
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
