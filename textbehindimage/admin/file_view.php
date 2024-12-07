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
                            <h4 class="mb-3">Generated Images</h4>

                        </div>
                    </div>
                    <div class="card mb-3 bg-white">

                        <div class="card-body ">


                            <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
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


            </main>
            <?php require_once('parts/footer.php'); ?>
        </div>

    </div>
    <!--Footercdn--->
    <?php require_once('parts/footercdn.php'); ?>

</body>

</html>