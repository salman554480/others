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
				<div class="row bg-white p-3 custom-shadow">
					<div class="col-md-12">
						<div id="tool-list">
							<!-- Tool data will be displayed here -->
						</div>
						<div id="loader" style="display: none;">
							<!-- Loader or loading message here -->
						</div>
					</div>
				</div>

				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				<script>
					$(document).ready(function() {
						var limit = 10; // Number of items to load at a time
						var offset = 0; // Initial offset

						// Function to load more data
						function loadMoreData() {
							$('#loader').show(); // Display loader

							$.ajax({
								url: 'load_data.php', // PHP script to fetch data
								method: 'POST',
								data: {
									limit: limit,
									offset: offset
								},
								dataType: 'html',
								success: function(data) {
									if (data.trim() === '') {
										$('#loader').html('No more data to load.');
									} else {
										$('#tool-list').append(data); // Append data to the container
										offset += limit; // Increment offset
										$('#loader').hide(); // Hide loader
									}
								}
							});
						}

						// Initial load
						loadMoreData();

						// Scroll event handler
						$(window).scroll(function() {
							if ($(window).scrollTop() + $(window).height() >= $('#tool-list').height() - 100) {
								// Load more data when user is near the bottom
								loadMoreData();
							}
						});
					});
				</script>


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