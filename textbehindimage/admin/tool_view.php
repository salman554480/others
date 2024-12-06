<?php require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">

    <?php require_once('parts/navbar.php'); ?>

    <div id="layoutSidenav">

        <?php require_once('parts/sidebar.php'); ?>

        <div id="layoutSidenav_content" class="">
            <main class="">
                <div class="container-fluid  px-4">

                    <div class="page-header">
                        <div class="col-12 mt-4 mb-4">
                            <h4 class="mb-3">View Tool</h4>

                            <a href="tool_add.php" class="btn btn-sm  btn-outline-success ">Record Add</a>
                            <a href="tool_trash.php" class="btn btn-sm  btn-outline-warning ">Record Trash</a>
                        </div>
                    </div>
                    <div class="card mb-3 bg-white">

                        <div class="card-body ">

                            <?php

                            require_once('parts/db.php');

                            if (isset($_GET['del'])) {
                                $del_id = $_GET['del'];

                                $delete = "UPDATE tool SET  tool_status='draft' WHERE tool_id='$del_id'";
                                $run = mysqli_query($conn, $delete);

                                if ($run === true) {
                                    echo "<script>alert('Deleted');</script>";
                                    echo "<script>window.open('tool_view.php','_self');</script>";
                                } else {
                                    echo "Failed,Try Again";
                                }
                            }

                            ?>

                            <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Views</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    require_once('parts/db.php');
                                    $select = "SELECT * FROM tool";
                                    $run = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_array($run)) {

                                        $tool_id = $row['tool_id'];
                                        $tool_name = $row['tool_name'];
                                        $tool_url = $row['tool_url'];
                                        $tool_views = $row['tool_views'];
                                        $tool_status = $row['tool_status'];

                                    ?>
                                        <tr>
                                            <td><?php echo $tool_id; ?></td>
                                            <td><?php echo $tool_name; ?></td>
                                            <td><?php echo $tool_url; ?></td>
                                            <td><?php echo $tool_views; ?></td>
                                            <td><?php echo $tool_status; ?></td>
                                            <td>
                                                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                                                    <li class="nav-item dropdown">
                                                        <button class="btn btn-danger dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Action</i></button>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                                            <li> <a class="dropdown-item" href="tool_view.php?del=<?php echo $tool_id; ?>">Delete</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider" />
                                                            </li>
                                                            <li> <a class="dropdown-item" href="tool_edit.php?edit=<?php echo $tool_id; ?>">Edit</a></li>
                                                            <hr class="dropdown-divider" />
                                                    </li>
                                                    <li> <a class="dropdown-item" href="../tool_details.php?tool_url=<?php echo $tool_url; ?>">View Page</a></li>
                                                </ul>
                                                </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


            </main>
            <?php require_once('parts/footer.php'); ?>
        </div>

    </div>
    <!--Footercdn--->
    <?php require_once('parts/footercdn.php'); ?>

</body>

</html>