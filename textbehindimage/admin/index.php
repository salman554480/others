<?php require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">
    <?php require_once('parts/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php require_once('parts/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <br>
                    <h2 class="mt-1">Dashboard</h2>
                    <hr>
                    <div class="row">
                        <?php
                        require_once('parts/db.php');

                        $select_file = "SELECT * FROM file ";
                        $run_file = mysqli_query($conn, $select_file);
                        $total_file = mysqli_num_rows($run_file);

                        $select_category = "SELECT * FROM category ";
                        $run_category = mysqli_query($conn, $select_category);
                        $total_category = mysqli_num_rows($run_category);


                        $select_post = "SELECT * FROM post ";
                        $run_post = mysqli_query($conn, $select_post);
                        $total_post = mysqli_num_rows($run_post);



                        $select_font = "SELECT * FROM font ";
                        $run_font = mysqli_query($conn, $select_font);
                        $total_font = mysqli_num_rows($run_font);





                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h4>Images Generated</h4>
                                    <h3><?php echo $total_file; ?></h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a href="file_view.php"><small class="small text-white stretched-link">View
                                            Details</small></a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h4>Total Categories</h4>
                                    <h3><?php echo $total_category; ?></h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a href="category_view.php"><small class="small text-white stretched-link">View
                                            Category Details</small></a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h4>Total Posts</h4>
                                    <h3><?php echo $total_post; ?></h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a href="post_view.php"><small class="small text-white stretched-link">View
                                            Post Details</small></a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h4>Total Fonts</h4>
                                    <h3><?php echo $total_font; ?></h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a href="font_view.php"><small class="small text-white stretched-link">View
                                            Font Details</small></a>
                                    <div class="small text-white">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-file me-1"></i>
                                    Latest Added files
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>CODE</th>
                                                <th>WIDTH</th>
                                                <th>HEIGHT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('parts/db.php');
                                            $select = "SELECT * FROM file ORDER BY file_id DESC LIMIT 10";
                                            $run = mysqli_query($conn, $select);
                                            while ($row = mysqli_fetch_array($run)) {

                                                $file_id = $row['file_id'];
                                                $file_code = $row['file_code'];
                                                $file_width = $row['file_width'];
                                                $file_height = $row['file_height'];

                                            ?>
                                            <tr>
                                                <td><?php echo $file_id; ?></td>
                                                <td><?php echo $file_code; ?></td>
                                                <td><?php echo $file_width; ?>px</td>
                                                <td><?php echo $file_height; ?>px</td>
                                            </tr>
                                            <?php    } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-post me-1"></i>
                                    Most Popular Posts
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('parts/db.php');
                                            $select = "SELECT * FROM post ORDER BY post_views DESC LIMIT 10";
                                            $run = mysqli_query($conn, $select);
                                            while ($row = mysqli_fetch_array($run)) {

                                                $post_title = $row['post_title'];
                                                $post_views = $row['post_views'];

                                            ?>
                                            <tr>
                                                <td><?php echo $post_title; ?></td>
                                                <td><?php echo $post_views; ?></td>
                                            </tr>
                                            <?php    } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----start chart
                  <div class="row">
                      <div class="col-xl-6">
                          <div class="card mb-4">
                              <div class="card-header">
                                  <i class="fas fa-chart-area me-1"></i>
                                  Area Chart Example
                              </div>
                              <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                          </div>
                      </div>
                      <div class="col-xl-6">
                          <div class="card mb-4">
                              <div class="card-header">
                                  <i class="fas fa-chart-bar me-1"></i>
                                  Bar Chart Example
                              </div>
                              <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                          </div>
                      </div>
                  </div>
                  end chart--->
                </div>
            </main>
            <?php require_once('parts/footer.php'); ?>
        </div>
    </div>
    <!--Footercdn--->
    <?php require_once('parts/footercdn.php'); ?>
</body>

</html>