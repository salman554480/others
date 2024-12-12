<?php require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php  require_once('parts/sidebar.php');?>
		
            <div id="layoutSidenav_content">
               <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header ">
              <div class="col-12 mt-4  mb-4">
                <h4 class="mb-3">Add Admin</h4>
			     
               	<a href="admin_view.php" class="btn btn-sm btn-outline-danger" >View Record*</a>
               	<a href="admin_trash.php" class="btn btn-sm btn-outline-primary " >Trash Record*</a>
              </div>
            </div>
            <!-- End Page Header -->
			
			<!-- form start -->
          	 <div class="card mb-1" >
		 
		 <div class="card-header">
		    Enter Admin Record
		 </div>
		 
		 <div class="card-body" >
         <form class="row g-3" action="" method="post" enctype="multipart/form-data">
		 
            <div class="col-md-4">
               <label class="form-label">Name*</label>
               <input type="text" name="admin_name" class="form-control" autofocus required />
            </div>
			
			<div class="col-md-4">
               <label class="form-label">Email*</label>
               <input type="email" name="admin_email" class="form-control"  required />
            </div>
			
			<div class="col-md-4">
               <label class="form-label">Password*</label>
               <input type="password" name="admin_password" class="form-control"  required />
            </div>
			
			<div class="col-md-4">
               <label class="form-label">Image*</label>
               <input type="file" name="admin_image" class="form-control"  required />
            </div>
            
			<div class="col-md-4">
               <label class="form-label">Role*</label>
               <input type="role" name="admin_role" class="form-control"  required />
            </div>
            
			<div class="col-md-4">
               <label class="form-label">Status*</label>
               <select name="admin_status" class="form-control" required >
			     <option value="publish" > Publish </option>
			     <option value="draft" > Draft </option>
			   
			   </select>
            </div>
            <br><br><br><br>
			<div class="col-md-12">
               
               <input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Add Record" />
            </div>
			
         </form>
		   </div>
		 </div>
           <!-- form end -->
		   
		   <?php
            require_once('parts/db.php');
            if(isset($_POST['insert_btn'])){
				
				$admin_name = $_POST['admin_name'];
				$admin_email = $_POST['admin_email'];
				$admin_password = $_POST['admin_password'];
				$admin_image = $_FILES['admin_image']['name'];
				$tmp_name = $_FILES['admin_image']['tmp_name'];
				$admin_role = $_POST['admin_role'];
				$admin_status = $_POST['admin_status'];
				
				$insert_admin = "INSERT INTO admin(admin_name,admin_email,admin_password,admin_image,admin_role,admin_status)VALUES('$admin_name','$admin_email','$admin_password','$admin_image','$admin_role','$admin_status')";
				
				$run_admin = mysqli_query($conn,$insert_admin);
				
				if($run_admin == true){
					//echo "data is inserted ";
					move_uploaded_file($tmp_name,"upload/admin/$admin_image");
					echo "<script>alert('Record Added');</script>";
					echo "<script>window.open('admin_view.php','_self');</script>";
				}else{
					//echo "fail";
					echo "<script>alert('Failed');</script>";
				}
				
				
			}
           
            ?>
		   
		   
          </div>
               <?php require_once('parts/footer.php');?>
            </div>
			   
        </div>
      <!--FooterCdn-->
	  <?php require_once('parts/footercdn.php');?>
    </body>
</html>
