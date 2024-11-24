<nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <a class="navbar-brand" href="<?php echo $website_url; ?>"><?php echo $website_title; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url; ?>">Home</a>
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
                    <a class="nav-link" href="<?php echo $base_url; ?>/<?php echo $header_page_url; ?>"><?php echo $header_page_title; ?></a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url; ?>/admin/login.php">Admin Login</a>
            </li>
        </ul>
    </div>
</nav>