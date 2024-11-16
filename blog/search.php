<?php require_once('parts/top.php'); ?>

</head>

<body>


    <?php require_once('parts/navbar.php'); ?>
    <main role="main" class="container-fluid my-3">
        <div class="row">
            <?php require_once('parts/left_sidebar.php'); ?>

            <div class="col-md-8">

                <div class="d-flex justify-content-between">
                    <h5>Searched Result for: Games</h5>
                    <h6>43 Articles Found</h6>
                </div>
                <div class="row">
                    <!-- Blog Card 1 -->
                    <?php
                    $i = 1;
                    while ($i < 16) {
                    ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="card blog-card ">
                            <img src="https://picsum.photos/700/420?random=<?php echo $i; ?>" class="card-img-top"
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
                                    <p><a href="#" class="text-success fw-bold">Category</a></p>
                                </div>

                                <h5 class="card-title"><a href="">Top 10 Technology Blogs for Latest Tech Updates,
                                        News</a></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec
                                    elementum libero.</p>
                                <div class="d-flex justify-content-between text-small">
                                    <span class="blog-date text-muted">October 20, 2024</span>
                                    <span class="blog-date text-muted">3.1k Views</span>
                                </div>
                                <!-- <a href="#" class="btn btn-primary">Read More</a> -->
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                    } ?>

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