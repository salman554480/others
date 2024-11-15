<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>
    <?php
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    }
    ?>

    <main role="main" class="container-fluid my-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Results for: <?php echo ucfirst($search); ?></h6>

                <div class="row">
                    <!-- Video Thumbnail Card -->
                    <?php
                    $select_query =  "SELECT * FROM video WHERE video_title LIKE '%$search%' OR video_tags LIKE '%$search%'";
                    $run_query =  mysqli_query($conn, $select_query);
                    if (mysqli_num_rows($run_query) > 0) {
                        while ($row_search_query =  mysqli_fetch_array($run_query)) {
                            $video_id =  $row_search_query['video_id'];
                            $user_id =  $row_search_query['user_id'];
                            $video_guid =  $row_search_query['video_guid'];
                            $video_thumbnail =  $row_search_query['video_thumbnail'];
                            $video_title =  $row_search_query['video_title'];
                            $video_views =  $row_search_query['video_views'];
                            $video_date =  $row_search_query['video_date'];
                            $video_time =  $row_search_query['video_time'];


                            $select_user = "SELECT * From user  WHERE user_id='$user_id'";
                            $result_user = mysqli_query($conn, $select_user);
                            $row_user = mysqli_fetch_array($result_user);
                            $user_name =  $row_user['user_name'];

                    ?>
                    <div class="col-md-2 mb-3">
                        <div class="card video-card">
                            <img src="portal/assets/images/thumbnail/<?php echo $video_thumbnail; ?>" alt="Thumbnail"
                                class="thumbnail">
                            <div class="video-duration">5:23</div>
                            <div class="card-body">


                                <h5 class="card-title">
                                    <a href="video_details.php?video_guid=<?php echo $video_guid ?>">
                                        <?php echo substr($video_title, 0, 50); ?>
                                        <?php if (strlen($video_title) > 50) {
                                                    echo "...";
                                                } ?>
                                    </a>
                                </h5>

                                <div class="author-info mb-2">
                                    <img src="https://avatar.iran.liara.run/public/<?php echo $i ?>" alt="Author Image"
                                        class="author-img">
                                    <div>
                                        <span class="author-name"><?php echo $user_name; ?></span>

                                        <div class="video-meta">
                                            <span><strong><?php echo $video_views; ?></strong> views</span> |
                                            <span><strong><?php echo $video_date; ?>
                                                    <?php echo $video_time; ?></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<div class='bg-secondary text-light p-2 container my-2'>No Video Found</div>";
                    }
                    ?>

                    <!-- More video cards as needed -->
                </div>


                <div class="pagination-area d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>


    </main>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>