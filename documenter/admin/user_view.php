<?php require_once('parts/top.php'); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
      <?php require_once('parts/sidebar.php');?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('parts/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">user</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                        <div class="card shadow mb-4">
                     
						<?php
						require_once('parts/db.php');
						
						if(isset($_GET['del'])){ 
							$del_id = $_GET['del'];
						$delete = "DELETE FROM user WHERE user_id='$del_id'";	
						$run_delete = mysqli_query($conn,$delete);

						if($run_delete === true){
							echo "<div class='alert alert-success'>User has been deleted</div>";
						}else{
							echo "failed";
						}
						}
						?>
						
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Package</th>
                                            <th>Name</th>
                                            <th>Files</th>
                                            <th>Email</th>
                                            <th>Verify</th>
                                            <th>Delete</th>
                                            
                                         
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
									<?php
									require_once('parts/db.php');
									
									$select_user = "SELECT * FROM user";
									$run_user = mysqli_query($conn,$select_user);
									
									while($row_user = mysqli_fetch_array($run_user)){
									
									     $user_id = $row_user['user_id'];
									     $package_id = $row_user['package_id'];
									     $user_name = $row_user['user_name'];
									     $user_email = $row_user['user_email'];
									     $user_password = $row_user['user_password'];
									     $user_image = $row_user['user_image'];
									     $user_contact = $row_user['user_contact'];
									     $user_address = $row_user['user_address'];
									     $user_verify = $row_user['user_verify'];
									 
									 
									 $select_package = "SELECT * FROM package WHERE package_id='$package_id'"; 
									 $run_package = mysqli_query($conn,$select_package);
									 $row_package = mysqli_fetch_array($run_package);
									    $package_name = $row_package['package_name'];
									
									
									$select_file = "SELECT * FROM file WHERE user_id='$user_id'"; 
									 $run_file = mysqli_query($conn,$select_file);
									 $total_files = mysqli_num_rows($run_file);    
									    
									?>
									
									
                                       <tr>
									       <td><?php echo $user_id;?></td>
									       <td><?php echo $package_name;?></td>
									       <td><a href="user_details.php?user_id=<?php echo $user_id?>"><?php echo $user_name;?></a></td>
									       <td><?php echo $total_files;?></td>
									       <td><?php echo $user_email;?></td>
									      
									       <td><?php echo $user_verify;?></td>
									       
									       <td>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $user_id;?>">
											 Delete
											</button>

												<!-- The Modal -->
												<div class="modal" id="myModal<?php echo $user_id;?>">
												  <div class="modal-dialog">
													<div class="modal-content">

													  <!-- Modal Header -->
													  <div class="modal-header">
														<h4 class="modal-title">Delete Record</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													  </div>

													  <!-- Modal body -->
													  <div class="modal-body">
													  Are you sure you want to delete?
													  </div>

													  <!-- Modal footer -->
													  <div class="modal-footer">
													  <a href="user.php?del=<?php echo $user_id;?>" class="btn btn-danger">Delete</a>
														<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
													  </div>

													</div>
												  </div>
												</div>
										   </td>
										   
									  </tr> 

						
 						            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
					

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           <?php require_once('parts/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


