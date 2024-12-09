<?php require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">

    <?php require_once('parts/navbar.php'); ?>

    <div id="layoutSidenav">

        <?php require_once('parts/sidebar.php'); ?>

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
                                <input type="text" name="font_name" class="form-control" placeholder="Roboto" autofocus
                                    required />
                                <small> Roboto e.g. Get font name from <a href="https://fonts.google.com/">Here.</a>
                                </small>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Font Path</label>
                                <input type="text" name="font_path"
                                    placeholder="@import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');"
                                    class="form-control" required />
                                <small> Get font path from <a href="https://fonts.google.com/selection/embed">Here.</a>
                                </small>
                            </div>


                            <br><br><br><br>
                            <div class="col-md-12">

                                <input type="submit" name="insert_btn" class="btn btn-sm btn-success"
                                    value="Add Record" />
                            </div>

                        </form>
                    </div>
                </div>
                <!-- form end -->

                <?php
            require_once('parts/db.php');

            if (isset($_POST['insert_btn'])) {

               // Get the form data
               $font_name = $_POST['font_name'];
               $font_path = $_POST['font_path'];

               // Prepare the SQL query with placeholders
               $insert_font = "INSERT INTO font (font_name, font_path) VALUES (?, ?)";

               // Prepare the statement
               if ($stmt = mysqli_prepare($conn, $insert_font)) {

                  // Bind the parameters to the placeholders
                  mysqli_stmt_bind_param($stmt, "ss", $font_name, $font_path);

                  // Execute the prepared statement
                  $run_font = mysqli_stmt_execute($stmt);

                  // Check if the query was successful
                  if ($run_font) {
                     echo "<script>alert('Record Added');</script>";
                     echo "<script>window.open('font_view.php','_self');</script>";
                  } else {
                     echo "<script>alert('Failed');</script>";
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