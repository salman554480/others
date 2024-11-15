<?php require_once('parts/top.php'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('parts/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('parts/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">External Files</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Access Code</th>
                                            <th>URL</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        require_once('parts/db.php');
                                        $select_file = "SELECT * FROM file where file_unique_id='' and file_state='wait'and file_external_url!='' order by file_id DESC";
                                        $result = mysqli_query($conn, $select_file);
                                        while($row = mysqli_fetch_assoc($result)){
                                            $file_id = $row['file_id'];
                                            $file_name = $row['file_name'];
                                            $file_access_key = $row['file_access_key'];
                                            $file_external_url = $row['file_external_url'];
                                            $file_size = $row['file_size'];
                                            $file_date = $row['file_date'];
                                            $file_extension = $row['file_extension'];
                                            $file_path  = "../upload/".$file_name;
                                            
                                            $file_sizeMb =  number_format($file_size / 1024 , 1);

                                        ?>
                                        
                                            
                                            <tr>
                                                <td><?php echo $file_id;?></td>
                                                <td><?php echo $file_access_key;?></td>
                                                <td><a href="<?php echo $file_external_url;?>" target="_blank"><?php echo $file_external_url;?></a></td>
                                                <td>
                                                    <?php echo $file_name;?><br>
                                                    <small><?php echo $file_sizeMb;?> MB | <?php echo $file_extension;?></small>
                                                </td>
                                               <td><?php echo $file_date;?></td>
                                                <td><a href="<?php echo $file_external_url;?>"
                                                        class="btn btn-success btn-sm">Download</a></td>
                                                </td>
                                            </tr>
                                        
                                        <?php }?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php require_once('parts/footer.php'); ?>