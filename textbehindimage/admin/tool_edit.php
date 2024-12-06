<?php echo require_once('parts/top.php');?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                  <h4 class="mb-3">Edit tool*</h4>
               </div>
            </div>
            <!-- End Page Header -->
            <!-- form start -->
			
			<div class="row">
				<div class="col-md-9">
					<div class="card mb-1" >
					   <div class="card-header">
						  Edit tool Record
					   </div>
					   <?php
						  require_once('parts/db.php');
							 if(isset($_GET['edit'])){
							$edit_id = $_GET['edit'];
						  
						  
						  $select_tool = "SELECT * FROM tool WHERE tool_id='$edit_id'";
						  $run_tool = mysqli_query($conn,$select_tool);
						  $row_tool = mysqli_fetch_array($run_tool);
						  
							$tool_id = $row_tool['tool_id'];
							$dbcategory_id = $row_tool['category_id'];
							$tool_name = $row_tool['tool_name'];
							$tool_url = $row_tool['tool_url'];
							$tool_content = $row_tool['tool_content'];
							$tool_meta_title = $row_tool['tool_meta_title'];
							$tool_meta_keywords = $row_tool['tool_meta_keywords'];
							$tool_meta_description = $row_tool['tool_meta_description'];
							$tool_status = $row_tool['tool_status'];
						  
							 }
						  ?>
					   <div class="card-body" >
						  <form class="row g-3" action="" method="post" enctype="multipart/form-data">
							 <div class="col-md-6">
								<label class="form-label">Title*</label>
								<input type="text" name="tool_name" value="<?php echo $tool_name;?>" class="form-control" autofocus required />
							 </div>
							 <div class="col-md-6">
								<label class="form-label">URL*</label>
								<input type="text" name="tool_url" value="<?php echo $tool_url;?>"  class="form-control"  required />
							 </div>
							 <label class="form-label">Content*</label>
               <div id="editor-container"></div>
        <!-- Hidden textarea to hold content for submission -->
        <textarea id="content" name="content" class="add-new-post__editor mb-1" style="display:none;"></textarea>
							 
							 <div class="col-md-6">
								<label class="form-label">Meta Title*</label>
								<input type="text" name="meta_title" value="<?php echo $tool_meta_title;?>" class="form-control"   />
							 </div>
							 <div class="col-md-6">
								<label class="form-label">Meta Keywords*</label>
								<input type="text" name="meta_keywords" value="<?php echo $tool_meta_keywords;?>"  class="form-control"   />
							 </div>
							 
							 <div class="col-md-12">
								<label class="form-label">Meta Description*</label>
								<textarea name="meta_description"  class="form-control"   ><?php echo $tool_meta_description;?></textarea>
							 </div>
							 
							
							 
					   </div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card mb-1" >
					   <div class="card-header">
						  Edit tool Record
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
							   <select class="form-control" name="tool_status">
									 
									<option value="<?php echo $tool_status;?>"><?php echo $tool_status?></option>
									<option value="publish">Publish</option>
									<option value="draft">Draft</option>
								
							   </select>	
						   </div>
						   
						   <div class="col-md-12 mt-4">
								<input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Update Record" />
							 </div>
						  </form>

						  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
         <script>
    // Initialize Quill editor
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['bold', 'italic', 'underline'],
                ['link'],
                [{ 'align': [] }],
                ['image']
            ]
        }
    });

     // Set existing content from PHP variable ($page_content) into the Quill editor
     var pageContent = <?php echo json_encode($tool_content); ?>;
    
    // Use Quill's dangerouslyPasteHTML method to insert the HTML content
    quill.clipboard.dangerouslyPasteHTML(pageContent);


    // Listen for the text-change event in Quill to update the hidden textarea
   quill.on('text-change', function(delta, oldDelta, source) {
            // Update the hidden textarea with the current HTML content of the editor
            document.querySelector('#content').value = quill.root.innerHTML;
        });
</script>
					   </div>
					</div>
				</div>
			</div>
			
            
            <!-- form end -->
            <?php
               require_once('parts/db.php');
               if(isset($_POST['insert_btn'])){
               
               $ecategory_id = $_POST['category_id'];
               $etool_name = $_POST['tool_name'];
               $etool_url = $_POST['tool_url'];
               $emeta_title = $_POST['meta_title'];
               $etool_content = $_POST['content'];
               $emeta_keywords = $_POST['meta_keywords'];
               $emeta_description = $_POST['meta_description'];
               $etool_status = $_POST['tool_status'];
           	   
			   
			   $etool_content = str_replace("'", "\'", $etool_content); 	
			   $emeta_title = str_replace("'", "\'", $emeta_title); 	
			   $emeta_description = str_replace("'", "\'", $emeta_description); 	 	
               
               
               $update_tool = "UPDATE tool SET category_id='$ecategory_id',tool_name='$etool_name',tool_url='$etool_url',tool_content='$etool_content',tool_meta_title='$etool_name',tool_meta_keywords='$emeta_keywords',tool_meta_description='$emeta_description',tool_status='$etool_status' WHERE tool_id='$edit_id'";
               
               $run_tool = mysqli_query($conn,$update_tool);
               
               if($run_tool == true){
               //echo "data is inserted ";
             echo "<script>alert('Record update');</script>";
              echo "<script>window.open('tool_edit.php?edit=$tool_id','_self');</script>";
               
               
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
