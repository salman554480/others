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
                        <h1 class="h3 mb-0 text-gray-800">Add Package</h1>
                    </div>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="package_name" class="form-control" />
                        </div>
						
						<div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" name="package_amount" class="form-control" />
                        </div>
						
						<div class="form-group">
                            <label for="">Storage</label>
                            <input type="text" name="package_storage" class="form-control" />
                        </div>

                        

                        <div class="form-group">
                            <input type="submit" value="Add Package" name="insert_btn" class="btn btn-success" />
                        </div>
                    </form>
                    
					<?php
					require_once('parts/db.php');
					
						
						
					if(isset($_POST['insert_btn'])){
						
					$package_name = $_POST['package_name'];
					$package_amount = $_POST['package_amount'];
					$package_storage = $_POST['package_storage'];
					
					$insert_package = "INSERT INTO package(package_name,package_amount,package_storage) 
					VALUES('$package_name','$package_amount','$package_storage')";
					
					$run_package = mysqli_query($conn,$insert_package);
					
					if($run_package === true){
					echo '<div id="myAlert" class="alert alert-success" role="alert" style="display: none;">
					  Record Add!
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
						echo"fail";
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


