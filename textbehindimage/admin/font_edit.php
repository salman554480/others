<?php require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">

    <?php require_once('parts/navbar.php'); ?>

    <div id="layoutSidenav">

        <?php require_once('parts/sidebar.php'); ?>
        <?php
        require_once('parts/db.php');
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];


            $select_font = "SELECT * FROM font WHERE font_id='$edit_id'";
            $run_font = mysqli_query($conn, $select_font);
            $row_font = mysqli_fetch_array($run_font);

            $font_id = $row_font['font_id'];
            $font_name = $row_font['font_name'];
            $font_path = $row_font['font_path'];
        }
        ?>

        <div id="layoutSidenav_content">
            <div class="main-content-container container-fluid px-4">
                <!-- Page Header -->
                <div class="page-header ">
                    <div class="col-12 mt-4  mb-4">
                        <h4 class="mb-3">Add Font</h4>

                        <a href="font_view.php" class="btn btn-sm btn-outline-danger">View Record*</a>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- form start -->
                <div class="card mb-1">

                    <div class="card-header">
                        Enter font Record
                    </div>

                    <div class="card-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">

                            <div class="col-md-4">
                                <label class="form-label">Font Name</label>
                                <input type="text" name="font_name" class="form-control"
                                    value="<?php echo $font_name ?>" autofocus required />
                                <small> Roboto e.g. Get font name from <a href="https://fonts.google.com/">Here.</a>
                                </small>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Font Path</label>
                                <input type="text" name="font_path" value="<?php echo $font_path; ?>"
                                    class="form-control" required />
                                <small> Get font path from <a href="https://fonts.google.com/selection/embed">Here.</a>
                                </small>
                            </div>


                            <br><br><br><br>
                            <div class="col-md-12">

                                <input type="submit" name="update_btn" class="btn btn-sm btn-success"
                                    value="Update Record" />
                            </div>

                        </form>
                    </div>
                </div>
                <!-- form end -->

                <?php
                require_once('parts/db.php');

                if (isset($_POST['update_btn'])) {

                    // Get the form data
                    $font_name = $_POST['font_name'];
                    $font_path = $_POST['font_path'];

                    // Prepare the SQL query with placeholders
                    $update_font = "UPDATE font SET font_name = ?, font_path = ? WHERE font_id = ?";

                    // Prepare the statement
                    if ($stmt = mysqli_prepare($conn, $update_font)) {

                        // Bind the parameters to the placeholders
                        mysqli_stmt_bind_param($stmt, "ssi", $font_name, $font_path, $edit_id);

                        // Execute the prepared statement
                        $run_font = mysqli_stmt_execute($stmt);

                        // Check if the query was successful
                        if ($run_font) {
                            echo "<script>alert('Record Updated');</script>";
                            echo "<script>window.open('font_view.php','_self');</script>";
                        } else {
                            echo "<script>alert('Update Failed');</script>";
                        }

                        // Close the prepared statement
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<script>alert('Query preparation failed');</script>";
                    }
                }
                ?>




            </div>
            <?php require_once('parts/footer.php'); ?>
        </div>

    </div>
    <!--FooterCdn-->
    <?php require_once('parts/footercdn.php'); ?>
</body>

</html>