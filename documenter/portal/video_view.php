<?php require_once('parts/top.php'); ?>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-speedometer"></i> Blank Page</h1>
                <p>Start a beautiful journey here</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Views</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $select_video = "SELECT * From video WHERE user_id='$user_id'";
                                    $result_video = mysqli_query($conn, $select_video);
                                    while ($row_video = mysqli_fetch_array($result_video)) {
                                        $video_id =  $row_video['video_id'];
                                        $video_title =  $row_video['video_title'];
                                        $video_views =  $row_video['video_views'];
                                        $video_date =  $row_video['video_date'];
                                        $video_time =  $row_video['video_time'];
                                        $video_status =  $row_video['video_status'];

                                        if ($video_status == "publish") {
                                            $label = "<span class='badge bg-success '>Publish</span>";
                                        } else {
                                            $label = "<span class='badge  bg-danger'>Draft</span>";
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $video_title; ?></td>
                                        <td><?php echo $video_views; ?></td>
                                        <td><?php echo $video_date; ?> <?php echo $video_time; ?> </td>
                                        <td><?php echo $label; ?></td>
                                        <td><a href="video_edit.php?video_id=<?php echo $video_id; ?>">Edit</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>



    <?php require_once('parts/footer.php'); ?>
    <!-- Page specific javascripts-->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#sampleTable').DataTable();
    </script>