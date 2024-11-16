<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 4 Offline Example</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container">
            <!-- Navbar brand (centered) -->
            <a class="navbar-brand mx-auto" href="#">Offcanvas navbar</a>

            <!-- Toggler for small screens -->
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <!-- Left-aligned navbar items -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Join <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                </ul>

                <!-- Search form (right-aligned) -->
                <form class="form-inline my-2 my-lg-0 ml-auto text-nowrap">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="nav-scroller bg-white box-shadow">
        <nav class="nav nav-underline">
            <a class="nav-link active" href="#">Dashboard</a>
            <a class="nav-link" href="#"> Friends <span class="badge badge-pill bg-light align-text-bottom">27</span>
            </a>
            <a class="nav-link" href="#">Explore</a>
            <a class="nav-link" href="#">Suggestions</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
        </nav>
    </div>
    <main role="main" class="container-fluid my-3">
        <div class="row">
            <?php require_once('parts/left_sidebar.php'); ?>

            <div class="col-md-8">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div
                            class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">World</strong>
                                <h3 class="mb-0">Featured post</h3>
                                <div class="mb-1 text-muted">Nov 12</div>
                                <p class="card-text mb-auto">This is a wider card with supporting text below as a
                                    natural lead-in to additional content.</p>
                                <a href="#" class="stretched-link">Continue reading</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img" width="200" height="250"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%"
                                        fill="#eceeef" dy=".3em">Thumbnail</text>
                                </svg>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-white">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-success">Design</strong>
                                <h3 class="mb-0">Post title</h3>
                                <div class="mb-1 text-muted">Nov 11</div>
                                <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in
                                    to additional content.</p>
                                <a href="#" class="stretched-link">Continue reading</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img" width="200" height="250"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%"
                                        fill="#eceeef" dy=".3em">Thumbnail</text>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>

                <h5>Recent Blogs</h5>
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
                                    <div class="author-info mb-2">
                                        <img src="https://avatar.iran.liara.run/public/<?php echo $i; ?>"
                                            class="author-img" alt="Author Image">
                                        <div class="author-details">
                                            <span><strong>Alex Johnson</strong></span>
                                            <span>8 Posts</span>
                                        </div>
                                    </div>
                                    <p class="text-success fw-bold">Category</p>
                                </div>
                                <!-- Author Info -->

                                <h5 class="card-title">Top 10 Technology Blogs for Latest Tech Updates, News</h5>
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



    <!-- Link to Bootstrap JS (with Popper.js) -->
    <script src="assets/bootstrap/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/bootstrap/popper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="assets/js/script.js"></script>
</body>

</html>