<?php
require_once('admin/parts/db.php');
$select_page = "SELECT * FROM page WHERE page='homepage'";
$run_page = mysqli_query($conn, $select_page);
$row_page =  mysqli_fetch_array($run_page);
$page_title =  $row_page['page_title'];
$page_content =  $row_page['page_content'];
$meta_title =  $row_page['meta_title'];
$meta_description =  $row_page['meta_description'];
$meta_keywords =  $row_page['meta_keywords'];

?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

	<?php require_once('parts/navbar.php'); ?>

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<?php echo $ad_code_one; ?>
				<div class="row bg-white p-3 custom-shadow">
					<div class="col-md-12">
						<?php

						require_once('admin/parts/db.php');
						$select_category = "SELECT * FROM category  ORDER BY category_id ASC";
						$run_category = mysqli_query($conn, $select_category);
						while ($row_category = mysqli_fetch_array($run_category)) {

							$category_id = $row_category['category_id'];
							$category_name = $row_category['category_name'];
							$category_url = $row_category['category_url'];

						?>
							<h3 class="mt-5"><?php echo $category_name; ?> tools</h3>

							<div class="row">
								<?php

								$select_tool = "SELECT * FROM tool WHERE category_id='$category_id' and tool_status='publish' ORDER BY tool_id DESC LIMIT 6";
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
													<h5><?php echo $tool_name; ?></h5>
													<div class="mt-3">
														<small class="text-muted d-block"><i class="fa fa-server" aria-hidden="true"></i> Views: <?php echo $tool_views; ?></small>
													</div>


												</div>
											</div>
										</a>
									</div><!--end col-->
								<?php } ?>
							</div>
							<center><a href="category.php?category_url=<?php echo $category_url;?>" class="btn btn-primary my-4">View More <?php echo $category_name;?> Tools</a></center>


						<?php } ?>



					</div>
				</div>

				<?php echo $ad_code_three; ?>
				<div class="row bg-white p-3 custom-shadow mt-5">
					<div class="col-md-12 ">
						<?php echo $page_content; ?>
					</div>
				</div>



			</div>
			<?php require_once('parts/sidebar.php'); ?>
		</div>
	</div>


	<?php require_once('parts/footer.php'); ?>

</body>

</html>