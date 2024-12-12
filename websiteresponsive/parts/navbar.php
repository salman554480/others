<nav class="navbar navbar-expand-md bg-dark navbar-dark">
	<div class="container">
		<a class="navbar-brand" href="<?php echo $base_url; ?>">
			<?php if ($website_logo == "") {
				echo $website_title;
			} else {
				echo "<img src='admin/upload/$website_logo' height='30px'>";
			} ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav mr-auto">
				<!-- Dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						Home Demo
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="index.php">Home 1</a>
						<a class="dropdown-item" href="index2.php">Home 2</a>
					</div>
				</li>
				<!-- Dropdown -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						Categories
					</a>
					<div class="dropdown-menu">
						<?php
						require_once('admin/parts/db.php');
						$select_navbar_category = "SELECT * FROM category ";
						$run_navbar_category = mysqli_query($conn, $select_navbar_category);
						while ($row_navbar_category = mysqli_fetch_array($run_navbar_category)) {

							$navbar_category_id = $row_navbar_category['category_id'];
							$navbar_category_name = $row_navbar_category['category_name'];
							$navbar_category_url = $row_navbar_category['category_url'];
						?>
							<a class="dropdown-item"
								href="category.php?category_url=<?php echo $navbar_category_url; ?>"><?php echo $navbar_category_name; ?></a>
						<?php } ?>
					</div>
				</li>
				<?php
				require_once('admin/parts/db.php');
				$select_menu_header = "SELECT * FROM menu WHERE menu_location='header'";
				$run_menu_header = mysqli_query($conn, $select_menu_header);
				while ($row_menu_header = mysqli_fetch_array($run_menu_header)) {

					$page_id_header = $row_menu_header['page_id'];


					$select_page = "SELECT * FROM page WHERE page_id='$page_id_header' ";
					$run_page = mysqli_query($conn, $select_page);
					$row_page = mysqli_fetch_array($run_page);
					$header_page_title =  $row_page['page_title'];
					$header_page_url =  $row_page['page_url'];
				?>
					<li class="nav-item">
						<a class="nav-link"
							href="<?php echo $base_url; ?>/page.php?page_url=<?php echo $header_page_url; ?>"><?php echo $header_page_title; ?></a>
					</li>
				<?php } ?>
				<!--<li class="nav-item">
						<a class="nav-link" href="<?php echo $base_url; ?>/tools.php">All Tools</a>
					</li>-->
			</ul>
			<form action="search.php" method="post" class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search"
					aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</div>
</nav>
<br>