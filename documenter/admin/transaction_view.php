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
                        <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                        <div class="card shadow mb-4">
                     
					
						
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>TransactionID</th>
                                            <th>User</th>
                                            <th>Package</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
									<?php
									require_once('parts/db.php');
									
									$select_transaction = "SELECT * FROM transaction";
									$run_transaction = mysqli_query($conn,$select_transaction);
									
									while($row_transaction = mysqli_fetch_array($run_transaction)){
									
									     $transaction_id = $row_transaction['transaction_id'];
									     $user_id = $row_transaction['user_id'];
									     $package_id = $row_transaction['package_id'];
									     $transaction_amount = $row_transaction['transaction_amount'];
									     $transaction_source = $row_transaction['transaction_source'];
									     $transaction_date = $row_transaction['transaction_date'];
									     $transaction_expiry_date = $row_transaction['transaction_expiry_date'];
									     
    									 $select_user = "SELECT * FROM user WHERE user_id='$user_id'"; 
    									 $run_user = mysqli_query($conn,$select_user);
    									 $row_user = mysqli_fetch_array($run_user);
									     $user_name = $row_user['user_name'];
									     
									     $select_package = "SELECT * FROM package WHERE package_id='$package_id'"; 
    									 $run_package = mysqli_query($conn,$select_package);
    									 $row_package = mysqli_fetch_array($run_package);
									    $package_name = $row_package['package_name'];
									
									    
                                      
								
									    
									?>
									
									
                                       <tr>
                                           <td><?php echo $transaction_id;?></td>
									       <td><a href="user_details.php?user_id=<?php echo $user_id;?>"><?php echo $user_name;?></a></td>
									       <td><?php echo $package_name;?></td>
									       <td><?php echo $transaction_amount;?></td>
									       <td><?php echo $transaction_date;?></td>
									       <td><?php echo $transaction_expiry_date;?></td>
									     
									       
									       
										   
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


