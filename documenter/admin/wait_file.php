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
                    <h1 class="h3 mb-2 text-gray-800">Files in Wait</h1>

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
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        require_once('parts/db.php');
                                        $select_file = "SELECT * FROM file where file_unique_id='' and file_state='wait' order by file_id DESC";
                                        $result = mysqli_query($conn, $select_file);
                                        while($row = mysqli_fetch_assoc($result)){
                                            $file_id = $row['file_id'];
                                            $file_name = $row['file_name'];
                                            $user_id = $row['user_id'];
                                            $file_access_key = $row['file_access_key'];
                                            $file_size = $row['file_size'];
                                            $file_date = $row['file_date'];
                                            $file_extension = $row['file_extension'];
                                            $file_path  = "../upload/".$file_name;
                                            
                                            $file_sizeMb = $file_size / 1024;
                                            $totalChunks = ceil($file_sizeMb / 19);
                                            
                                            
                                            
                                                if ($file_size < 1024) {
                                                    $formatted_size = $file_size . ' KB';
                                                } elseif ($file_size < 1048576) { // 1024 * 1024
                                                    $formatted_size = round($file_size / 1024, 2) . ' MB';
                                                } elseif ($file_size < 1073741824) { // 1024 * 1024 * 1024
                                                    $formatted_size = round($file_size / 1048576, 2) . ' GB';
                                                } else {
                                                    $formatted_size = round($file_size / 1073741824, 2) . ' TB'; // Optional for very large files
                                                }

                                        ?>
                                        
                                            
                                            <tr>
                                                <td><?php echo $file_id;?></td>
                                                <td><?php echo $file_access_key;?></td>
                                                <td>
                                                    <?php echo $file_name;?><br>
                                                    <small><?php echo $formatted_size;?> | <?php echo $file_extension;?> | <?php echo $totalChunks;?> </small>
                                                </td>
                                               <td><?php echo $file_date;?></td>
                                               <td>
                                                   <div class="btn-group">
                                                      <a href="upload/<?php echo $file_name;?>" class="btn btn-primary"><i class="fas fa-fw fa-download"></i></a>
                                                      <a href="telego/index.php?file_access_key=<?php echo $file_access_key?>&user_id=<?php echo $user_id; ?>" class="btn btn-success"><i class="fas fa-fw fa-upload"></i></a>
                                                      <a href="file_details.php?file_access_key=<?php echo $file_access_key?>" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i></a>
                                                    </div>
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