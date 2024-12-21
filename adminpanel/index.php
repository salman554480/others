<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 4 Offline Example</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/cbffea6533.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>


    <div class="navbar navbar-light bg-light navbar-expand-md">
        <div class="container">
            <!-- <a class="navbar-brand" href="/">
                Brand
            </a> -->
            <button type="button" class="navbar-toggler" data-toggle="collapse"
                data-target=".navbar-collapse">☰</button>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="dropdown menu-large nav-item"> <a href="#" class="dropdown-toggle nav-link"
                            data-toggle="dropdown"> Product Listing </a>
                        <ul class="dropdown-menu megamenu">
                            <li class="dropdown-item">
                                <div class="row">
                                    <div class="col-md-6 col-lg-3 text-center">
                                        <div class="card">
                                            <a href="#" class="thumbnail">
                                                <img src="http://placehold.it/150x120">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 text-center">
                                        <div class="card">
                                            <a href="#" class="thumbnail">
                                                <img src="http://placehold.it/150x120">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 text-center">
                                        <div class="card">
                                            <a href="#" class="thumbnail">
                                                <img src="http://placehold.it/150x120">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3 text-center">
                                        <div class="card">
                                            <a href="#" class="thumbnail">
                                                <img src="http://placehold.it/150x120">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown menu-large nav-item"> <a href="#" class="dropdown-toggle nav-link"
                            data-toggle="dropdown">Categories </a>
                        <ul class="dropdown-menu megamenu">
                            <div class="row">
                                <li class="col-md-3 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header">Glyphicons</li>
                                        <li><a href="#">Available glyphs</a>
                                        </li>
                                        <li class="disabled"><a href="#">How to use</a>
                                        </li>
                                        <li><a href="#">Examples</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Dropdowns</li>
                                        <li><a href="#">Example</a>
                                        </li>
                                        <li><a href="#">Aligninment options</a>
                                        </li>
                                        <li><a href="#">Headers</a>
                                        </li>
                                        <li><a href="#">Disabled menu items</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-md-3 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header">Button groups</li>
                                        <li><a href="#">Basic example</a>
                                        </li>
                                        <li><a href="#">Button toolbar</a>
                                        </li>
                                        <li><a href="#">Sizing</a>
                                        </li>
                                        <li><a href="#">Nesting</a>
                                        </li>
                                        <li><a href="#">Vertical variation</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Button dropdowns</li>
                                        <li><a href="#">Single button dropdowns</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-md-3 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header">Input groups</li>
                                        <li><a href="#">Basic example</a>
                                        </li>
                                        <li><a href="#">Sizing</a>
                                        </li>
                                        <li><a href="#">Checkboxes and radio addons</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Navs</li>
                                        <li><a href="#">Tabs</a>
                                        </li>
                                        <li><a href="#">Pills</a>
                                        </li>
                                        <li><a href="#">Justified</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-md-3 dropdown-item">
                                    <ul>
                                        <li class="dropdown-header">Navbar</li>
                                        <li><a href="#">Default navbar</a>
                                        </li>
                                        <li><a href="#">Buttons</a>
                                        </li>
                                        <li><a href="#">Text</a>
                                        </li>
                                        <li><a href="#">Non-nav links</a>
                                        </li>
                                        <li><a href="#">Component alignment</a>
                                        </li>
                                        <li><a href="#">Fixed to top</a>
                                        </li>
                                        <li><a href="#">Fixed to bottom</a>
                                        </li>
                                        <li><a href="#">Static top</a>
                                        </li>
                                        <li><a href="#">Inverted navbar</a>
                                        </li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-90 py-5 mx-auto">
        <div class="row">
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Orders</p>
                                        <h4 class="my-1 text-info">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Revenue</p>
                                        <h4 class="my-1 text-danger">$84,245</h4>
                                        <p class="mb-0 font-13">+5.4% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                            class="fa fa-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Bounce Rate</p>
                                        <h4 class="my-1 text-success">34.6%</h4>
                                        <p class="mb-0 font-13">-4.5% from last week</p>
                                    </div>
                                    <div
                                        class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                        <i class="fa fa-bar-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Customers</p>
                                        <h4 class="my-1 text-warning">8.4K</h4>
                                        <p class="mb-0 font-13">+8.4% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="area">
                            <h4 class="area-heading">User Activity</h4>
                            <!-- <small class="text-muted">This Month</small>
                            <h5>$25,000</h5> -->
                            <canvas id="myDonutChart" class="mt-3" width="100%" height="400"></canvas>


                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="area">
                            <h4 class="area-heading">User Activity</h4>
                            <canvas id="myLineChart" class="mt-3" width="400" height="400"></canvas>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="area">
                            <h4 class="area-heading">User Activity</h4>
                            <ul class="list-group list-group-flush">
                                <!-- Task 1 -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="task1">
                                        <label class="form-check-label" for="task1">
                                            Task 1: Finish the report
                                        </label>
                                    </div>
                                </li>
                                <!-- Task 2 -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="task2">
                                        <label class="form-check-label" for="task2">
                                            Task 2: Call the client
                                        </label>
                                    </div>
                                </li>
                                <!-- Task 3 -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="task3">
                                        <label class="form-check-label" for="task3">
                                            Task 3: Submit the invoice
                                        </label>
                                    </div>
                                </li>
                                <!-- Task 4 -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="task4">
                                        <label class="form-check-label" for="task4">
                                            Task 4: Organize the meeting
                                        </label>
                                    </div>
                                </li>
                                <!-- Task 4 -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="task4">
                                        <label class="form-check-label" for="task4">
                                            Task 4: Organize the meeting
                                        </label>
                                    </div>
                                </li>
                                <!-- Task 4 -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="task4">
                                        <label class="form-check-label" for="task4">
                                            Task 4: Organize the meeting
                                        </label>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="area">
                            <h4 class="area-heading">Recent Users</h4>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>

                                        <td>
                                            <img src="https://avatar.iran.liara.run/public" class=" rounded-circle"
                                                height="35px" alt="User Image">
                                            John Doe
                                        </td>
                                        <td>johndoe@example.com</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>

                                        <td><img src="https://avatar.iran.liara.run/public" class=" rounded-circle"
                                                height="35px" alt="User Image"> Jane Smith</td>
                                        <td>janesmith@example.com</td>
                                        <td><span class="badge badge-danger">Unpaid</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><img src="https://avatar.iran.liara.run/public" class=" rounded-circle"
                                                height="35px" alt="User Image"> Samuel Lee</td>
                                        <td>samuellee@example.com</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><img src="https://avatar.iran.liara.run/public" class=" rounded-circle"
                                                height="35px" alt="User Image"> Alice Johnson</td>
                                        <td>alicej@example.com</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Orders</p>
                                        <h4 class="my-1 text-info">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Revenue</p>
                                        <h4 class="my-1 text-danger">$84,245</h4>
                                        <p class="mb-0 font-13">+5.4% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                            class="fa fa-dollar" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Bounce Rate</p>
                                        <h4 class="my-1 text-success">34.6%</h4>
                                        <p class="mb-0 font-13">-4.5% from last week</p>
                                    </div>
                                    <div
                                        class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Customers</p>
                                        <h4 class="my-1 text-warning">8.4K</h4>
                                        <p class="mb-0 font-13">+8.4% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Orders</p>
                                        <h4 class="my-1 text-info">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Revenue</p>
                                        <h4 class="my-1 text-danger">$84,245</h4>
                                        <p class="mb-0 font-13">+5.4% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                            class="fa fa-dollar" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
    // Wait until the DOM is fully loaded to run the script
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myDonutChart').getContext('2d');

        var myDonutChart = new Chart(ctx, {
            type: 'doughnut', // Specifies that this is a donut chart
            data: {
                labels: ['Red', 'Blue', 'Yellow'], // Labels for each section
                datasets: [{
                    label: 'My First Donut Chart',
                    data: [300, 50, 100], // Values for each section
                    backgroundColor: ['#6078ea', '#ff7676',
                        '#96c93d'
                    ], // Colors for each section
                    hoverOffset: 4 // Makes the section "pop out" when hovered over
                }]
            },
            options: {
                responsive: true, // Ensures the chart resizes with the window
                plugins: {
                    legend: {
                        position: 'bottom', // Position of the legend
                    },
                    tooltip: {
                        enabled: true // Enables tooltips on hover
                    }
                }
            }
        });
    });
    </script>

    <script>
    // Wait until the DOM is fully loaded to run the script
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myLineChart').getContext('2d');

        var myLineChart = new Chart(ctx, {
            type: 'line', // Specifies that this is a line chart
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'], // X-axis labels
                datasets: [{
                    label: 'Monthly Sales', // The label for the line
                    data: [65, 59, 80, 81, 56], // Y-axis data points
                    borderColor: '#FF5733', // Line color
                    backgroundColor: 'rgba(255, 87, 51, 0.2)', // Fill color (optional, if area under the line is filled)
                    fill: true, // Optionally fill the area under the line
                    tension: 0.4 // Controls the curve of the line (higher = smoother)
                }]
            },
            options: {
                responsive: true, // Ensures the chart resizes with the window
                scales: {
                    y: {
                        beginAtZero: true // Makes sure the y-axis starts at zero
                    }
                },
                plugins: {
                    legend: {
                        position: 'top', // Position of the legend
                    },
                    tooltip: {
                        enabled: true // Enables tooltips on hover
                    }
                }
            }
        });
    });
    </script>

    </script>


    <!-- Link to Bootstrap JS (with Popper.js) -->
    <script src="assets/bootstrap/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/bootstrap/popper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="assets/js/script.js"></script>
</body>

</html>