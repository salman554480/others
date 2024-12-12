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
            <ul class="navbar-nav ml-auto">
                <!-- Dropdown -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url; ?>">
                        Home</a>
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
        </div>
    </div>
</nav>
<br>