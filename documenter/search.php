<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>

    <main role="main" class="container-fluid my-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h6>Results for: Web Development Tutorials</h6>

                <div class="row">
                    <!-- Video Thumbnail Card -->
                    <?php
                    $i = 1;
                    while ($i < 25) {
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