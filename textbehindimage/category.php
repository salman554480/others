<?php
				require_once('admin/parts/db.php');
				   if(isset($_GET['category_url'])){
					$category_url = $_GET['category_url'];

				
				$select_category = "SELECT * FROM category WHERE category_url='$category_url'";
				$run_category = mysqli_query($conn,$select_category);
				$row_category = mysqli_fetch_array($run_category);
				
					$category_id = $row_category['category_id'];
					$category_name = $row_category['category_name'];
					$category_url = $row_category['category_url'];
					$category_content = $row_category['category_content'];
					$meta_title = $row_category['meta_title'];
					$meta_description = $row_category['meta_description'];
					$meta_keywords = $row_category['meta_keywords'];
					
					$count_tool = "SELECT * FROM tool WHERE category_id='$category_id' and tool_status='publish' ORDER BY tool_id DESC";
					$run_count_tool = mysqli_query($conn, $count_tool);
					$total_tool =  mysqli_num_rows($run_count_tool);
				
				   }
			?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

  <?php require_once('parts/navbar.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
	  <?php echo $ad_code_one; ?>
        <div class="row bg-white p-3 custom-shadow">
          <div class="col-md-12">
             <h1><?php echo $total_tool;?> <?php echo $category_name;?> Tools</h1>
			 <div class="row">
					<?php

								$select_tool = "SELECT * FROM tool WHERE category_id='$category_id' ORDER BY tool_id DESC";
								$run_tool = mysqli_query($conn, $select_tool);
								while ($row_tool = mysqli_fetch_array($run_tool)) {

									$tool_id = $row_tool['tool_id'];
									$tool_name = $row_tool['tool_name'];
									$tool_url = $row_tool['tool_url'];
									$tool_views = $row_tool['tool_views'];

								?>
									<div class="col-lg-6 col-md-6 col-12 mt-4 pt-2">
										<a href="<?php echo $base_url;?>/tool_details.php?tool_url=<?php echo $tool_url;  ?>">
											<div class="card border-0 bg-light rounded shadow">
												<div class="card-body p-4">
													<h5 class="text-bold"><?php echo $tool_name; ?></h5>
													<div class="mt-3">
														<small class="text-muted d-block"><i class="fa fa-server" aria-hidden="true"></i> Views: <?php echo $tool_views; ?></small>
													</div>


												</div>
											</div>
										</a>
									</div><!--end col-->
								<?php } ?>
				</div>
          </div>
        </div>

		<div class="row bg-white p-3 custom-shadow mt-5">
			<div class="col-md-12 ">
				<?php echo $category_content;?>
			</div>
		 </div>
        


      </div>
      <?php require_once('parts/sidebar.php'); ?>
    </div>
  </div>

<?php require_once('parts/footer.php'); ?>
</body>

</html>