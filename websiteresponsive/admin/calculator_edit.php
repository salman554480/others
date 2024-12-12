<?php echo require_once('parts/top.php');?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
   	selector: '#mytextarea',
   	plugins: [
   		'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
   		'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
   		'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
   	],
   	toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
   		'alignleft aligncenter alignright alignjustify | ' +
   		'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
   });
</script>
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
                  <h4 class="mb-3">Edit calculator*</h4>
               </div>
            </div>
            <!-- End Page Header -->
            <!-- form start -->
			
			<div class="row">
				<div class="col-md-9">
					<div class="card mb-1" >
					   <div class="card-header">
						  Edit calculator Record
					   </div>
					   <?php
						  require_once('parts/db.php');
							 if(isset($_GET['edit'])){
							$edit_id = $_GET['edit'];
						  
						  
						  $select_calculator = "SELECT * FROM calculator WHERE calculator_id='$edit_id'";
						  $run_calculator = mysqli_query($conn,$select_calculator);
						  $row_calculator = mysqli_fetch_array($run_calculator);
						  
							$calculator_id = $row_calculator['calculator_id'];
							$dbcategory_id = $row_calculator['category_id'];
							$calculator_title = $row_calculator['calculator_title'];
							$calculator_url = $row_calculator['calculator_url'];
							$calculator_code = $row_calculator['calculator_code'];
							$calculator_content = $row_calculator['calculator_content'];
							$calculator_meta_title = $row_calculator['calculator_meta_title'];
							$calculator_meta_keywords = $row_calculator['calculator_meta_keywords'];
							$calculator_meta_description = $row_calculator['calculator_meta_description'];
							$calculator_status = $row_calculator['calculator_status'];
						  
							 }
						  ?>
					   <div class="card-body" >
						  <form class="row g-3" action="" method="post" enctype="multipart/form-data">
							 <div class="col-md-6">
								<label class="form-label">Title*</label>
								<input type="text" name="calculator_title" value="<?php echo $calculator_title;?>" class="form-control" autofocus required />
							 </div>
							 <div class="col-md-6">
								<label class="form-label">URL*</label>
								<input type="text" name="calculator_url" value="<?php echo $calculator_url;?>"  class="form-control"  required />
							 </div>
							 <div class="col-md-12">
								<label class="form-label">Content*</label>
								 <textarea id="mytextarea" type="text" name="calculator_content" class="add-new-post__editor mb-1"><?php echo $calculator_content;?></textarea>
							 </div>
							 
							 <div class="col-md-6">
								<label class="form-label">Meta Title*</label>
								<input type="text" name="meta_title" value="<?php echo $calculator_meta_title;?>" class="form-control"   />
							 </div>
							 <div class="col-md-6">
								<label class="form-label">Meta Keywords*</label>
								<input type="text" name="meta_keywords" value="<?php echo $calculator_meta_keywords;?>"  class="form-control"   />
							 </div>
							 
							 <div class="col-md-12">
								<label class="form-label">Meta Description*</label>
								<textarea name="meta_description"  class="form-control"   ><?php echo $calculator_meta_description;?></textarea>
							 </div>
							 
							 <div class="col-md-12">
								<label class="form-label">Code*</label>
								<textarea id=""   name="calculator_code" class="form-control"><?php echo $calculator_code; ?></textarea>
							 </div>
							 
					   </div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card mb-1" >
					   <div class="card-header">
						  Edit calculator Record
					   </div>
					   
					   <div class="card-body">
						   <div class="form-group">
							   <label>Select Category</label>	
							   <select class="form-control" name="category_id">
									 <?php 
                                
                              	require_once('parts/db.php'); 
                                $select = "SELECT * FROM category ";
                                $run = mysqli_query($conn,$select);
                                while( $row = mysqli_fetch_array ($run)){

								$category_id = $row ['category_id'];
								$category_name = $row ['category_name'];
								?>
									<option <?php if($category_id == $dbcategory_id ){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_name;?></option>
								<?php } ?>	
							   </select>	
						   </div>
						   
						   
						   <div class="form-group mt-4">
							   <label>Status</label>	
							   <select class="form-control" name="calculator_status">
									 
									<option value="<?php echo $calculator_status;?>"><?php echo $calculator_status?></option>
									<option value="publish">Publish</option>
									<option value="draft">Draft</option>
								
							   </select>	
						   </div>
						   
						   <div class="col-md-12 mt-4">
								<input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Update Record" />
							 </div>
						  </form>
					   </div>
					</div>
				</div>
			</div>
			
            
            <!-- form end -->
            <?php
               require_once('parts/db.php');
               if(isset($_POST['insert_btn'])){
               
               $ecategory_id = $_POST['category_id'];
               $ecalculator_title = $_POST['calculator_title'];
               $ecalculator_url = $_POST['calculator_url'];
               $ecalculator_content = $_POST['calculator_content'];
               $emeta_title = $_POST['meta_title'];
               $emeta_keywords = $_POST['meta_keywords'];
               $emeta_description = $_POST['meta_description'];
               $ecalculator_status = $_POST['calculator_status'];
               $ecalculator_code = mysqli_real_escape_string($conn,$_POST['calculator_code']);
			   
			   
			   $ecalculator_content = str_replace("'", "\'", $ecalculator_content); 	
			   $emeta_title = str_replace("'", "\'", $emeta_title); 	
			   $emeta_description = str_replace("'", "\'", $emeta_description); 	 	
               
               
               $update_calculator = "UPDATE calculator SET category_id='$ecategory_id',calculator_title='$ecalculator_title',calculator_url='$ecalculator_url',calculator_content='$ecalculator_content',calculator_meta_title='$ecalculator_title',calculator_meta_keywords='$emeta_keywords',calculator_meta_description='$emeta_description' WHERE calculator_id='$edit_id'";
               
               $run_calculator = mysqli_query($conn,$update_calculator);
               
               if($run_calculator == true){
               //echo "data is inserted ";
               echo "<script>alert('Record update');</script>";
               echo "<script>window.open('calculator_edit.php?edit=$calculator_id','_self');</script>";
               
               
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
