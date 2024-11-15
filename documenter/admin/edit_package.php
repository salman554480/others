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
                        <h1 class="h3 mb-0 text-gray-800">Edit package record</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                     <?php
					 require_once('parts/db.php');
					 
					 if(isset($_GET['edit'])){
					 $edit_id = $_GET['edit'];
					
                     $select_package = "SELECT * FROM package WHERE package_id='$edit_id'";
                     $run_package = mysqli_query($conn,$select_package);
                     $row_package = mysqli_fetch_array($run_package);

                        $dbpackage_name = $row_package['package_name']; 						
                        $dbpackage_amount = $row_package['package_amount']; 						
                        $dbpackage_storage = $row_package['package_storage']; 						
					 }
					 ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="<?php echo $dbpackage_name;?>" name="package_name" class="form-control" required />
                        </div>
						
                       <div class="form-group">
					     <label>Amount</label>
						 <input type="text" value="<?php echo $dbpackage_amount;?>" class="form-control" name="package_amount" />
					   </div>
					   
					   <div class="form-group">
					     <label>Storage</label>
						 <input type="text" value="<?php echo $dbpackage_storage;?>" class="form-control" name="package_storage" />
					   </div>
					   					    
					   
					   <div class="form-group">
					     <input type="submit"value="Edit package" class="btn btn-success" name="update_btn">
					   </div>
                       <a href="view_package.php" class="btn btn-primary">Go Back</a>
                    </form>
                    
					<?php 
					require_once('parts/db.php');
					
					if(isset($_POST['update_btn'])){
						
						$package_name = $_POST['package_name'];
						$package_amount = $_POST['package_amount'];
						$package_storage = $_POST['package_storage'];
						
						
					$update_package = "UPDATE package SET package_name='$package_name',package_amount='$package_amount',package_storage='$package_storage' WHERE package_id='$edit_id'"; 
	
					    $run_update = mysqli_query($conn,$update_package);
					  
					    if($run_update === true){
						echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
						  Record Save!
						</div>
		  
						<script>
						  document.addEventListener("DOMContentLoaded", function () {
							var myAlert = document.getElementById("myAlert");
							myAlert.style.display = "block";
							myAlert.style.display = "none";
							window.location.href = "view_package.php";
						   
						  });
						</script>';
						}else{
							echo"<div class='alert alert-danger'>failed</div>";
						}
					}
					?>
			

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
    <?php require_once('parts/footer_cdn.php'); ?>


