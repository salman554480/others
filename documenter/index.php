<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>

    <main role="main" class="container-fluid my-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Recent Files</h6>

                <div class="row">
                    <!-- Video Thumbnail Card -->
                    <?php
                    $i = 1;
                    while ($i < 13) {
                    ?>
                        <div class="col-md-2 mb-3">
                            <div class="card video-card">
                                <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Thumbnail"
                                    class="thumbnail">
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
            </div>
        </div>

        <div class="info-banner my-3">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Banner Content on the Left -->
                    <div class="col-md-6 info-banner-content">
                        <h1>Your Dream Adventure Awaits!</h1>
                        <p>Join us today to explore the world with exclusive offers and exciting travel packages.</p>
                        <a href="#" class="btn btn-subscribe">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Trendin Videos</h6>

                <div class="row">
                    <!-- Video Thumbnail Card -->
                    <?php
                    $i = 1;
                    while ($i < 13) {
                    ?>
                        <div class="col-md-2 mb-3">
                            <div class="card video-card">
                                <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Thumbnail"
                                    class="thumbnail">
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
            </div>
        </div>

        <!-- Top Content Creators Section -->
        <section class="top-creators py-5 bg-light ">
            <h6>Top Creators</h6>
            <div class="container-fluid text-center">
                <div class="row">
                    <!-- Creator 1 -->
                    <?php
                    $x = 1;
                    while ($x < 7) {
                    ?>
                        <div class="col-md-2 mb-4">
                            <div class="card">
                                <img src="https://avatar.iran.liara.run/public/<?php echo $x ?>" class="card-img-top"
                                    alt="Creator 1">
                                <div class="card-body">
                                    <h5 class="card-title">Creator Name 1</h5>
                                    <p class="card-text">5M Subscribers</p>
                                </div>
                            </div>
                        </div>
                    <?php $x++;
                    } ?>
                </div>
            </div>
        </section>

    </main>


    <?php require_once('parts/footer.php'); ?>
</body>

</html>