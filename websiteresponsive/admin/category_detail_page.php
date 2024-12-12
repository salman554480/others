<?php require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php  require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php  require_once('parts/sidebar.php');?>
	
            <div id="layoutSidenav_content" class="">
                <main class="">
                    <div class="container-fluid  px-4">
                         
            <div class="page-header">
              <div class="col-12 mt-4  mb-4">
              <h4 class="mb-3">Category Detail</h4>
			    <a href="category_add.php" class="btn  btn-sm  btn-outline-primary" >Add Record*</a>
               	<a href="category_view.php" class="btn  btn-sm  btn-outline-danger" >View Record*</a>
               	<a href="category_trash.php" class="btn  btn-sm  btn-outline-success" >Trash Record*</a>
              </div>
            </div>
                       <!-- Default Light Table -->
            <div class="row">

            
            <?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['detail_page'])){
                            $detail_page = $_GET['detail_page'];

						$select_detail_page = "SELECT * FROM category WHERE category_status='publish' and category_id='$detail_page'";
						$run = mysqli_query($conn,$select_detail_page);
                        $row = mysqli_fetch_array($run);

							$category_id = $row ['category_id'];
							$category_name = $row ['category_name'];
							$category_addedby = $row ['category_addedby'];
							$category_url = $row['category_url'];
							$category_image = $row['category_image'];
							$category_date = $row['category_date'];
							$category_status = $row['category_status'];
					
							
                        $select_media = "SELECT * FROM media WHERE media_id='$category_image'";
                        $run_media = mysqli_query ($conn,$select_media);
                        $row_media = mysqli_fetch_array ($run_media);

                            $media_image = $row_media['media_image'];
                            $media_alt = $row_media['media_alt'];
                            $media_title = $row_media['media_title'];
                            $media_description = $row_media['media_description'];
							
						$select_admin = "SELECT * FROM admin WHERE admin_id='$category_addedby'";
						$run_admin = mysqli_query($conn,$select_admin);
						$row_admin = mysqli_fetch_array($run_admin);
						
							$admin_name = $row_admin['admin_name'];
							
						$select_meta = "SELECT * FROM meta WHERE meta_status='publish' and meta_source_id='$category_id' and meta_source='category' ";
						$run_meta = mysqli_query($conn,$select_meta);
						$row_meta = mysqli_fetch_array($run_meta);
								
							$meta_title = $row_meta['meta_title'];
							$meta_keywords = $row_meta['meta_keywords'];
							$meta_description = $row_meta['meta_description'];
							$meta_schema = $row_meta['meta_schema'];
									
                        }
                    
                    ?>

              <div class="col-lg-8">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Category Details</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col-sm-12">
                          <label  class="form-label">Name*</label>
                          <input type="text" class="form-control form-control-sm" value="<?php echo $category_name;?>" >
                        </div>
                        <div class="col-sm-6">
                        <label  class="form-label mt-1">URL*</label>
                          <input type="text" class="form-control form-control-sm" value="<?php echo $category_url;?>" >
                        </div>
                        <div class="col-sm-6">
                        <label  class="form-label mt-1">Date*</label>
                          <input type="text" class="form-control form-control-sm" value="<?php echo $category_date;?>" >
                        </div>
                        <div class="col-sm-6">
                        <label  class="form-label mt-1">Status*</label>
                          <input type="text" class="form-control form-control-sm" value="<?php echo $category_status;?>" >
                        </div>  
                        <div class="col-sm-6">
                        <label  class="form-label mt-1">Addedby*</label>
                          <input type="text" class=" form-control form-control-sm" value="<?php echo $admin_name;?>" >
                        </div>
                        <div class="col-sm-6">
                        <label  class="form-label mt-1">Meta_Tital*</label>
                        <input type="text" class="form-control form-control-sm" value="<?php echo $meta_title;?>" >
                        </div>
						<div class="col-sm-6">
                        <label  class="form-label mt-1">Meta_Keyword*</label>
                        <input type="text" class="form-control form-control-sm" value="<?php echo $meta_keywords;?>" >
                        </div>
						<div class="col-sm-6">
                        <label  class="form-label mt-1">Meta_Description*</label>
                        <textarea  class="form-control form-control-sm"><?php echo $meta_description;?></textarea>
                        </div>
						<div class="col-sm-6">
                        <label  class="form-label mt-1">Meta_Schema*</label>
                        <textarea  class="form-control form-control-sm"><?php echo $meta_schema;?></textarea>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-small mb-3">
                  <div class="card-header border-bottom">
                    <div class=""><h5 class="m-0"><?php echo $media_title;?></h5></div>
                  
                  </div>
                  <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item p-3">
					
                      <img class="img-thumbnail" src="upload/media/<?php echo $media_image;?>" alt="<?php echo $media_alt;?>" width="310">
                      <strong class="text-muted d-block mt-2">Description</strong>
                      <span><?php echo $media_description;?></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->	      
                </main>
                <?php require_once('parts/footer.php');?>
            </div>
			   
        </div>
       <!--Footercdn--->
			<?php require_once('parts/footercdn.php');?>

    </body>
</html>
