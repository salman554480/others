<?php require_once('parts/top.php');?>
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
<?php echo require_once('parts/top.php');?>
    </head>
    <body class="sb-nav-fixed">
       
	   <?php require_once('parts/navbar.php');?>
	   
        <div id="layoutSidenav">
           
	<?php require_once('parts/sidebar.php');?>
	
            <div id="layoutSidenav_content">
                <main>
              <div class="main-content-container container-fluid px-4">
            <!-- category Header -->
			  
            <div class="category-header ">
              <div class="col-12 mt-4  mb-4 ">
              <h4 class="mb-3">Edit Category</h4>			     
               	 	
              </div>
            </div>
            <!-- End category Header -->
			
			<!-- form start -->
          	 <div class="card mb-1" >
		 
		 <div class="card-header">
		    Edit Category Record
		 </div>
			
			<?php
				require_once('parts/db.php');
				   if(isset($_GET['edit'])){
					$edit_id = $_GET['edit'];

				$select_category = "SELECT * FROM category WHERE category_id='$edit_id'";
				$run_category = mysqli_query($conn,$select_category);
				$row_category = mysqli_fetch_array($run_category);
				
					$category_id = $row_category['category_id'];
					$category_name = $row_category['category_name'];
					$category_url = $row_category['category_url'];
					$category_content = $row_category['category_content'];
					$meta_title = $row_category['meta_title'];
					$meta_description = $row_category['meta_description'];
					$meta_keywords = $row_category['meta_keywords'];
				
				   }
			?>
			
			
		 <div class="card-body" >
         <form class="row g-3" action="" method="post" enctype="multipart/form-data">
		 
            <div class="col-md-6">
               <label class="form-label">Title*</label>
               <input type="text" name="category_name" id="category_name" value="<?php echo $category_name;?>" class="form-control" autofocus required />
            </div>
			
            <div class="col-md-6">
               <label class="form-label">URL*</label>
               <input type="text" name="category_url" id="category_url" value="<?php echo $category_url;?>" class="form-control" required />
            </div>
			
			<div class="col-md-12">
               <label class="form-label">Content*</label>
                 <textarea id="mytextarea" type="text" name="category_content" class="add-new-post__editor mb-1"><?php echo $category_content;?></textarea>
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Meta Title*</label>
               <input type="text" name="meta_title" value="<?php echo $meta_title;?>" class="form-control"  required />
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Meta Keywords*</label>
               <input type="text" name="meta_keywords" value="<?php echo $meta_keywords;?>" class="form-control">
            </div>
            
			<div class="col-md-12">
               <label class="form-label">Meta Description*</label>
               <textarea  name="meta_description" class="form-control"><?php echo $meta_description;?></textarea>
            </div>
            <br><br>
			<div class="col-md-12">
               
               <input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Update Record" />
            </div>
			
         </form>
		 <script>
    // Function to generate a slug from a string
    function generateSlug(title) {
        return title
            .toLowerCase()           // Convert to lowercase
            .replace(/\s+/g, '-')    // Replace spaces with dashes
            .replace(/[^a-z0-9-]/g, '') // Remove non-alphanumeric characters and dashes
            .replace(/--+/g, '-');   // Replace multiple dashes with a single dash
    }

    // Get references to the title and URL input fields
    const titleInput = document.getElementById('category_name');
    const urlInput = document.getElementById('category_url');

    // Add event listener to the title input field
    titleInput.addEventListener('input', function() {
        const titleValue = titleInput.value;
        const slug = generateSlug(titleValue);
        urlInput.value = slug;
    });
</script>
		 
		   </div>
		 </div>
           <!-- form end -->
		   
		   <?php
            require_once('parts/db.php');
            if(isset($_POST['insert_btn'])){
				
				$ecategory_name = $_POST['category_name'];
				$category_url = $_POST['category_url'];
				$ecategory_content = $_POST['category_content'];
				$emeta_title = $_POST['meta_title'];
				$emeta_description = $_POST['meta_description'];
				$emeta_keywords = $_POST['meta_keywords'];
					
				$ecategory_content = str_replace("'", "\'", $ecategory_content); 	
				$emeta_title = str_replace("'", "\'", $emeta_title); 	
				$emeta_description = str_replace("'", "\'", $emeta_description); 	
               
				
				$update_category = "UPDATE category SET category_name='$ecategory_name',category_url='$category_url',category_content='$ecategory_content',meta_title='$emeta_title',meta_description='$emeta_description',meta_keywords='$emeta_keywords' WHERE category_id='$edit_id'";
				
				$run_category = mysqli_query($conn,$update_category);
				
				if($run_category == true){
					echo "<script>alert('Record update');</script>";
					echo "<script>window.open('category_edit.php?edit=$category_id','_self');</script>";
					
					
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
