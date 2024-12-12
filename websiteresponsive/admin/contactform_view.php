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
                            <h4 class="mb-3">Form Entries</h4>

                        </div>
                    </div>
                    <div class="card mb-3 bg-white">

                        <div class="card-body ">


                            <table id="datatablesSimple" class="table table-hover table-sm table-responsive">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    require_once('parts/db.php');
                                    $select = "SELECT * FROM contactform";
                                    $run = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_array($run)) {

                                        $contactform_id = $row['contactform_id'];
                                        $user_name = $row['user_name'];
                                        $user_email = $row['user_email'];
                                        $user_message = $row['user_message'];

                                    ?>
                                    <tr>
                                        <td><?php echo $contactform_id; ?></td>
                                        <td><?php echo $user_name; ?></td>
                                        <td><?php echo $user_email; ?></td>
                                        <td><?php echo $user_message; ?></td>
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