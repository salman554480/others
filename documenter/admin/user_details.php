<?php require_once('parts/top.php'); ?>
  </head>
<?php 
if(isset($_GET['user_id'])){
    $user_id =  $_GET['user_id'];
    
     $select_user = "SELECT * FROM user WHERE user_id='$user_id' ";
    $run_user = mysqli_query($conn, $select_user);
    $row_user = mysqli_fetch_array($run_user);

    $user_id = $row_user['user_id'];
    $user_email = $row_user['user_email'];
    $user_name = $row_user['user_name'];
    $user_image = $row_user['user_image'];
    $user_contact = $row_user['user_contact'];
    $user_address = $row_user['user_address'];
    $user_password = $row_user['user_password'];
    $user_created_at = $row_user['created_at'];
    $package_id = $row_user['package_id'];
    $user_balance = $row_user['user_balance'];

    $select_package = "SELECT * FROM package WHERE package_id='$package_id' ";
    $run_package = mysqli_query($conn, $select_package);
    $row_package = mysqli_fetch_array($run_package);

    $package_name = $row_package['package_name'];
    $package_amount = $row_package['package_amount'];
    $package_storage = $row_package['package_storage'];
    $package_duration = $row_package['package_duration'];


    $select_account_size = "SELECT SUM(file_size) AS file_size FROM file WHERE user_id='$user_id' and  file_status!='delete' ";
   $run_account_size = mysqli_query($conn, $select_account_size);
   if(mysqli_num_rows($run_account_size) > 0){
   $row_account_size =  mysqli_fetch_array($run_account_size);
   $total_account_size =  $row_account_size['file_size'];
   $total_storage_in_kb = $total_account_size / 1024;
     $total_storage_in_gb = $total_account_size / 1048576;
   }else{
       $total_storage_in_kb = 0;
     $total_storage_in_gb = 0;
   }

  $remaining_storage = $package_storage - round($total_storage_in_gb);
   $usage_percentage = $total_storage_in_gb * 100 / $package_storage;
    $remaining_usage =  100 - $usage_percentage;
   
   
   
   
         
                        $count_referal = "SELECT * FROM user where user_referal_id='$user_id'";
                        $run_count_referal =  mysqli_query($conn,$count_referal);
                        $total_referal = mysqli_num_rows($run_count_referal);
                         $total_earning = $total_referal * 0.1; 
                       


              // Function to get the total number of rows and total size for a specific file type
              function getFileData($conn, $fileType, $userId) {
                  // Ensure user ID is properly escaped to prevent SQL injection
                  $fileType = mysqli_real_escape_string($conn, $fileType);
                  $userId = mysqli_real_escape_string($conn, $userId);
              
                  // Query to count files
                  $count_query = "SELECT COUNT(*) AS total_files FROM file WHERE file_type='$fileType' AND user_id='$userId'";
                  $count_result = mysqli_query($conn, $count_query);
                  if ($count_result) {
                      $count_row = mysqli_fetch_assoc($count_result);
                      $total_files = $count_row['total_files'];
                  } else {
                      echo "Error counting files: " . mysqli_error($conn);
                      $total_files = 0;
                  }
              
                  // Query to sum file sizes
                  $size_query = "SELECT SUM(file_size) AS total_size FROM file WHERE file_type='$fileType' AND user_id='$userId'";
                  $size_result = mysqli_query($conn, $size_query);
                  if ($size_result) {
                      $size_row = mysqli_fetch_assoc($size_result);
                      $total_size = $size_row['total_size'];
                      $total_size_mb = number_format($total_size / 1024, 1); // Convert bytes to MB
                  } else {
                      echo "Error calculating size: " . mysqli_error($conn);
                      $total_size = 0;
                      $total_size_mb = 0;
                  }
              
                  return [$total_files, $total_size_mb];
              }
              
              // Example user_id (ensure this is set appropriately in your actual code)
              $user_id = isset($user_id) ? $user_id : 0; // Replace 0 with a default or handle it as needed
              
              // Get data for different file types
              list($total_application_files, $application_size_mb) = getFileData($conn, 'application', $user_id);
              list($total_image_files, $image_size_mb) = getFileData($conn, 'image', $user_id);
              list($total_video_files, $video_size_mb) = getFileData($conn, 'video', $user_id);
              list($total_text_files, $text_size_mb) = getFileData($conn, 'text', $user_id);
              
              
                         $count_referal = "SELECT * FROM user where user_referal_id='$user_id'";
                        $run_count_referal =  mysqli_query($conn,$count_referal);
                        $total_referal = mysqli_num_rows($run_count_referal);
                         $total_earning = $total_referal * 0.1; 
    
    
    
     $date = new DateTime($user_created_at);
        $user_created_at = $date->format('F d, Y');

        $select_transaction = "SELECT * FROM transaction WHERE user_id='$user_id' ORDER BY transaction_id DESC LIMIT 1";
        $result_transaction = mysqli_query($conn, $select_transaction);
        if(mysqli_num_rows($result_transaction) > 0){
        $row_transaction = mysqli_fetch_assoc($result_transaction);
        $transaction_id = $row_transaction['transaction_id'];
        $transaction_date = $row_transaction['transaction_date'];
        $transaction_expiry_date = $row_transaction['transaction_expiry_date'];

        $transaction_date = new DateTime($transaction_date);
        $transaction_date = $transaction_date->format('d M, Y');

        $transaction_expiry_date = new DateTime($transaction_expiry_date);
        $formatted_expiry_date = $transaction_expiry_date->format('d M, Y');


        // Get the current date
        $current_date = new DateTime();

        // Calculate the difference between the current date and the expiry date
        $interval = $current_date->diff($transaction_expiry_date);

        // Get the total number of days
        $total_days = $interval->days;
        }
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
              <h1 class="h3 mb-0 text-gray-800"><?php echo $user_name;?></h1>
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
              <div class="col-6 col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >
                          Package
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $package_name;?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-6 col-xl-2 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-success text-uppercase mb-1"
                        >
                          Files
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $total_application_files;?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <?php echo $application_size_mb;?> Mbs
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-6 col-xl-2 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-info text-uppercase mb-1"
                        >
                          Usage
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div
                              class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                            >
                              <?php echo round($usage_percentage);?>%
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width: <?php echo round($usage_percentage);?>%"
                                aria-valuenow="<?php echo round($usage_percentage);?>"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-6 col-xl-2 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                         Earning
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          $<?php echo $total_earning;?>
                        </div>
                      </div>
                      <div class="col-auto">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <!-- Pending Requests Card Example -->
                
              <div class="col-6 col-xl-2 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                         Balance
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          $<?php echo number_format($user_balance,2);?>
                        </div>
                      </div>
                      <div class="col-auto">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              <div class="col-6 col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                         Referals
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $total_referal;?>
                        </div>
                      </div>
                      <div class="col-auto">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              
            </div>


            <!-- Content Row -->

            <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Earnings Overview
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-area">
                      <canvas id="sadsadusasdsadagesadsaChart" width="100%"></canvas>
                    </div>
                  </div>
                </div>
              </div>


              
                
              <!-- Pie Chart -->
              <div class="col-xl-3 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Revenue Sources
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <ol class="list-group list-group-numbered">
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Files</div>
                          <?php echo $application_size_mb;?> Mb
                        </div>
                        <span ><?php echo $total_application_files;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Images</div>
                          <?php echo $image_size_mb;?> Mb
                        </div>
                        <span ><?php echo $total_image_files;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Videos</div>
                          <?php echo $video_size_mb;?> Mb
                        </div>
                        <span><?php echo $total_video_files;?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Documents</div>
                          <?php echo $text_size_mb;?> Mb
                        </div>
                        <span><?php echo $total_text_files;?></span>
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
              
              <div class="col-xl-3 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      Revenue Sources
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <ul class="list-group" style="font-size:12px">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Package
                            <span class="#"><?php echo $package_name; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email
                            <span class="#"><?php echo $user_email; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Member Since
                            <span class="#"><?php echo $user_created_at; ?></span>
                        </li>
                        <?php if ($package_id != 1) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Last Payment
                            <span class="#"><?php echo $transaction_date; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Exipry Date
                            <span class="#"><?php echo $formatted_expiry_date; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Remaining Days
                            <span class="#"><?php echo $total_days; ?> </span>
                        </li>
                        <?php } ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Space Used
                            <span class="#"><?php echo number_format($total_storage_in_gb, 2); ?>/<?php echo $package_storage ?>
                                Gbs </span>
                        </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->
            <div class="row">
              <!-- Content Column -->
              <div class="col-lg-8 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                  </div>
                  <div class="card-body">
                      <canvas id="recordsChartDay" width="100%"></canvas>
                  </div>
                </div>

                <!-- Color System -->
               <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                  </div>
                  <div class="card-body">
                      <canvas id="recordsChartMonth" width="100%"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Illustrations
                    </h6>
                  </div>
                  <div class="card-body ">
                      <canvas id="usageChart" width="100%"></canvas>
                  </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Development Approach
                    </h6>
                  </div>
                  <div class="card-body ">
                     <canvas id="fileTypeChart" width="300px" height="300px" ></canvas>
                  </div>
                  
                   
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                // Data
                const usage = <?php echo round($usage_percentage) ?>;
                const remaining = <?php echo round($remaining_usage); ?>;

                // Create the chart
                const ctx = document.getElementById('usageChart').getContext('2d');
                const usageChart = new Chart(ctx, {
                    type: 'doughnut', // Type of chart
                    data: {
                        labels: ['Usage', 'Remaining'],
                        datasets: [{
                            data: [usage, remaining],
                            backgroundColor: ['#FF6384',
                                '#36A2EB'
                            ], // Colors for each segment
                            borderColor: ['#fff', '#fff'], // Border color for each segment
                            borderWidth: 1 // Border width
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
                </script>
                
                
                
                
                
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js">
                                </script>
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const user_id = <?php echo json_encode($user_id); ?>; // Replace this with the actual user ID or a variable containing it
                        
                            // Fetch data from the server
                            fetch(`../fetch_data.php?user_id=${encodeURIComponent(user_id)}`) // Adjust the path and include user_id
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log(data); // Debug: Check the data received

                                            const ctx = document.getElementById('recordsChartMonth')
                                                .getContext(
                                                    '2d');
                                            new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: data.months,
                                                    datasets: [{
                                                        label: 'Number of Files',
                                                        data: data.counts,
                                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                        borderColor: 'rgba(54, 162, 235, 1)',
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        x: {
                                                            title: {
                                                                display: true,
                                                                text: 'Month'
                                                            }
                                                        },
                                                        y: {
                                                            beginAtZero: true,
                                                            title: {
                                                                display: true,
                                                                text: 'File Count'
                                                            }
                                                        }
                                                    },
                                                    plugins: {
                                                        legend: {
                                                            display: true,
                                                            position: 'top'
                                                        },
                                                        tooltip: {
                                                            enabled: true
                                                        }
                                                    }
                                                }
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:',
                                                error); // Debug: Check for errors in fetching data
                                        });
                                });
                                </script>
                                
                                
                                
                                
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js">
                                </script>
                                <script>
                                // Fetch data from the server
                                const user_id = <?php echo json_encode($user_id); ?>; // Replace this with the actual user ID or a variable containing it
                        
                            // Fetch data from the server
                            fetch(`../fetch_data_date.php?user_id=${encodeURIComponent(user_id)}`) // Adjust the path and include user_id
                                    .then(response => response.json())
                                    .then(data => {
                                        // Prepare data for the chart
                                        const ctx = document.getElementById('recordsChartDay').getContext(
                                            '2d');
                                        new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: data.dates,
                                                datasets: [{
                                                    label: 'Number of Records',
                                                    data: data.counts,
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                    borderWidth: 1,
                                                    fill: true
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                scales: {
                                                    x: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Date'
                                                        }
                                                    },
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Number of Images'
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Error fetching data:', error);
                                    });
                                </script> 
                                
                                
                                
         <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const ctx = document.getElementById('fileTypeChart').getContext('2d');
                             const user_id = <?php echo json_encode($user_id); ?>; // Replace this with the actual user ID or a variable containing it
                        
                            // Fetch data from the server
                            fetch(`../file_type_data.php?user_id=${encodeURIComponent(user_id)}`) 
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Data fetched:', data); // Debugging line

                                            const labels = Object.keys(data);
                                            const values = Object.values(data);
                                            const total = values.reduce((a, b) => a + b, 0);

                                            const chartData = {
                                                labels: labels,
                                                datasets: [{
                                                    data: values,
                                                    backgroundColor: ['#FF6384', '#36A2EB',
                                                        '#FFCE56', '#4BC0C0'
                                                    ],
                                                    hoverOffset: 4
                                                }]
                                            };

                                            const config = {
                                                type: 'pie',
                                                data: chartData,
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'top',
                                                        },
                                                        tooltip: {
                                                            callbacks: {
                                                                label: function(tooltipItem) {
                                                                    const dataset = tooltipItem
                                                                        .dataset;
                                                                    const total = dataset.data
                                                                        .reduce((sum, value) =>
                                                                            sum + value, 0);
                                                                    const currentValue = dataset
                                                                        .data[tooltipItem
                                                                            .dataIndex];
                                                                    const percentage = ((
                                                                        currentValue / total
                                                                    ) * 100).toFixed(2);
                                                                    return `${tooltipItem.label}: ${percentage}%`;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            };

                                            new Chart(ctx, config);
                                        })
                                        .catch(error => console.error('Error fetching data:', error));
                                });
                                </script>                        

          <?php require_once('parts/footer.php'); ?>