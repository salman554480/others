<?php require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php echo require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php require_once('parts/sidebar.php');?>
	
            <div id="layoutSidenav_content" class="">
                <main class="">
                    <div class="container-fluid  px-4">
            <div class="page-header ">
              <div class="col-12 mt-4  mb-4">
			     <h4 class="mb-3">Trash Admin</h4>
             
			     
               	<a href="admin_add.php" class="btn btn-sm btn-outline-danger" >Add Record*</a>
               	<a href="admin_view.php" class="btn btn-sm   btn-outline-warning " >View Record*</a>
              </div>
            </div>
                    <div class="card mb-3 bg-white">
                            
                            <div class="card-body ">

                    <?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "UPDATE admin SET  admin_status='publish' WHERE admin_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Publish');</script>";
							echo "<script>window.open('admin_view.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>

                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id*</th>
                                            <th>Name*</th>
                                            <th>E-mail*</th>
                                            <th>Password*</th>
                                            <th>Image*</th>
                                            <th>Role*</th>
                                            <th>Restore*</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                         <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM admin WHERE admin_status='draft' ORDER BY admin_id DESC";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$admin_id = $row ['admin_id'];
								$admin_name = $row ['admin_name'];
								$admin_email = $row['admin_email'];
								$admin_password = $row['admin_password'];
								$admin_image = $row ['admin_image'];
								$admin_role = $row ['admin_role'];

                            ?>
                                        <tr>
                                            <td><?php echo $admin_id;?></td>
                                            <td><?php echo $admin_name;?></td>
                                            <td><?php echo $admin_email;?></td>
                                            <td><?php echo $admin_password;?></td>
                                            <td><img height="40px" src="/upload/<?php echo $admin_image;?>" alt=""></td>
                                            <td><?php echo $admin_role;?></td>
											<td><a href="admin_trash.php?del=<?php echo $admin_id;?>" class="btn btn-success">Trash</a></td>
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
