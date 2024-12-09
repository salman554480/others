<?php require_once('parts/top.php'); ?>
<style>
<?php $select_font="SELECT * FROM font ";
$run_font=mysqli_query($conn, $select_font);

while ($row_font=mysqli_fetch_array($run_font)) {
    $font_path=$row_font['font_path'];

    echo $font_path;
}

?>
</style>
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
                            <h4 class="mb-3">Fonts</h4>

                            <a href="font_add.php" class="btn btn-sm  btn-outline-danger">Add Record</a>
                        </div>
                    </div>
                    <div class="card mb-3 bg-white">

                        <div class="card-body ">

                            <?php

                            require_once('parts/db.php');

                            if (isset($_GET['del'])) {
                                $del_id = $_GET['del'];

                                $delete = "DELETE FROM font WHERE font_id='$del_id'";
                                $run = mysqli_query($conn, $delete);

                                if ($run === true) {
                                    echo "<script>alert('Deleted');</script>";
                                    echo "<script>window.open('font_view.php','_self');</script>";
                                } else {
                                    echo "Failed,Try Again";
                                }
                            }

                            ?>

                            <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Style</th>
                                        <th>Font</th>
                                        <th>Path</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    require_once('parts/db.php');
                                    $select = "SELECT * FROM font  ORDER BY font_id DESC";
                                    $run = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_array($run)) {

                                        $font_id = $row['font_id'];
                                        $font_name = $row['font_name'];
                                        $font_path = $row['font_path'];

                                    ?>
                                    <tr>
                                        <td><?php echo $font_id; ?></td>
                                        <td>
                                            <p style="font-family:<?php echo $font_name; ?>"><?php echo $font_name; ?>
                                            </p>

                                        </td>
                                        <td><?php echo $font_name; ?></td>
                                        <td><?php echo $font_path; ?></td>
                                        <td>
                                            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                                                <li class="nav-item dropdown">
                                                    <button class="btn btn-danger dropdown-toggle" id="navbarDropdown"
                                                        href="#" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">Action</i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="navbarDropdown">

                                                        <li> <a class="dropdown-item"
                                                                href="font_view.php?del=<?php echo $font_id; ?>">Delete</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li> <a class="dropdown-item"
                                                                href="font_edit.php?edit=<?php echo $font_id; ?>">Edit</a>
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