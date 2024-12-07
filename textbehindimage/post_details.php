<?php
require_once('admin/parts/db.php');
if (isset($_GET['post_url'])) {
	$post_url = $_GET['post_url'];

	$query = "SELECT * FROM post WHERE post_url = '$post_url'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$post_id = $row['post_id'];
	$post_title = $row['post_title'];
	$post_content = $row['post_content'];
	$post_url = $row['post_url'];
	$post_date = $row['post_date'];
	$post_views = $row['post_views'];
	$dbcategory_id = $row['category_id'];
	$dbpost_thumbnail = $row['post_thumbnail'];

	$select_meta = "SELECT * FROM meta WHERE meta_source='post' and meta_source_id='$post_id'";
	$result_meta = mysqli_query($conn, $select_meta);
	$row_meta = mysqli_fetch_array($result_meta);
	$meta_title = $row_meta['meta_title'];
	$meta_description = $row_meta['meta_description'];
	$meta_keywords = $row_meta['meta_keyword'];

	$updated_views = $post_views + 1;
	$update_views = "UPDATE post SET post_views =  '$updated_views' WHERE post_id='$post_id'";
	$result_update_views = mysqli_query($conn, $update_views);
}
?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

    <?php require_once('parts/navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo $ad_code_one; ?>
                <div class="row bg-white p-3 custom-shadow">
                    <div class="col-md-12">
                        <h1 class="post-title"><?php echo $post_title; ?> </h1>
                        <p><i><?php echo $post_views; ?> Views. Published on: <?php echo $post_date; ?></i></p>
                        <div class="post-content">
                            <?php echo $post_content; ?>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>