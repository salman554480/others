<?php require_once('parts/top.php'); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
      <?php require_once('parts/sidebar.php');?>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">File</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Data</h6>
                        </div>
						
						<?php
// database.php
require_once('parts/db.php');

// Determine which page number visitor is on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

// SQL query to fetch records
$sql = "SELECT * FROM file ORDER BY file_id DESC LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Get total records for pagination
$total_result = $conn->query("SELECT COUNT(*) AS total FROM file");
$row = $total_result->fetch_assoc();
$total_records = $row['total'];

$total_pages = ceil($total_records / $records_per_page);
?>

						
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" style="font-size:13px">
            <thead>
                <tr>
					<th>ID</th>
					<th>File</th>
					<th>Folder Key</th>
				    <th>Access Key</th>
					<th>Status</th>
					<th>State</th>
					
				 
				</tr>
            </thead>
            <tbody>
                <?php while($row_file = $result->fetch_assoc()){ 
				 $file_id = $row_file['file_id'];
				 $user_id = $row_file['user_id'];
				 $folder_key = $row_file['folder_key'];
				 $file_name = $row_file['file_name'];
				 $file_access_key = $row_file['file_access_key'];
				 $file_unique_id = $row_file['file_unique_id'];
				 $file_size = $row_file['file_size'];
				 $file_type = $row_file['file_type'];
				 $file_extension = $row_file['file_extension'];
				 $file_date = $row_file['file_date'];
				 $file_status = $row_file['file_status'];
				 $file_state = $row_file['file_state'];
				 
				 $file_sizeMb =  number_format($file_size / 1024 , 1);
				?>
                <tr>
                    <td><?php echo $file_id; ?></td>
                    <td>
                        <?php echo substr($file_name,9,30); ?> <br>
                        <small><?php echo $file_sizeMb;?> Mb | <?php echo $file_type;?>/<?php echo $file_extension;?></small> 
                    </td>
                    <td><?php echo $folder_key; ?></td>
                    <td><?php echo $file_access_key; ?></td>
                    <td><?php echo $file_status; ?></td>
                    <td><?php echo $file_state; ?></td>
                   
                    <!-- Add more columns as per your table structure -->
                </tr>
                <?php } ?>
            </tbody>
        </table>
								
								<nav>
									<ul class="pagination justify-content-center">
										<?php if($page > 1): ?>
											<li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>">Previous</a></li>
										<?php endif; ?>

										<?php for($i = 1; $i <= $total_pages; $i++): ?>
											<li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
												<a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
											</li>
										<?php endfor; ?>

										<?php if($page < $total_pages): ?>
											<li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>">Next</a></li>
										<?php endif; ?>
									</ul>
								</nav>
                            </div>
                        </div>
                    </div>

                    
					

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           <?php require_once('parts/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


