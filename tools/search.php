<?php
				require_once('admin/parts/db.php');
				   if(isset($_POST['search'])){
					$keyword = $_POST['search'];

				
				
					
				
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
             <h3>Searched Keyword: <?php echo ucfirst($keyword);?> </h3>
			 <div class="row">
					<?php 
                                
					$select_tool = "SELECT * FROM tool WHERE tool_name LIKE '%$keyword%' and tool_status='publish'  ORDER BY tool_id DESC";
					$run_tool = mysqli_query($conn,$select_tool);
					while( $row_tool = mysqli_fetch_array ($run_tool)){

					$tool_id = $row_tool['tool_id'];
					$tool_name = $row_tool['tool_name'];
					$tool_url = $row_tool['tool_url'];
					$tool_views = $row_tool['tool_views'];
									
					?>
					<div class="col-lg-6 col-md-6 col-12 mt-4 pt-2">
										<a href="tool_details.php?tool_url=<?php echo $tool_url;  ?>">
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

        


      </div>
      <?php require_once('parts/sidebar.php'); ?>
    </div>
  </div>

<?php require_once('parts/footer.php'); ?>
</body>

</html>