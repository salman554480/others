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
                        <h1 class="h3 mb-0 text-gray-800">Wallet</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                        <div class="card shadow mb-4">
                     
						<?php
						require_once('parts/db.php');
						
						if(isset($_GET['update'])){ 
							$update_id = $_GET['update'];
							$status = $_GET['status'];
							if($status == "pending"){
							    $new_status= "approve";
							}else if($status == "approve"){
							    $new_status= "pending";
							}
							
						$update = "UPDATE wallet set wallet_status='$new_status' WHERE wallet_id='$update_id'";	
						$run_update = mysqli_query($conn,$update);

						if($run_update === true){
						    if($new_status == "approve"){
						     echo   	$get_wallet = "SELECT * FROM wallet WHERE wallet_id='$update_id'";
									$run_get_wallet = mysqli_query($conn,$get_wallet);
								    $row_get_wallet = mysqli_fetch_array($run_get_wallet);
									
									     $wallet_id = $row_get_wallet['wallet_id'];
									     $user_id = $row_get_wallet['user_id'];
									     $wallet_amount = $row_get_wallet['wallet_amount'];
									     $wallet_date = $row_get_wallet['wallet_date'];
									     
									
								  $get_user = "SELECT * FROM user WHERE user_id='$user_id'";
									$run_get_user = mysqli_query($conn,$get_user);
								    $row_get_user = mysqli_fetch_array($run_get_user);
									
									     $user_name = $row_get_user['user_name'];  
									     $user_email = $row_get_user['user_email'];  
									     
									     
									    
                                            $subject = "Payment Added to Your Wallet";
                                            
                                            // HTML email template
                                            $message = '
                                            <html>
                                            <head>
                                                <title>Payment Notification</title>
                                                <style>
                                                    body {
                                                        font-family: Arial, sans-serif;
                                                        background-color: #f4f4f4;
                                                        padding: 20px;
                                                    }
                                                    .container {
                                                        background-color: #ffffff;
                                                        padding: 20px;
                                                        border-radius: 5px;
                                                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                                    }
                                                    h1 {
                                                        color: #333;
                                                    }
                                                    p {
                                                        color: #555;
                                                    }
                                                    .footer {
                                                        margin-top: 20px;
                                                        font-size: 12px;
                                                        color: #888;
                                                    }
                                                </style>
                                            </head>
                                            <body>
                                                <div class="container">
                                                    <h1>Payment Notification</h1>
                                                    <p>Dear '.$user_name.',</p>
                                                    <p>We are pleased to inform you that an amount of <strong>$' . number_format($wallet_amount, 2) . '</strong> has been successfully added to your wallet.</p>
                                                    <p>Thank you for using our service!</p>
                                                    <p>Best regards,<br>Foldious</p>
                                                    <div class="footer">
                                                        <p>This is an automated message, please do not reply.</p>
                                                    </div>
                                                </div>
                                            </body>
                                            </html>
                                            ';
                                        
                                            // Set content-type header for sending HTML email
                                            $headers  = "MIME-Version: 1.0" . "\r\n";
                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                        
                                            // Additional headers
                                            $headers .= 'From: support@foldious.com' . "\r\n";
                                            $headers .= $user_email . "\r\n";
                                        
                                            // Send the email
                                           mail($user_email, $subject, $message, $headers);
                                            
                                        }
                                        
                            		     
							
							echo "<div class='alert alert-success'>Status Updated & Email sent successfully to $user_email</div>";
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
                                            <th>WalletID</th>
                                            <th>User</th>
                                            <th>Source</th>
                                            <th>TransactionID</th>
                                            <th>SS</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
									<?php
									require_once('parts/db.php');
									
									$select_wallet = "SELECT * FROM wallet";
									$run_wallet = mysqli_query($conn,$select_wallet);
									
									while($row_wallet = mysqli_fetch_array($run_wallet)){
									
									     $wallet_id = $row_wallet['wallet_id'];
									     $user_id = $row_wallet['user_id'];
									     $wallet_source = $row_wallet['wallet_source'];
									     $wallet_trasaction_id = $row_wallet['wallet_trasaction_id'];
									     $wallet_transaction_ss = $row_wallet['wallet_transaction_ss'];
									     $wallet_amount = $row_wallet['wallet_amount'];
									     $wallet_date = $row_wallet['wallet_date'];
									     $wallet_status = $row_wallet['wallet_status'];
									 
    									 $select_user = "SELECT * FROM user WHERE user_id='$user_id'"; 
    									 $run_user = mysqli_query($conn,$select_user);
    									 $row_user = mysqli_fetch_array($run_user);
									     $user_name = $row_user['user_name'];
									
									    $date = new DateTime($wallet_date);
                                        $formatted_date = $date->format('d M, Y h:i A');
                                      
								
									    
									?>
									
									
                                       <tr>
                                           <td><?php echo $wallet_id;?></td>
									       <td><a href="user_details.php?user_id=<?php echo $user_id;?>"><?php echo $user_name;?></a></td>
									       <td><?php echo $wallet_source;?></td>
									       <td><?php echo $wallet_trasaction_id;?></td>
									       <?php if($wallet_transaction_ss == ""){ ?>
									       <td>No SS Found</td>
									       <?php }else{?>
									       <td><a href="../images/wallet/<?php echo $wallet_transaction_ss?>" target="_blank">View SS</a></td>
									       <?php }?>
									       <td><?php echo $wallet_amount;?></td>
									       <td><?php echo $formatted_date;?></td>
									       <td> 
									            <a href="wallet_view.php?update=<?php echo $wallet_id;?>&status=<?php echo $wallet_status?>">
									                <span class="badge bg-<?php if($wallet_status =="pending"){echo "danger";}else{echo "success";}?> text-light"><?php echo $wallet_status;?></span>
									            </a>
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


