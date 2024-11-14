<div class="row">
    <!-- Video Thumbnail Card -->
    <?php
    $i = 1;
    while ($i < 13) {
    ?>
    <div class="col-md-2 mb-3">
        <div class="card video-card">
            <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Thumbnail" class="thumbnail">
            <div class="video-duration">5:23</div>
            <div class="card-body">
                <h5 class="card-title">How I Hacked 810 Million Websites | Wordpress Hacking
                </h5>
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