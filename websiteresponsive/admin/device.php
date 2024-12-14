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
                            <h4 class="mb-3">Devices</h4>

                        </div>
                    </div>
                    <div class="card mb-3 bg-white">

                        <div class="card-body ">

                            <?php

                            require_once('parts/db.php');

                            if (isset($_GET['del'])) {
                                $del_id = $_GET['del'];

                                $delete = "DELETE FROM screen WHERE screen_id='$del_id'";
                                $run = mysqli_query($conn, $delete);

                                if ($run === true) {
                                    echo "<script>alert('Deleted');</script>";
                                    echo "<script>window.open('device.php','_self');</script>";
                                } else {
                                    echo "Failed,Try Again";
                                }
                            }

                            ?>


                            <div class="card-body">
                                <form class="row g-3" action="" method="post" enctype="multipart/form-data">

                                    <div class="col-md-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" autofocus required />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="category_id">
                                            <?php

                                            require_once('parts/db.php');
                                            $select = "SELECT * FROM category ";
                                            $run = mysqli_query($conn, $select);
                                            while ($row = mysqli_fetch_array($run)) {

                                                $category_id = $row['category_id'];
                                                $category_name = $row['category_name'];
                                            ?>
                                            <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Width(px)</label>
                                        <input type="email" name="width" class="form-control" required />
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Height(px)</label>
                                        <input type="password" name="height" class="form-control" required />
                                    </div>



                                    <br><br><br><br>
                                    <div class="col-md-12">

                                        <input type="submit" name="insert_btn" class="btn btn-sm btn-success"
                                            value="Add Device" />
                                    </div>

                                </form>
                            </div>


                            <?php
                            require_once('parts/db.php');
                            if (isset($_POST['insert_btn'])) {

                                $name = $_POST['name'];
                                $category_id = $_POST['category_id'];
                                $width = $_POST['width'];
                                $height = $_POST['height'];

                                $insert_admin = "INSERT INTO screen(screen_name,category_id,screen_width,screen_height)VALUES('$name','$category_id','$width','$height')";

                                $run_admin = mysqli_query($conn, $insert_admin);

                                if ($run_admin == true) {
                                    //echo "data is inserted ";
                                    echo "<script>alert('Record Added');</script>";
                                    echo "<script>window.open('device.php','_self');</script>";
                                } else {
                                    //echo "fail";
                                    echo "<script>alert('Failed');</script>";
                                }
                            }

                            ?>


                            <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    require_once('parts/db.php');
                                    $select = "SELECT * FROM screen";
                                    $run = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_array($run)) {

                                        $screen_id = $row['screen_id'];
                                        $category_id = $row['category_id'];
                                        $screen_name = $row['screen_name'];
                                        $screen_width = $row['screen_width'];
                                        $screen_height = $row['screen_height'];

                                        $select_category = "SELECT * FROM category WHERE category_id='$category_id'";
                                        $run_category = mysqli_query($conn, $select_category);
                                        $row_category = mysqli_fetch_array($run_category);

                                        $category_name = $row_category['category_name'];
                                        $category_url = $row_category['category_url'];

                                    ?>
                                    <tr>
                                        <td><?php echo $screen_id; ?></td>
                                        <td><?php echo $screen_name; ?></td>
                                        <td><?php echo $category_name; ?></td>
                                        <td><?php echo $screen_width; ?></td>
                                        <td><?php echo $screen_height; ?></td>
                                        <td>
                                            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                                                <li class="nav-item dropdown">
                                                    <button class="btn btn-danger dropdown-toggle" id="navbarDropdown"
                                                        href="#" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">Action</i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="navbarDropdown">

                                                        <li> <a class="dropdown-item"
                                                                href="screen_view.php?del=<?php echo $screen_id; ?>">Delete</a>
                                                        </li>
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