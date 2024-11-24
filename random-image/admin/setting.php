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
              <h4 class="mb-3">Edit Setting</h4>			     
               	 	
              </div>
            </div>
            <!-- End Page Header -->
			
			<!-- form start -->
          	 <div class="card mb-1" >
		 
		 <div class="card-header">
		    Edit setting Record
		 </div>
			
			
			
			
		 <div class="card-body" >
         <form class="row g-3" action="" method="post" enctype="multipart/form-data">
		 
            <div class="col-md-6">
               <label class="form-label">Website Title</label>
               <input type="text" name="website_title" value="<?php echo $website_title;?>" class="form-control" autofocus required />
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Website URL*</label>
               <input type="url" name="website_url" value="<?php echo $website_url;?>" class="form-control"  required />
			   <small>Please Use / at the End of the URL</small>
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Website Logo*</label>
               <input type="file" name="website_logo"  class="form-control" >
			   <img src="upload/<?php echo $website_logo;?>" height="50px">
            </div>
			
			<div class="col-md-6">
               <label class="form-label">Website Favicon*</label>
               <input type="file" name="website_favicon" class="form-control" >
			   <img src="upload/<?php echo $website_favicon;?>" height="50px">
            </div>
			
			<div class="col-md-12">
               <label class="form-label">Place Your Head Tag Code Here</label>
               <textarea id="" rows="5"  name="website_head_code" class="form-control"><?php echo $website_head_code; ?></textarea>
            </div>
            
			<br>
			<div class="col-md-4">
               <label class="form-label">Ad Code 1</label>
               <textarea id="" rows="5"  name="ad_code_one" class="form-control"><?php echo $ad_code_one; ?></textarea>
		    </div>

			<div class="col-md-4">
               <label class="form-label">Ad Code 2</label>
               <textarea id="" rows="5"  name="ad_code_two" class="form-control"><?php echo $ad_code_two; ?></textarea>
		    </div>

			<div class="col-md-4">
               <label class="form-label">Ad Code 3</label>
               <textarea id="" rows="5"  name="ad_code_three" class="form-control"><?php echo $ad_code_three; ?></textarea>
		    </div>			
			<hr>
			
			<h4>Footer Section</h4>
			
		    <div class="col-md-12">
               <label class="form-label">Footer Text</label>
               <input type="text" name="footer_text" value="<?php echo $footer_text;?>" class="form-control"  required />
            </div>
			
			<label for="basic-url">Social Media Profiles</label>
			<div class="input-group mb-2">
			  <div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon3">facebook.com/</span>
			  </div>
			  <input type="text" class="form-control" value="<?php echo $facebook;?>" name="facebook" id="basic-url" aria-describedby="basic-addon3">
			</div>
			<div class="input-group mb-2">
			  <div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon3">twitter.com/</span>
			  </div>
			  <input type="text" class="form-control" value="<?php echo $twitter;?>" name="twitter" id="basic-url" aria-describedby="basic-addon3">
			</div>
			<div class="input-group mb-2">
			  <div class="input-group-prepend">
				<span class="input-group-text"  id="basic-addon3">instagram.com/</span>
			  </div>
			  <input type="text" class="form-control" value="<?php echo $instagram;?>" name="instagram"  id="basic-url" aria-describedby="basic-addon3">
			</div>
			<div class="input-group mb-2">
			  <div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon3">pinterest.com/</span>
			  </div>
			  <input type="text" class="form-control" value="<?php echo $pinterest;?>" name="pinterest" id="basic-url" aria-describedby="basic-addon3">
			</div>
			
			<br>
			<div class="col-md-12">
               
               <input type="submit" name="insert_btn" class="btn btn-sm btn-success"  value="Update Record" />
            </div>
			
         </form>
		   </div>
		 </div>
           <!-- form end -->
		   
		   <?php
            require_once('parts/db.php');
            if(isset($_POST['insert_btn'])){
				
				$ewebsite_title = $_POST['website_title'];
				$ewebsite_url = $_POST['website_url'];
				
				$ead_code_one = $_POST['ad_code_one'];
				$ead_code_two = $_POST['ad_code_two'];
				$ead_code_three = $_POST['ad_code_three'];
				
				$efooter_text = $_POST['footer_text'];
				$efacebook = $_POST['facebook'];
				$etwitter = $_POST['twitter'];
				$einstagram = $_POST['instagram'];
				$epinterest = $_POST['pinterest'];
				
				$ewebsite_head_code = mysqli_real_escape_string($conn,$_POST['website_head_code']);
				
				$ewebsite_logo = $_FILES['website_logo']['name'];
				$ewebsite_logo_tmp_name = $_FILES['website_logo']['tmp_name'];
				
				$ewebsite_favicon = $_FILES['website_favicon']['name'];
				$ewebsite_favicon_tmp_name = $_FILES['website_favicon']['tmp_name'];
				
				
					if($ewebsite_logo ==  ""){$ewebsite_logo = $website_logo;}
					if($ewebsite_favicon ==  ""){$ewebsite_favicon = $website_favicon;}
				
				
				$update_setting = "UPDATE setting SET 
				website_title='$ewebsite_title',
				website_url='$ewebsite_url',
				website_logo='$ewebsite_logo',
				website_favicon='$ewebsite_favicon',
				website_head_code='$ewebsite_head_code',
				footer_text='$efooter_text',
				facebook='$efacebook',
				twitter='$etwitter',
				instagram='$einstagram',
				pinterest='$epinterest',
				ad_code_one='$ead_code_one',
				ad_code_two='$ead_code_two',
				ad_code_three='$ead_code_three'";
				
				$run_setting = mysqli_query($conn,$update_setting);
				
				if($run_setting == true){
					//echo "data is inserted ";
					move_uploaded_file($ewebsite_logo_tmp_name,"upload/$ewebsite_logo");
					move_uploaded_file($ewebsite_favicon_tmp_name,"upload/$ewebsite_favicon");
					echo "<script>alert('Record update');</script>";
					echo "<script>window.open('setting.php','_self');</script>";
					
					
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
