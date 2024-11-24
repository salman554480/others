<?php require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">
   <?php require_once('parts/navbar.php'); ?>
   <div id="layoutSidenav">
      <?php require_once('parts/sidebar.php'); ?>
      <div id="layoutSidenav_content">
         <main>
            <div class="container-fluid px-4">
               <br>
               <h2 class="mt-1">Dashboard</h2>

               <!----start chart
                  <div class="row">
                      <div class="col-xl-6">
                          <div class="card mb-4">
                              <div class="card-header">
                                  <i class="fas fa-chart-area me-1"></i>
                                  Area Chart Example
                              </div>
                              <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                          </div>
                      </div>
                      <div class="col-xl-6">
                          <div class="card mb-4">
                              <div class="card-header">
                                  <i class="fas fa-chart-bar me-1"></i>
                                  Bar Chart Example
                              </div>
                              <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                          </div>
                      </div>
                  </div>
                  end chart--->
            </div>
         </main>
         <?php require_once('parts/footer.php'); ?>
      </div>
   </div>
   <!--Footercdn--->
   <?php require_once('parts/footercdn.php'); ?>
</body>

</html>