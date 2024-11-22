<?php
require_once('parts/db.php');
if (isset($_GET['post_url'])) {
    $post_url = $_GET['post_url'];
    $select_post = "SELECT * From post WHERE post_url='$post_url'";
    $result_post = mysqli_query($conn, $select_post);
    $row_post = mysqli_fetch_array($result_post);
    $user_id = $row_post['user_id'];
    $post_id = $row_post['post_id'];
    $post_title = $row_post['post_title'];
    $post_url = $row_post['post_url'];
    $post_views = $row_post['post_views'];
    $dbcategory_id = $row_post['category_id'];
    $dbsubcategory_id = $row_post['subcategory_id'];
    $post_tags = $row_post['post_tags'];
    $post_date = $row_post['post_date'];
    $post_words = $row_post['post_words'];
    $post_read_time = $row_post['post_read_time'];
    $post_content = $row_post['post_content'];
    $post_thumbnail = $row_post['post_thumbnail'];
    $post_status = $row_post['post_status'];

    $post_date = date("F j, Y", strtotime($post_date));

    $select_meta = "SELECT * FROM meta WHERE meta_source='post' and meta_source_id='$post_id'";
    $result_meta = mysqli_query($conn, $select_meta);
    $row_meta = mysqli_fetch_array($result_meta);
    $meta_title = $row_meta['meta_title'];
    $meta_description = $row_meta['meta_description'];
    $meta_keyword = $row_meta['meta_keyword'];

    $select_category = "SELECT * FROM category WHERE category_id='$dbcategory_id'";
    $result_category = mysqli_query($conn, $select_category);
    $row_category = mysqli_fetch_array($result_category);
    $dbcategory_name = $row_category['category_name'];

    $select_subcategory = "SELECT * FROM subcategory WHERE subcategory_id='$dbsubcategory_id'";
    $result_subcategory = mysqli_query($conn, $select_subcategory);
    $row_subcategory = mysqli_fetch_array($result_subcategory);
    $dbsubcategory_name = $row_subcategory['subcategory_name'];

    $select_user = "SELECT * FROM user WHERE user_id='$user_id'";
    $result_user = mysqli_query($conn, $select_user);
    $row_user = mysqli_fetch_array($result_user);
    $user_name = $row_user['user_name'];



    $updated_post_views =  $post_views + 1;
    $update_post = "UPDATE post SET post_views='$updated_post_views' WHERE post_id='$post_id'";
    $result_update_post = mysqli_query($conn, $update_post);
}
?>

<?php require_once('parts/top.php'); ?>

</head>

<body>


    <?php require_once('parts/navbar.php'); ?>
    <main role="main" class="container-fluid my-3">
        <div class="row">
            <?php require_once('parts/left_sidebar.php'); ?>

            <div class="col-md-8">
                <div class="card bg-white p-3">
                    <img src="<?php echo $base_url; ?>/assets/img/thumbnail/<?php echo $post_thumbnail; ?>"
                        class="w-100 mb-3" alt="">
                    <h1 class="blog-title"><?php echo $post_title; ?></h1>
                    <div class="d-flex justify-content-between mb-2">
                        <!-- Author Info -->
                        <div class="author-info mb-2">
                            <img src="https://avatar.iran.liara.run/public/4" class="author-img" alt="Author Image">
                            <div class="author-details">
                                <span><strong><a href="@#"><?php echo $user_name; ?></a></strong></span>
                                <span><?php echo $post_views; ?> Views . <?php echo $post_date; ?> .
                                    <?php echo $post_read_time; ?>min Read Time
                                </span>
                            </div>
                        </div>
                        <p><a href="#" class="text-success fw-bold"><?php echo $dbcategory_name ?></a> > <a href="#"
                                class="text-success fw-bold"><?php echo $dbsubcategory_name ?></a></p>
                    </div>
                    <!-- Content -->
                    <div class="post-content">
                        <?php echo $post_content; ?>
                    </div>
                </div>
                <div class="card bg-white p-3 mt-3">
                    <!-- Comment Add Section -->
                    <div class="comment-section">
                        <h6>Add a Comment</h6>
                        <div class="comment-form">
                            <textarea class="form-control" rows="3" placeholder="Write your comment..."></textarea>
                            <button class="btn btn-primary mt-2 btn-sm">Submit Comment</button>
                        </div>
                    </div>

                    <!-- Display Comments Section -->
                    <div class="comment-section">
                        <h6>Recent Comments</h6>

                        <!-- Comment 1 -->
                        <?php
                        $x = 1;
                        while ($x < 4) {
                        ?>
                        <div class="comment">
                            <img src="https://avatar.iran.liara.run/public/<?php echo $x ?>" alt="User Avatar"
                                class="comment-avatar">
                            <div class="comment-body">
                                <div class="comment-author">John Doe</div>
                                <div class="comment-text">This is a very informative video! I learned a lot about web
                                    development concepts. Keep it up!</div>
                                <div class="comment-meta">
                                    <span class="comment-date">2 hours ago</span> •
                                    <span class="comment-reply"><i class="fas fa-reply"></i> Reply</span>
                                </div>
                            </div>
                        </div>
                        <?php $x++;
                        } ?>

                        <!-- Add more comments as needed -->
                    </div>
                </div>
            </div>
            <?php require_once('parts/right_sidebar.php'); ?>

        </div>

    </main>

    <?php require_once('parts/footer.php'); ?>