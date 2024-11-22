<?php require_once('parts/top.php'); ?>

</head>

<body>


    <?php require_once('parts/navbar.php'); ?>
    <main role="main" class="container-fluid my-3">
        <div class="row">
            <?php require_once('parts/left_sidebar.php'); ?>

            <div class="col-md-8">
                <?php require_once('parts/home_featured.php'); ?>

                <h5>Recent Blogs</h5>
                <div class="row">
                    <!-- Blog Card 1 -->
                    <?php
                    $select_post = "SELECT * From post WHERE  post_status='publish' order BY post_id DESC limit 30";
                    $result_post = mysqli_query($conn, $select_post);
                    while ($row_post = mysqli_fetch_array($result_post)) {
                        $post_id =  $row_post['post_id'];
                        $dbcategory_id =  $row_post['category_id'];
                        $post_title =  $row_post['post_title'];
                        $post_thumbnail =  $row_post['post_thumbnail'];
                        $post_views =  $row_post['post_views'];
                        $post_date =  $row_post['post_date'];
                        $post_status =  $row_post['post_status'];

                        $post_date = date("F j, Y", strtotime($post_date));

                        $select_meta = "SELECT * FROM meta WHERE meta_source='post' and meta_source_id='$post_id'";
                        $result_meta = mysqli_query($conn, $select_meta);
                        $row_meta = mysqli_fetch_array($result_meta);
                        $meta_description = $row_meta['meta_description'];

                        $select_category = "SELECT * FROM category WHERE category_id='$dbcategory_id'";
                        $result_category = mysqli_query($conn, $select_category);
                        $row_category = mysqli_fetch_array($result_category);
                        $dbcategory_name = $row_category['category_name'];
                    ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="card blog-card ">
                            <img src="assets/img/thumbnail/<?php echo $post_thumbnail; ?>" class="card-img-top"
                                alt="Blog image 1">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <!-- Author Info -->
                                    <div class="author-info mb-2">
                                        <img src="https://avatar.iran.liara.run/public/<?php echo $i; ?>"
                                            class="author-img" alt="Author Image">
                                        <div class="author-details">
                                            <span><strong><a href="@#">Alex Johnson</a></strong></span>
                                            <span>8 Posts</span>
                                        </div>
                                    </div>
                                    <p><a href="#" class="text-success fw-bold"><?php echo $dbcategory_name; ?></a></p>
                                </div>

                                <h5 class="card-title">
                                    <a href="post_details.php">
                                        <?php echo $post_title; ?>
                                        <?php if (strlen($post_title) > 50) {
                                                echo "...";
                                            } ?>
                                    </a>
                                </h5>
                                <p class="card-text"><?php echo substr($meta_description, 0, 150) ?></p>
                                <div class="d-flex justify-content-between text-small">
                                    <span class="blog-date text-muted"><?php echo $post_date; ?></span>
                                    <span class="blog-date text-muted"><?php echo $post_views ?> Views</span>
                                </div>
                                <!-- <a href="#" class="btn btn-primary">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3 py-5 border d-flex">
                                <ul class="pagination mx-auto">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php require_once('parts/right_sidebar.php'); ?>

        </div>

    </main>

    <?php require_once('parts/footer.php'); ?>