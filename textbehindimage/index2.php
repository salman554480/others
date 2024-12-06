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
			<div class="col-md-12">
				<img class="w-100 mb-3" src="https://dummyimage.com/1000x80/caccd1/ffffff&text=Ads+Place+1" alt="">
				<div class="row  p-3 ">
					<div class="col-md-12">

						<!-- New Area -->


						<ul class="nav nav-pills nav-justified bg-white p-4 " id="myTab" role="tablist">

							<li class="nav-item">
								<a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#maintab" role="tab" aria-controls="tab1" aria-selected="true">
									<h5>All Tools</h5>
								</a>
							</li>
							<?php
							require_once('admin/parts/db.php');
							$select_homepage_category = "SELECT * FROM category ";
							$run_homepage_category = mysqli_query($conn, $select_homepage_category);
							while ($row_homepage_category = mysqli_fetch_array($run_homepage_category)) {

								$homepage_category_id = $row_homepage_category['category_id'];
								$homepage_category_name = $row_homepage_category['category_name'];
								$homepage_category_url = $row_homepage_category['category_url'];
							?>
								<li class="nav-item">
									<a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab<?php echo $homepage_category_id; ?>" role="tab" aria-controls="tab2" aria-selected="false">
										<h5><?php echo $homepage_category_name; ?></h5>
									</a>
								</li>
							<?php } ?>
							<!-- Add more tabs here -->
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="maintab" role="tabpanel" aria-labelledby="tab1-tab">
								<h3 class="mt-5 text-center">All Tools</h3>

								<div class="row">
									<?php

									$select_tool = "SELECT * FROM tool WHERE tool_status='publish'  ORDER BY tool_views DESC LIMIT 51";
									$run_tool = mysqli_query($conn, $select_tool);
									while ($row_tool = mysqli_fetch_array($run_tool)) {

										$tool_id = $row_tool['tool_id'];
										$tool_name = $row_tool['tool_name'];
										$tool_url = $row_tool['tool_url'];
										$tool_views = $row_tool['tool_views'];

									?>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

											<div class="box-part text-center">

												<i class="fa fa-sun-o fa-3x mb-2" aria-hidden="true"></i>

												<div class="title">
													<h4><?php echo $tool_name; ?></h4>
												</div>

												<div class="text">
													<span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
												</div>

												<a class="card-link" href="tool_details.php?tool_url=<?php echo $tool_url;  ?>">Open Now</a>

											</div>
										</div><!--end col-->
									<?php } ?>
								</div>
								<center><a href="tools.php" class="btn btn-primary my-4">View More <?php echo $navbar_category_name; ?> Tools</a></center>
							</div>
							<?php
							require_once('admin/parts/db.php');
							$select_navbar_category = "SELECT * FROM category ";
							$run_navbar_category = mysqli_query($conn, $select_navbar_category);
							while ($row_navbar_category = mysqli_fetch_array($run_navbar_category)) {

								$navbar_category_id = $row_navbar_category['category_id'];
								$navbar_category_name = $row_navbar_category['category_name'];
								$navbar_category_url = $row_navbar_category['category_url'];
							?>
								<div class="tab-pane fade" id="tab<?php echo $navbar_category_id; ?>" role="tabpanel" aria-labelledby="tab2-tab">
									<h3 class="mt-5 text-center"><?php echo $navbar_category_name; ?> tools</h3>

									<div class="row">
										<?php

										$select_tool = "SELECT * FROM tool WHERE category_id='$navbar_category_id' and tool_status='publish' ORDER BY tool_id DESC LIMIT 51";
										$run_tool = mysqli_query($conn, $select_tool);
										while ($row_tool = mysqli_fetch_array($run_tool)) {

											$tool_id = $row_tool['tool_id'];
											$tool_name = $row_tool['tool_name'];
											$tool_url = $row_tool['tool_url'];
											$tool_views = $row_tool['tool_views'];

										?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

												<div class="box-part text-center">

													<i class="fa fa-sun-o fa-3x mb-2" aria-hidden="true"></i>

													<div class="title">
														<h4><?php echo $tool_name; ?></h4>
													</div>

													<div class="text">
														<span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
													</div>

													<a class="card-link" href="tool_details.php?tool_url=<?php echo $tool_url;  ?>">Open Now</a>

												</div>
											</div><!--end col-->
										<?php } ?>
									</div>
									<center><a href="category.php?category_url=<?php echo $navbar_category_url; ?>" class="btn btn-primary my-4">View More <?php echo $navbar_category_name; ?> Tools</a></center>
								</div>
							<?php } ?>
							<!-- Add more tab content here -->
						</div>



					</div>
				</div>

				<img class="w-100 mt-3" src="https://dummyimage.com/1000x80/caccd1/ffffff&text=Ads+Place+3" alt="">
				<div class="row bg-white p-3 custom-shadow mt-5">
					<div class="col-md-12 ">
						<?php echo $page_content; ?>
					</div>
				</div>



			</div>
		</div>
	</div>


	<?php require_once('parts/footer.php'); ?>

</body>

</html>