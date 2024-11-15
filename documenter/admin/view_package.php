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
                        <h1 class="h3 mb-0 text-gray-800">Package</h1>
                    </div>

                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Package DataTables Example</h6>
                        </div>
						<?php
						require_once('parts/db.php');
						
						if(isset($_GET['del'])){ 
							$del_id = $_GET['del'];
						$delete = "DELETE FROM package WHERE package_id='$del_id'";	
						$run_delete = mysqli_query($conn,$delete);

						if($run_delete === true){
							echo "<div class='alert alert-success'>Package has been deleted</div>";
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
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Storage</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                            
                                         
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
									<?php
									require_once('parts/db.php');
									
									$select_package = "SELECT * FROM package ORDER BY package_id DESC";
									$run_package = mysqli_query($conn,$select_package);
									
									while($row_package = mysqli_fetch_array($run_package)){
									
									     $package_id = $row_package['package_id'];
									     $package_name = $row_package['package_name'];
									     $package_amount = $row_package['package_amount'];
									     $package_storage = $row_package['package_storage'];
									 
									 
									?>
									
									
                                       <tr>
									       <td><?php echo $package_id;?></td>
									       <td><?php echo $package_name;?></td>
									       <td><?php echo $package_amount;?></td>
									       <td><?php echo $package_storage;?></td>
									       <td>
											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $package_id;?>">
											 Delete
											</button>

												<!-- The Modal -->
												<div class="modal" id="myModal<?php echo $package_id;?>">
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
													  <a href="package.php?del=<?php echo $package_id;?>" class="btn btn-danger">Delete</a>
														<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
													  </div>

													</div>
												  </div>
												</div>
										   </td>
										    <td><a href="edit_package.php?edit=<?php echo $package_id;?>" class="btn btn-success">Edit</td>
										   
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


