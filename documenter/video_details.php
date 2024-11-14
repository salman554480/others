<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>
    <?php
    if (isset($_GET['video_guid'])) {
        $video_guid = $_GET['video_guid'];
        $select_video = "SELECT * From video WHERE video_guid='$video_guid'";
        $result_video = mysqli_query($conn, $select_video);
        $row_video = mysqli_fetch_array($result_video);
        $video_id =  $row_video['video_id'];
        $video_views =  $row_video['video_views'];
        $video_title =  $row_video['video_title'];
        $video_access_key =  $row_video['video_access_key'];
        $dbcategory_id =  $row_video['category_id'];
        $video_tags =  $row_video['video_tags'];
        $video_description =  $row_video['video_description'];

        $incremented_video_views =  $video_views + 1;
        $update_views = "UPDATE video SET video_views='$incremented_video_views' WHERE video_id='$video_id'";
        $run_update_views =  mysqli_query($conn, $update_views);
    }
    ?>

    <main role="main" class="container-fluid my-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="video-container">
                    <video controls>
                        <source src="https://videos.pexels.com/video-files/4620490/4620490-uhd_2732_1440_25fps.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <h4 class="main-title"><?php echo $video_title; ?></h4>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="author-info mb-2">
                            <img src="https://avatar.iran.liara.run/public/<?php echo $i ?>" alt="Author Image"
                                class="author-img">
                            <div>
                                <span class="author-name">John Doe</span>

                                <div class="video-meta">
                                    <span><strong>1.2M</strong> Follwers</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7 d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Button group example">
                            <!-- Button 1 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-up"></i> 38
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-down"></i> 38
                            </button>

                            <!-- Button 1 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-share"></i> Share
                            </button>

                            <!-- Button 2 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-download"></i> Download
                            </button>

                            <!-- Button 3 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-bookmark"></i> Save
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-2">
                    <?php echo $video_description; ?>



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
            <div class="col-md-4">
                <h6>Recent Videos</h6>

                <div class="list-group">
                    <!-- Video 1 -->
                    <?php
                    $i = 1;
                    while ($i < 14) {
                    ?>
                    <div class="list-group-item d-flex align-items-center video-item">
                        <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Video Thumbnail"
                            class="video-thumbnail">
                        <div class="video-info">
                            <div class="video-title">How to Learn Web Development</div>
                            <div class="d-flex justify-content-between">
                                <div class="video-author">By John Doe</div>
                                <div class="video-author">3:00</div>

                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="video-views"><i class="fas fa-eye"></i> 1.5K views</div>
                                <div class="video-time"><i class="fas fa-clock"></i> 2 days ago</div>

                            </div>
                        </div>
                    </div>
                    <?php $i++;
                    } ?>


                    <!-- Add more videos as needed -->
                </div>
            </div>
        </div>



    </main>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>