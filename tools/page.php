<?php
require_once('admin/parts/db.php');
if (isset($_GET['page_url'])) {
    $page_url = $_GET['page_url'];
    $select_page = "SELECT * FROM page WHERE page_url='$page_url'";
    $run_page = mysqli_query($conn, $select_page);
    $row_page =  mysqli_fetch_array($run_page);
    $get_page_title =  $row_page['page_title'];
    $get_page_content =  $row_page['page_content'];
    $page_title = $row_page['page_title'];
    $page_url = $row_page['page_url'];
    $page_content = $row_page['page_content'];
    $meta_title = $row_page['meta_title'];
    $meta_description = $row_page['meta_description'];
    $meta_keywords = $row_page['meta_keywords'];
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
                        <h1><?php echo $get_page_title ?></h1>
                        <div class="content-area">
                            <?php if ($page_url == "blog") { ?>
                                <div class="row">
                                    <!-- Blog Post 1 -->
                                    <?php

                                    require_once('admin/parts/db.php');
                                    $select = "SELECT * FROM post WHERE post_status='publish' ORDER BY post_id DESC";
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
                                        <div class="col-md-6 mb-4">
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

                            <?php } ?>
                            <?php if ($page_url == "contact-us") { ?>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="user_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="user_email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" name="user_message" rows="4"
                                            required></textarea>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <?php

                                // Check if form is submitted
                                if (isset($_POST['submit'])) {
                                    // Get the form data
                                    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
                                    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
                                    $user_message = mysqli_real_escape_string($conn, $_POST['user_message']);

                                    // Insert query
                                    $sql = "INSERT INTO contactform (user_name, user_email, user_message) 
                                    VALUES ('$user_name', '$user_email', '$user_message')";

                                    // Check if the query is successful
                                    if ($conn->query($sql) === TRUE) {
                                        echo "Message sent successfully!";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                }

                                ?>

                            <?php } else { ?>
                                <?php echo $get_page_content; ?>
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