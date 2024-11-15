<?php require_once('parts/top.php'); ?>
  </head>
<?php
$select_total_user = "SELECT * FROM user";
$run_select_total_user = mysqli_query($conn,$select_total_user);
$total_user = mysqli_num_rows($run_select_total_user);


$select_verified_user = "SELECT * FROM user WHERE user_verify='1'";
$run_select_verfied_user = mysqli_query($conn,$select_verified_user);
$verified_user = mysqli_num_rows($run_select_verfied_user);


$select_free_user = "SELECT * FROM user WHERE package_id='1'";
$run_select_free_user = mysqli_query($conn,$select_free_user);
$free_user = mysqli_num_rows($run_select_free_user);

$select_paid_user = "SELECT * FROM user WHERE package_id > 1";
$run_select_paid_user = mysqli_query($conn,$select_paid_user);
$paid_user = mysqli_num_rows($run_select_paid_user);


$select_standard_user = "SELECT * FROM user WHERE package_id = '2'";
$run_select_standard_user = mysqli_query($conn,$select_standard_user);
$standard_user = mysqli_num_rows($run_select_standard_user);

$select_premium_user = "SELECT * FROM user WHERE package_id = '3'";
$run_select_premium_user = mysqli_query($conn,$select_premium_user);
$premium_user = mysqli_num_rows($run_select_premium_user);

$select_ultimate_user = "SELECT * FROM user WHERE package_id = '4'";
$run_select_ultimate_user = mysqli_query($conn,$select_ultimate_user);
$ultimate_user = mysqli_num_rows($run_select_ultimate_user);

$select_total_file = "SELECT * FROM file";
$run_select_total_file = mysqli_query($conn,$select_total_file);
$total_file = mysqli_num_rows($run_select_total_file);


$select_total_image = "SELECT * FROM file WHERE file_type='image'";
$run_select_total_image = mysqli_query($conn,$select_total_image);
$total_image = mysqli_num_rows($run_select_total_image);


$select_total_video = "SELECT * FROM file WHERE file_type='video'";
$run_select_total_video = mysqli_query($conn,$select_total_video);
$total_video = mysqli_num_rows($run_select_total_video);


$select_total_application = "SELECT * FROM file WHERE file_type='application'";
$run_select_total_application = mysqli_query($conn,$select_total_application);
$total_application = mysqli_num_rows($run_select_total_application);


$select_total_text = "SELECT * FROM file WHERE file_type='text'";
$run_select_total_text = mysqli_query($conn,$select_total_text);
$total_text = mysqli_num_rows($run_select_total_text);


$select_total_data = "SELECT * FROM data";
$run_select_total_data = mysqli_query($conn,$select_total_data);
$total_data = mysqli_num_rows($run_select_total_data);


$select_total_wait = "SELECT * FROM file WHERE file_state='wait'";
$run_select_total_wait = mysqli_query($conn,$select_total_wait);
$total_wait = mysqli_num_rows($run_select_total_wait);


$select_total_wallet = "SELECT * FROM wallet";
$run_select_total_wallet = mysqli_query($conn,$select_total_wallet);
$total_wallet = mysqli_num_rows($run_select_total_wallet);


$select_total_pending_wallet = "SELECT * FROM wallet WHERE wallet_status='pending'";
$run_select_total_pending_wallet = mysqli_query($conn,$select_total_pending_wallet);
$total_pending_wallet = mysqli_num_rows($run_select_total_pending_wallet);


$select_total_approve_wallet = "SELECT * FROM wallet WHERE wallet_status='approve'";
$run_select_total_approve_wallet = mysqli_query($conn,$select_total_approve_wallet);
$total_approve_wallet = mysqli_num_rows($run_select_total_approve_wallet);


$sum_approve_wallet = "SELECT SUM(wallet_amount) AS total_amount FROM wallet WHERE wallet_status = 'approve'";
$run_sum_approve_wallet = $conn->query($sum_approve_wallet);
if ($run_sum_approve_wallet) {
    $row_sum_approve_wallet = $run_sum_approve_wallet->fetch_assoc();
    $sum_approve_wallet= $row_sum_approve_wallet['total_amount'];
}

$sum_pending_wallet = "SELECT SUM(wallet_amount) AS total_amount FROM wallet WHERE wallet_status = 'pending'";
$run_sum_pending_wallet = $conn->query($sum_pending_wallet);
if ($run_sum_pending_wallet) {
    $row_sum_pending_wallet = $run_sum_pending_wallet->fetch_assoc();
    $sum_pending_wallet= $row_sum_pending_wallet['total_amount'];
}

?>  
  

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
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
              >
                <i class="fas fa-download fa-sm text-white-50"></i>
                Generate Report
              </a>
            </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body" style="padding: 0.15rem 1.25rem">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >
                          Earnings (Monthly)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          $40,000
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <ul class="list-group list-group-flush homepage-stats-ul">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        A list item
                        <span >14</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        A second list item
                        <span >2</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        A third list item
                        <span >1</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 ">
                  <div class="card-body" style="padding: 0.15rem 1.25rem">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-success text-uppercase mb-1"
                        >
                          Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $total_user;?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <ul class="list-group list-group-flush homepage-stats-ul">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Verified
                        <span ><?php echo $verified_user;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Free
                        <span ><?php echo $free_user;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Paid
                        <span ><?php echo $paid_user;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Starndard
                        <span ><?php echo $standard_user;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Premium
                        <span ><?php echo $premium_user;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ultimate
                        <span ><?php echo $ultimate_user;?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                   <div class="card-body" style="padding: 0.15rem 1.25rem">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-info text-uppercase mb-1"
                        >
                          Files
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $total_file;?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-file fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <ul class="list-group list-group-flush homepage-stats-ul">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Images
                        <span ><?php echo $total_image;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Videos
                        <span ><?php echo $total_video;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                           Appilcation
                        <span ><?php echo $total_application;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Docs
                        <span ><?php echo $total_text;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                         Data
                        <span ><?php echo $total_data;?></span>
                      </li>
                       <li class="list-group-item d-flex justify-content-between align-items-center">
                         Waiting Files
                        <span ><?php echo $total_wait;?></span>
                      </li>
                    </ul>
                    
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body" style="padding: 0.15rem 1.25rem">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                          Wallet
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $total_wallet;?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <hr>
                    <ul class="list-group list-group-flush homepage-stats-ul">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Wallet
                        <span >14</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pending
                        <span ><?php echo $total_pending_wallet;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Approve
                        <span ><?php echo $total_approve_wallet;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pending Amount
                        <span ><?php echo number_format($sum_pending_wallet,2);?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Approve Amount
                        <span ><?php echo number_format($sum_approve_wallet,2);?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->

            <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Current Month Users
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                          Something else here
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  
                  <div class="card-body">
                    <?php 
                    // Get the current month and year
                        $currentMonth = date('m');
                        $currentYear = date('Y');
                        
                        // Prepare an array to hold user counts per day
                        $userCounts = array_fill(1, 31, 0); // 31 days in a month
                        
                        // SQL query to count users registered each day of the current month
                        $current_month_user = "SELECT DAY(created_at) AS day, COUNT(*) AS count
                                FROM user
                                WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear
                                GROUP BY DAY(created_at)";
                        
                        $result_current_month_user = $conn->query($current_month_user);
                        
                        // Populate the userCounts array with the results
                        if ($result_current_month_user) {
                            while ($row_current_month_user = $result_current_month_user->fetch_assoc()) {
                                $userCounts[$row_current_month_user['day']] = $row_current_month_user['count'];
                            }
                        }
                    ?> 
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                      <canvas id="userChart" width="400" height="200"></canvas>
                        <script>
                            // Step 3: Create the Chart
                            const ctx = document.getElementById('userChart').getContext('2d');
                            const userCounts = <?php echo json_encode(array_values($userCounts)); ?>;
                            const labels = Array.from({length: userCounts.length}, (v, k) => k + 1);
                    
                            const myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Total Users Registered This Month',
                                        data: userCounts,
                                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                  </div>
                </div>
              </div>

              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Waiting Files
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                          Something else here
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body p-0 ">
                    <ol class="list-group list-group-numbered pre-scrollable-custom">
                        <?php 
                        // SQL query to fetch records with expiry dates in the current week
                        $select_waiting_file = "SELECT * FROM file WHERE file_state='wait'";
                        
                        $result_select_waiting_file = $conn->query($select_waiting_file);
                        
                        // Check if the query was successful
                        if ($result_select_waiting_file) {
                            // Fetch all records and display them
                            while ($row_waiting_file = $result_select_waiting_file->fetch_assoc()) {
                              $file_id = $row_waiting_file['file_id'];
                                            $wait_file_name = $row_waiting_file['file_name'];
                                            $wait_file_access_key = $row_waiting_file['file_access_key'];
                                            $wait_file_size = $row_waiting_file['file_size'];
                                            $wait_file_date = $row_waiting_file['file_date'];
                                            $wait_file_extension = $row_waiting_file['file_extension'];
                                        
                                            $file_sizeMb =  number_format($wait_file_size / 1024 , 1);

                        ?>
                        
                          <li class="list-group-item d-flex justify-content-between align-items-start p-2">
                            <div class="ms-2 me-auto">
                                <a href="file_details.php?file_access_key=<?php echo $wait_file_access_key;?>">
                                    <div class="fw-bold"><?php echo $wait_file_name;?></div>
                                </a>
                            </div>
                            <small class=""><?php echo $file_sizeMb; ?>Mb</small>
                          </li>
                        
                      <?php } }?>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Current Month Earning
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                          Something else here
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  
                  <div class="card-body">
                    <?php 
                   // SQL query to sum wallet amounts each day of the current month
                    $sqlWallet = "SELECT DAY(wallet_date) AS day, SUM(wallet_amount) AS total_amount
                                  FROM wallet
                                  WHERE MONTH(wallet_date) = $currentMonth AND YEAR(wallet_date) = $currentYear
                                  GROUP BY DAY(wallet_date)";
                    
                    $resultWallet = $conn->query($sqlWallet);
                    
                    // Populate the walletAmounts array with the results
                    if ($resultWallet) {
                        while ($row = $resultWallet->fetch_assoc()) {
                            $walletAmounts[$row['day']] = $row['total_amount'];
                        }
                    }
                    ?> 
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                      <canvas id="walletChart" width="400" height="200"></canvas>
                        <script>
                            const ctxWallet = document.getElementById('walletChart').getContext('2d');
                            const walletAmounts = <?php echo json_encode(array_values($walletAmounts)); ?>;
                    
                            const walletChart = new Chart(ctxWallet, {
                                type: 'line', // Change to 'line' or any other type you prefer
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Total Wallet Amounts This Month',
                                        data: walletAmounts,
                                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                        borderColor: 'rgba(153, 102, 255, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                  </div>
                </div>
              </div>

              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Upcoming Transactions
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                          Something else here
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body p-0">
                    <ol class="list-group list-group-numbered pre-scrollable-custom">
                        <?php 
                        // Get the current date and calculate the start and end of the current week
                        $currentDate = new DateTime();
                        $startOfWeek = new DateTime('monday this week');
                        $endOfWeek = new DateTime('sunday this week');
                        
                        // Format dates for SQL query
                        $startOfWeekFormatted = $startOfWeek->format('Y-m-d');
                        $endOfWeekFormatted = $endOfWeek->format('Y-m-d');
                        
                        // SQL query to fetch records with expiry dates in the current week
                        $select_upcoming_transaction = "SELECT * FROM transaction WHERE transaction_expiry_date BETWEEN '$startOfWeekFormatted' AND '$endOfWeekFormatted'";
                        
                        $result_select_upcoming_transaction = $conn->query($select_upcoming_transaction);
                        
                        // Check if the query was successful
                        if ($result_select_upcoming_transaction) {
                            // Fetch all records and display them
                            while ($row_upcoming_transaction = $result_select_upcoming_transaction->fetch_assoc()) {
                             $transaction_expiry_date =  $row_upcoming_transaction['transaction_expiry_date'];
                             $transaction_amount =  $row_upcoming_transaction['transaction_amount'];
                             $transaction_user_id =  $row_upcoming_transaction['user_id'];

                        ?>
                      <li class="list-group-item d-flex justify-content-between align-items-start p-2">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">$<?php echo number_format($transaction_amount,2);?></div>
                          User: <?php echo $transaction_user_id;?>
                        </div>
                        <small class=""><?php echo $transaction_expiry_date; ?></small>
                      </li>
                      <?php } }?>
                    </ol>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Content Column -->
              <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                  </div>
                  <div class="card-body">
                    <h4 class="small font-weight-bold">
                      Server Migration
                      <span class="float-right">20%</span>
                    </h4>
                    <div class="progress mb-4">
                      <div
                        class="progress-bar bg-danger"
                        role="progressbar"
                        style="width: 20%"
                        aria-valuenow="20"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <h4 class="small font-weight-bold">
                      Sales Tracking
                      <span class="float-right">40%</span>
                    </h4>
                    <div class="progress mb-4">
                      <div
                        class="progress-bar bg-warning"
                        role="progressbar"
                        style="width: 40%"
                        aria-valuenow="40"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <h4 class="small font-weight-bold">
                      Customer Database
                      <span class="float-right">60%</span>
                    </h4>
                    <div class="progress mb-4">
                      <div
                        class="progress-bar"
                        role="progressbar"
                        style="width: 60%"
                        aria-valuenow="60"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <h4 class="small font-weight-bold">
                      Payout Details
                      <span class="float-right">80%</span>
                    </h4>
                    <div class="progress mb-4">
                      <div
                        class="progress-bar bg-info"
                        role="progressbar"
                        style="width: 80%"
                        aria-valuenow="80"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <h4 class="small font-weight-bold">
                      Account Setup
                      <span class="float-right">Complete!</span>
                    </h4>
                    <div class="progress">
                      <div
                        class="progress-bar bg-success"
                        role="progressbar"
                        style="width: 100%"
                        aria-valuenow="100"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                  </div>
                </div>

                <!-- Color System -->
                <div class="row">
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                      <div class="card-body">
                        Primary
                        <div class="text-white-50 small">#4e73df</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                      <div class="card-body">
                        Success
                        <div class="text-white-50 small">#1cc88a</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                      <div class="card-body">
                        Info
                        <div class="text-white-50 small">#36b9cc</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                      <div class="card-body">
                        Warning
                        <div class="text-white-50 small">#f6c23e</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                      <div class="card-body">
                        Danger
                        <div class="text-white-50 small">#e74a3b</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                      <div class="card-body">
                        Secondary
                        <div class="text-white-50 small">#858796</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-light text-black shadow">
                      <div class="card-body">
                        Light
                        <div class="text-black-50 small">#f8f9fc</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="card bg-dark text-white shadow">
                      <div class="card-body">
                        Dark
                        <div class="text-white-50 small">#5a5c69</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Illustrations
                    </h6>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <img
                        class="img-fluid px-3 px-sm-4 mt-3 mb-4"
                        style="width: 25rem"
                        src="img/undraw_posting_photo.svg"
                        alt="..."
                      />
                    </div>
                    <p>
                      Add some quality, svg illustrations to your project
                      courtesy of
                      <a
                        target="_blank"
                        rel="nofollow"
                        href="https://undraw.co/"
                      >
                        unDraw
                      </a>
                      , a constantly updated collection of beautiful svg images
                      that you can use completely paid and without attribution!
                    </p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/">
                      Browse Illustrations on unDraw &rarr;
                    </a>
                  </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Development Approach
                    </h6>
                  </div>
                  <div class="card-body">
                    <p>
                      SB Admin 2 makes extensive use of Bootstrap 4 utility
                      classes in order to reduce CSS bloat and poor page
                      performance. Custom CSS classes are used to create custom
                      components and custom utility classes.
                    </p>
                    <p class="mb-0">
                      Before working with this theme, you should become familiar
                      with the Bootstrap framework, especially the utility
                      classes.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

          <?php require_once('parts/footer.php'); ?>