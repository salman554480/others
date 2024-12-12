<?php echo require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php require_once('parts/sidebar.php');?>
	
            <div id="layoutSidenav_content">
                <main>
              <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
			  
            <div class="page-header ">
              <div class="col-12 mt-4  mb-4 ">
              <h4 class="mb-3">Update Profile</h4>			     
               	 	
              </div>
            </div>
            <!-- End Page Header -->
			
			<!-- form start -->
          	 <div class="card mb-1" >
		 
		 <div class="card-header">
		    Edit Admin Record
		 </div>
			
			<?php
				require_once('parts/db.php');
				  
				
				$select_admin = "SELECT * FROM admin WHERE admin_id='$admin_id'";
				$run_admin = mysqli_query($conn,$select_admin);
				$row_admin = mysqli_fetch_array($run_admin);
				
					$admin_id = $row_admin['admin_id'];
					$admin_name = $row_admin['admin_name'];
					$admin_email = $row_admin['admin_email'];
					$admin_password = $row_admin['admin_password'];
					$admin_image = $row_admin['admin_image'];
					$admin_role = $row_admin['admin_role'];
					$admin_status = $row_admin['admin_status'];
				
				  
			?>
			
			
		 <div class="card-body" >
         <form class="row g-3" action="" method="post" enctype="multipart/form-data">
		 
            <div class="col-md-6">
               <label class="form-label">Name*</label>
               <input type="text" name="admin_name" value="<?php echo $admin_name;?>" class="form-control" autofocus required />
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Email*</label>
               <input type="email" name="admin_email" value="<?php echo $admin_email;?>" class="form-control"  required />
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Password*</label>
               <input type="text" name="admin_password" value="<?php echo $admin_password;?>" class="form-control"  required />
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Image*</label>
               <input type="file" name="admin_image" value="<?php echo $admin_image;?>" class="form-control">
            </div>
            
			<br>
			<div class="col-md-12">
               
               <input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Save Changes" />
            </div>
			
         </form>
		   </div>
		 </div>
           <!-- form end -->
		   
		   <?php
            require_once('parts/db.php');
            if(isset($_POST['insert_btn'])){
				
				$eadmin_name = $_POST['admin_name'];
				$eadmin_email = $_POST['admin_email'];
				$eadmin_password = $_POST['admin_password'];
				$eadmin_image = $_FILES['admin_image']['name'];
				$etmp_name = $_FILES['admin_image']['tmp_name'];
				
					if($eadmin_image ==  ""){
					
					$eadmin_image = $admin_image;
				}
				
               
				
				$update_admin = "UPDATE admin SET admin_name='$eadmin_name',admin_email='$eadmin_email',admin_password='$eadmin_password',admin_image='$eadmin_image' WHERE admin_id='$admin_id'";
				
				$run_admin = mysqli_query($conn,$update_admin);
				
				if($run_admin == true){
					//echo "data is inserted ";
					move_uploaded_file($etmp_name,"upload/$eadmin_image");
					echo "<script>alert('Record update');</script>";
			//		echo "<script>window.open('admin_view.php','_self');</script>";
					
					
				}else{
					//echo "fail";
					echo "<script>alert('Failed');</script>";
				}
				
				
			}
           
            ?>
		   
		   
          </div>
             
            </div>
        </div> 
		<?php require_once('parts/footer.php');?>
		<!--Footercdn--->
			<?php require_once('parts/footercdn.php');?>

    </body>
</html>
