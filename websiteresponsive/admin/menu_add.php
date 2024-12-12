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
                <h4 class="mb-3">Menu</h4>
		      </div>
            </div>
            <!-- End Page Header -->
			
			<!-- form start -->
          	 <div class="card mb-1" >
		 
		 <div class="card-header">
		    Enter Menu Record
		 </div>
		 
		 <div class="card-body" >
				<div class="row">
					<div class="col-md-4">
						<form class="row g-3" action="" method="post" enctype="multipart/form-data">
		 
							   <div class="form-group">
							   <label>Select Page</label>	
							   <select class="form-control" name="page_id">
									 <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM page ";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$page_id = $row ['page_id'];
								$page_title = $row ['page_title'];
								?>
									<option value="<?php echo $page_id;?>"><?php echo $page_title;?></option>
								<?php } ?>	
							   </select>	
						   </div>
						   
						     <div class="form-group">
							   <label>Location</label>	
							   <select class="form-control" name="menu_location">
									<option value="header">Header</option>
									<option value="footer">Footer</option>
							   </select>
							 </div>
							   
							   <input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Add to Menu" />
							
						 </form>
						 
						 <?php
            require_once('parts/db.php');
            if(isset($_POST['insert_btn'])){
				
				$ipage_id = $_POST['page_id'];
				
				$insert_menu = "INSERT INTO menu(page_id)VALUES('$ipage_id')";
				
				$run_menu = mysqli_query($conn,$insert_menu);
				
				if($run_menu == true){
					//echo "data is inserted ";
					echo "<script>alert('Record Added');</script>";
					echo "<script>window.open('menu_add.php','_self');</script>";
				}else{
					//echo "fail";
					echo "<script>alert('Failed');</script>";
				}
				
				
			}
           
            ?>
					</div>
					<div class="col-md-8">
						<table id="" class="table table-hover table-bordered table-sm table-responsive">
						   <thead>
							  <tr>
								 <th>Id</th>
								 <th>Page</th>
								 <th>Location</th>
								 <th>Action</th>
							  </tr>
						   </thead>
						   <tbody>
							  <?php 
								 require_once('parts/db.php'); 
								  $select = "SELECT * FROM menu";
								  $run = mysqli_query($conn,$select);
								  while( $row = mysqli_fetch_array ($run)){
								 
								 $menu_id = $row ['menu_id'];
								 $page_id = $row ['page_id'];
								 $menu_location = $row ['menu_location'];
								 
								 
								 $select_page = "SELECT * FROM page WHERE page_id='$page_id' ";
								 $run_page = mysqli_query($conn,$select_page);
								 $row_page = mysqli_fetch_array($run_page);
								 $page_title =  $row_page['page_title'];
								 ?>
							  <tr>
								 <td><?php echo $menu_id;?></td>
								 <td><?php echo $page_title;?></td>
								 <td><?php echo $menu_location;?></td>
								 <td>
									<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
									   <li class="nav-item dropdown">
										  <button class="btn btn-danger dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</i></button>
										  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
											 <li>  <a class="dropdown-item" href="menu_view.php?del=<?php echo $menu_id; ?>">Delete</a></li>
											 <li>
												<hr class="dropdown-divider" />
											 </li>
											 <li>                                       <a class="dropdown-item" href="menu_add.php?edit=<?php echo $menu_id; ?>">Edit</a></li>
										  </ul>
									   </li>
									</ul>
								 </td>
							  </tr>
							  <?php    }?>
						   </tbody>
						</table>
						
						<?php if(isset($_GET['edit'])){
								$edit_id =  $_GET['edit'];
								
								 $select_update = "SELECT * FROM menu WHERE menu_id='$edit_id'";
								  $run_update = mysqli_query($conn,$select_update);
								  $row_update = mysqli_fetch_array ($run_update);
								 
								 $page_id = $row_update['page_id'];
								 $menu_location = $row_update['menu_location'];
								
								
							?>
						<form class="row g-3" action="" method="post" enctype="multipart/form-data">
		 
							   <div class="form-group">
							   <label>Select Page</label>	
							   <select class="form-control" name="new_page_id">
									 <?php 
                                
                              	require_once('parts/db.php'); 
                                $eselect = "SELECT * FROM page ";
                                $erun = mysqli_query($conn,$eselect);
                                while( $erow = mysqli_fetch_array ($erun)){

								$epage_id = $erow['page_id'];
								$epage_title = $erow['page_title'];
								?>
									<option <?php if($epage_id == $page_id){echo "selected";}?> value="<?php echo $epage_id;?>"><?php echo $epage_title;?></option>
								<?php } ?>	
							   </select>	
						   </div>
						   
						   <div class="form-group">
							   <label>Location</label>	
							   <select class="form-control" name="new_menu_location">
									<option value="<?php echo $menu_location;?>"><?php echo $menu_location;?></option>
									<option value="header">Header</option>
									<option value="footer">Footer</option>
							   </select>
							 </div>
							   
							   <input type="submit" name="update_btn" class="btn btn-sm btn-success"  value="Save Changings" />
							
						 </form>
						<?php } ?>
					</div>
				</div>
		   </div>
		 </div>
           <!-- form end -->
		   
		   <?php
            require_once('parts/db.php');
            if(isset($_POST['update_btn'])){
				
				$new_page_id = $_POST['new_page_id'];
				$new_menu_location = $_POST['new_menu_location'];
				
				$update_menu = "UPDATE menu set page_id='$new_page_id',menu_location='$new_menu_location' WHERE menu_id='$edit_id'";
				
				$run_update_menu = mysqli_query($conn,$update_menu);
				
				if($run_update_menu == true){
					//echo "data is inserted ";
					echo "<script>alert('Menu Updated');</script>";
					echo "<script>window.open('menu_add.php','_self');</script>";
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
