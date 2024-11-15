<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>

    <main role="main" class="container-fluid my-4">
        <!-- Recent Videos -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Recent Files</h6>
                <?php require_once('parts/home_recent.php'); ?>

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

        <!-- Trending Videos -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Trending Videos</h6>
                <?php require_once('parts/home_trending.php'); ?>

            </div>
        </div>

        <!-- Top Content Creators Section -->
        <section class="top-creators py-5 bg-light ">
            <h6>Top Creators</h6>
            <?php require_once('parts/home_creators.php'); ?>
        </section>

    </main>

    <?php require_once('parts/footer.php'); ?>
</body>

</html><?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>
    <main role="main" class="container-fluid my-4">
        <!-- Recent Videos -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Recent Files</h6>
                <?php require_once('parts/home_recent.php'); ?>
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
                    <!-- Banner Image on the Right -->
                    <div class="col-md-6 info-banner-image">
                        <img src="image.jpg" alt="Banner Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <!-- Trending Videos -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Trending Videos</h6>
                <?php require_once('parts/home_trending.php'); ?>
            </div>
        </div>

        <!-- Top Content Creators Section -->
        <section class="top-creators py-5 bg-light ">
            <h6>Top Creators</h6>
            <?php require_once('parts/home_creators.php'); ?>
        </section>

    </main>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>