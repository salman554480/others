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

	<div class="container-fluid bg-white">
		<div class="container hero-section">
			<div class="row">
				<div class="col-md-5">
					<h1 class="hero-heading">Create Text Behind Image</h1>
					<p class="hero-text">Create stunning text-behind-image effects in seconds. No design skills needed.
					</p>
					<a href="starter.php" class="btn btn-success">Create Now</a>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-6">
					<div class="before-after-container">
						<div class="before" style="background-image: url('assets/img/img2.jpg');"></div>
						<div class="after" style="background-image: url('assets/img/img1.jpg');"></div>
						<div class="slider" id="slider"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<script>
		// Add the event listener to the slider for mouse interaction
		const slider = document.getElementById('slider');
		const beforeImage = document.querySelector('.before');
		const afterImage = document.querySelector('.after');

		let isDragging = false;

		slider.addEventListener('mousedown', (e) => {
			isDragging = true;
			document.body.style.userSelect = 'none'; // Disable text selection while dragging
		});

		document.addEventListener('mousemove', (e) => {
			if (isDragging) {
				let containerRect = slider.parentElement.getBoundingClientRect();
				let offsetX = e.clientX - containerRect.left;
				let width = Math.min(Math.max(0, offsetX), containerRect.width);
				afterImage.style.width = width + 'px';
				slider.style.left = width + 'px';
			}
		});

		document.addEventListener('mouseup', () => {
			isDragging = false;
			document.body.style.userSelect = 'auto'; // Re-enable text selection
		});
	</script>
	<div class="container gallery py-5">
		<div class="masonry-list">
			<img src="assets/img/uc1.webp" alt="">
			<img src="assets/img/uc2.webp" alt="">
			<img src="assets/img/uc3.webp" alt="">
			<img src="assets/img/uc4.webp" alt="">
			<img src="assets/img/uc5.webp" alt="">
			<img src="assets/img/uc6.webp" alt="">
			<img src="assets/img/uc7.webp" alt="">
			<img src="assets/img/uc8.webp" alt="">
			<img src="assets/img/uc9.webp" alt="">
			<img src="assets/img/uc10.webp" alt="">
		</div>

	</div>

	<div class="container py-5">
		<h2 class="text-center">Frequently Asked Questions</h2>
		<div id="faqAccordion" class="my-4">
			<!-- FAQ Item 1 -->
			<div class="card">
				<div class="card-header" id="headingOne">
					<h5 class="mb-0">
						<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
							aria-expanded="true" aria-controls="collapseOne">
							What is Bootstrap 4?
						</button>
					</h5>
				</div>

				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
					<div class="card-body">
						Bootstrap 4 is a front-end framework that helps you design responsive and mobile-first websites
						easily. It includes pre-styled components like navigation bars, forms, modals, and more.
					</div>
				</div>
			</div>

			<!-- FAQ Item 2 -->
			<div class="card">
				<div class="card-header" id="headingTwo">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
							aria-expanded="false" aria-controls="collapseTwo">
							How do I use Bootstrap Grid System?
						</button>
					</h5>
				</div>

				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
					<div class="card-body">
						Bootstrap's grid system allows you to create responsive layouts by using a 12-column layout
						structure. You can customize the grid by using classes such as `col-lg-4`, `col-md-6`, etc.,
						depending on the screen size.
					</div>
				</div>
			</div>

			<!-- FAQ Item 3 -->
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
							aria-expanded="false" aria-controls="collapseThree">
							Is Bootstrap free to use?
						</button>
					</h5>
				</div>

				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
					<div class="card-body">
						Yes, Bootstrap is open-source and free to use. You can download it from the official website and
						integrate it into your projects without any cost.
					</div>
				</div>
			</div>

			<!-- FAQ Item 4 -->
			<div class="card">
				<div class="card-header" id="headingFour">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
							aria-expanded="false" aria-controls="collapseFour">
							What are Bootstrap's key features?
						</button>
					</h5>
				</div>

				<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
					<div class="card-body">
						Bootstrap offers responsive grid layout, pre-styled components like buttons, forms, and navbars,
						as well as built-in JavaScript plugins for features such as modals, tooltips, and carousels.
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php require_once('parts/footer.php'); ?>

</body>

</html>