<div class="row">
    <!-- Video Thumbnail Card -->
    <?php
    $select_recent_video = "SELECT * From video  WHERE video_status='publish' LIMIT 12";
    $result_recent_video = mysqli_query($conn, $select_recent_video);
    while ($row_recent_video = mysqli_fetch_array($result_recent_video)) {
        $video_id =  $row_recent_video['video_id'];
        $user_id =  $row_recent_video['user_id'];
        $video_guid =  $row_recent_video['video_guid'];
        $video_thumbnail =  $row_recent_video['video_thumbnail'];
        $video_title =  $row_recent_video['video_title'];
        $video_views =  $row_recent_video['video_views'];
        $video_date =  $row_recent_video['video_date'];
        $video_time =  $row_recent_video['video_time'];


        $select_user = "SELECT * From user  WHERE user_id='$user_id'";
        $result_user = mysqli_query($conn, $select_user);
        $row_user = mysqli_fetch_array($result_user);
        $user_name =  $row_user['user_name'];

    ?>
    <div class="col-md-2 mb-3">
        <div class="card video-card">
            <img src="portal/images/thumbnail/<?php echo $video_thumbnail; ?>" alt="Thumbnail" class="thumbnail">
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
                            <span><strong><?php echo $video_date; ?> <?php echo $video_time; ?></strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- More video cards as needed -->
</div>