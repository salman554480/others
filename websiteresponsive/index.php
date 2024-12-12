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
                <?php echo $ad_code_one; ?>
                <div class="row bg-white p-3 custom-shadow mb-3 searhbox">
                    <div class="col-md-12 mb-3">
                        <form id="urlForm">
                            <input type="text" id="websiteUrl"
                                placeholder="Enter Website URL: e.g., https://example.com" required>
                            <button type="submit">Test Responsiveness</button>
                        </form>
                        <h4 class="text-center py-4" id="websiteName" style="display:none;"></h4>
                    </div>
                </div>
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
                        <h5 class="mt-5"><?php echo $category_name; ?></h5>

                        <div class="row">
                            <?php

								$select_screen = "SELECT * FROM screen WHERE category_id='$category_id' ORDER BY screen_id DESC ";
								$run_screen = mysqli_query($conn, $select_screen);
								while ($row_screen = mysqli_fetch_array($run_screen)) {

									$screen_id = $row_screen['screen_id'];
									$screen_name = $row_screen['screen_name'];
									$screen_size = $row_screen['screen_size'];
									$screen_image = $row_screen['screen_image'];

								?>
                            <div title="<?php echo $screen_size; ?>" data-toggle="tooltip"
                                onclick="testResponsive(<?php echo $screen_size; ?>)"
                                class="col-lg-2 col-md-2 col-6 mt-4 screen-card">

                                <div class="card border-0 bg-light rounded shadow">
                                    <img src="admin/upload/<?php echo $screen_image; ?>" class="device-img" alt="">
                                    <small
                                        class="text-muted d-block text-center screen-name"><?php echo $screen_name; ?></small>

                                </div>
                            </div>
                            <!--end col-->
                            <?php } ?>
                        </div>


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
        </div>
    </div>


    <?php require_once('parts/footer.php'); ?>


    <script>
    document.getElementById('urlForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const url = document.getElementById('websiteUrl').value;
        document.getElementById('websiteName').style.display = "block";
        document.getElementById('websiteName').innerHTML = url;

        // Validate URL
        if (!url || !isValidURL(url)) {
            alert("Please enter a valid URL.");
            return;
        }

        // Store the URL globally
        window.urlToTest = url;
    });

    function testResponsive(screenWidth) {
        const url = window.urlToTest;
        if (!url) {
            alert("Please enter a URL first.");
            return;
        }

        const newWindow = window.open(url, '_blank', `width=${screenWidth}, height=800`);
        if (newWindow) {
            newWindow.focus();
        } else {
            alert("Unable to open a new window. Please check your browser settings.");
        }
    }

    function isValidURL(url) {
        const pattern = /^(https?:\/\/)?([\w\d\.-]+)\.([a-z\.]{2,6})(\/[\w\d\.-]*)*\/?$/;
        return pattern.test(url);
    }
    </script>

    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>


</body>

</html>