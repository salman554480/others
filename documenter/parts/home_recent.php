<div class="row">
    <!-- Video Thumbnail Card -->
    <?php
    $select_recent_video = "SELECT * From video WHERE user_id='$user_id' WHERE video_status='publish'";
    $result_recent_video = mysqli_query($conn, $select_recent_video);
    while ($row_recent_video = mysqli_fetch_array($result_recent_video)) {
        $video_id =  $row_recent_video['video_id'];
        $video_guid =  $row_recent_video['video_guid'];
        $video_thumbnail =  $row_recent_video['video_thumbnail'];
        $video_title =  $row_recent_video['video_title'];
        $video_views =  $row_recent_video['video_views'];
        $video_date =  $row_recent_video['video_date'];
        $video_time =  $row_recent_video['video_time'];

        if ($video_status == "publish") {
            $label = "<span class='badge bg-success '>Publish</span>";
        } else {
            $label = "<span class='badge  bg-danger'>Draft</span>";
        }
    ?>
    <div class="col-md-2 mb-3">
        <div class="card video-card">
            <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Thumbnail" class="thumbnail">
            <div class="video-duration">5:23</div>
            <div class="card-body">
                <h5 class="card-title">Amazing Nature Documentary</h5>
                <div class="author-info mb-2">
                    <img src="https://avatar.iran.liara.run/public/<?php echo $i ?>" alt="Author Image"
                        class="author-img">
                    <div>
                        <span class="author-name">John Doe</span>

                        <div class="video-meta">
                            <span><strong>1.2M</strong> views</span> | <span><strong>3 days
                                    ago</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $i++;
    } ?>

    <!-- More video cards as needed -->
</div>