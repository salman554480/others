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

                <div class="row bg-white p-3 custom-shadow mb-3 searhbox">
                    <div class="col-md-12 mb-3">
                        <h1 class="text-center main-title">Website Responsiveness Checker </h1>
                        <form id="urlForm">
                            <input type="text" id="websiteUrl"
                                placeholder="Enter Website URL: e.g., https://example.com" required>
                            <button type="submit">Test Responsiveness</button>
                        </form>
                        <h4 class="text-center py-4" id="websiteName" style="display:none;"></h4>
                    </div>
                </div>
                <div class="ad-area my-4">
                    <?php if ($ad_code_one == "") {
                        echo "<img class='w-100' src='https://dummyimage.com/1400x150/f7f7f7/000000&text=++++++++++++++++Advertisement+++++++++++++'>";
                    } {
                        echo $ad_code_one;
                    } ?>
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
                                    $screen_width = $row_screen['screen_width'];
                                    $screen_height = $row_screen['screen_height'];
                                    $screen_image = $row_screen['screen_image'];

                                ?>
                            <div title="<?php echo $screen_width; ?> x <?php echo $screen_height; ?>"
                                data-toggle="tooltip"
                                onclick="testResponsive(<?php echo $screen_width; ?>, <?php echo $screen_height; ?>)"
                                class="col-lg-2 col-md-2 col-6 mt-4 screen-card p-2">

                                <div class="card border-0 bg-light rounded shadow">
                                    <!-- <img src="admin/upload/<?php echo $screen_image; ?>" class="device-img" alt=""> -->
                                    <span class=" d-block text-center screen-name"><?php echo $screen_name; ?></span>
                                    <span
                                        class="text-muted d-block text-center screen-size"><?php echo $screen_width; ?>
                                        x <?php echo $screen_height; ?></span>

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
    <div class="container">

        <div class="ad-area my-4">
            <?php if ($ad_code_one == "") {
                echo "<img class='w-100' src='https://dummyimage.com/1400x150/a7a7a7/000000&text=++++++++++++++++Advertisement+++++++++++++'>";
            } {
                echo $ad_code_one;
            } ?>
        </div>
    </div>
    <div class="container bg-white py-5">
        <h2 class="text-center">Frequently Asked Questions</h2>
        <div id="faqAccordion" class="my-4">
            <!-- FAQ Item 1 -->
            <?php
            $select_faq = "SELECT * FROM faq";
            $run_faq =  mysqli_query($conn, $select_faq);
            while ($row_faq =  mysqli_fetch_array($run_faq)) {
                $faq_id =  $row_faq['faq_id'];
                $faq_question =  $row_faq['faq_question'];
                $faq_answer =  $row_faq['faq_answer'];
            ?>
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse"
                            data-target="#collapse<?php echo $faq_id; ?>" aria-expanded="true"
                            aria-controls="collapse<?php echo $faq_id; ?>">
                            <?php echo $faq_question; ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?php echo $faq_id; ?>" class="collapse " aria-labelledby="headingOne"
                    data-parent="#faqAccordion">
                    <div class="card-body">
                        <?php echo $faq_answer; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center">Latest Blog</h2>
            <div class="row my-4">
                <!-- Blog Post 1 -->
                <?php

                require_once('admin/parts/db.php');
                $select = "SELECT * FROM post WHERE post_status='publish' ORDER BY post_id DESC LIMIT 3";
                $run = mysqli_query($conn, $select);
                while ($row = mysqli_fetch_array($run)) {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_url = $row['post_url'];

                    $post_thumbnail = $row['post_thumbnail'];
                    $post_content = $row['post_content'];

                    // Remove HTML tags
                    $plain_text = strip_tags($post_content);

                    // Decode HTML entities to their corresponding characters
                    $plain_text = html_entity_decode($plain_text);

                    // Optionally, remove extra whitespace
                    $plain_text = trim(preg_replace('/\s+/', ' ', $plain_text));

                ?>
                <div class="col-md-4 mb-4">
                    <div class="card blog-card">
                        <a href="post_details.php?post_url=<?php echo $post_url; ?>">
                            <img class="card-img-top" src="admin/upload/<?php echo $post_thumbnail; ?>"
                                alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="post_details.php?post_url=<?php echo $post_url; ?>" <h5
                                class="card-title"><?php echo substr($post_title, 0, 60); ?></h5>
                                <?php if (strlen($post_title) > 50) {
                                        echo "...";
                                    } ?>
                            </a>
                            <p class="card-text"><?php echo substr($post_content, 8, 50) ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="d-flex justify-content-center">
                <a href="page.php?page_url=blog" class="btn btn-primary">View More</a>
            </div>
        </div>
    </section>


    <?php require_once('parts/footer.php'); ?>


    <script>
    document.getElementById('urlForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const url = document.getElementById('websiteUrl').value;

        // Validate URL
        if (!url || !isValidURL(url)) {
            alert("Please enter a valid URL.");
            return;
        }

        // Store the URL globally
        window.urlToTest = url;
    });

    function testResponsive(width, height) {
        const url = window.urlToTest;
        if (!url) {
            alert("Please enter a URL first.");
            return;
        }

        // Open a new window with the specified width and height
        const newWindow = window.open(url, '_blank', `width=${width}, height=${height}`);
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