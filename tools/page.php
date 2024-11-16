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

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                            <?php

								// Check if form is submitted
								if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

								// Close connection
								$conn->close();
								?>

                            <?php } ?>
                            <?php echo $get_page_content; ?>
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