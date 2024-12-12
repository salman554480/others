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
              <h4 class="mb-3">Trash Category</h4>
			     
               	<a href="category_add.php" class="btn btn-sm  btn-outline-danger" >Add Record*</a>
               	<a href="category_view.php" class="btn btn-sm btn-outline-warning " >Record View*</a>
              </div>
            </div>
                    <div class="card mb-3 bg-white">
                            
                            <div class="card-body ">

                    <?php 
						
						require_once('parts/db.php'); 
						
                        if(isset($_GET['del'])){
                            $del_id = $_GET['del'];

						$delete = "UPDATE category SET  category_status='publish' WHERE category_id='$del_id'";
						$run = mysqli_query($conn,$delete);

						if($run === true){
							echo "<script>alert('Publish');</script>";
							  $delete_meta = "UPDATE meta SET meta_status='publish' WHERE meta_source='category' And meta_source_id='$del_id'";
								$run_meta = mysqli_query($conn,$delete_meta);
							echo "<script>window.open('category_trash.php','_self');</script>";
						}else{
							echo "Failed,Try Again";
                            }
                        }
                    
                    ?>

                                <table id="datatablesSimple"  class="table table-hover table-sm table-responsive ">
                                    <thead>
                                        <tr>
                                            <th>Id*</th>
                                            <th>Name*</th>
											<th>URL*</th>
                                            <th>Image*</th>
                                            <th>Meta Title*</th>
                                            <th>Meta Keywords*</th>
                                            <th>Action*</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                         <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM category WHERE category_status='draft' ORDER BY category_id DESC";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$category_id = $row ['category_id'];
								$category_name = $row ['category_name'];
								$category_addedby = $row ['category_addedby'];
								$category_url = $row['category_image'];
								$category_image = $row['category_image'];
								
								$select_meta = "SELECT * FROM meta WHERE meta_status='draft' and meta_source_id='$category_id' and meta_source='category' ";
								$run_meta = mysqli_query($conn,$select_meta);
								$row_meta = mysqli_fetch_array($run_meta);
								
									$meta_title = $row_meta['meta_title'];
									$meta_keywords = $row_meta['meta_keywords'];
									
								
                            ?>
                                        <tr>
                                            <td><?php echo $category_id;?></td>
                                            <td><?php echo $category_name;?></td>
                                            <td><?php echo $category_url;?></td>
                                            <td><img height="40px" src="upload/category/<?php echo $category_image;?>" alt=""></td>
                                            <td><?php echo $meta_title;?></td>
                                            <td><?php echo $meta_keywords;?></td>
											<td>
											<a href="category_trash.php?del=<?php echo $category_id; ?>" class="btn btn-success">Restore</a>
											</td>
                                        </tr>
								<?php  }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
						
                          
                </main>
                <?php require_once('parts/footer.php');?>
            </div>
			   
        </div>
       <!--Footercdn--->
			<?php require_once('parts/footercdn.php');?>

    </body>
</html>
