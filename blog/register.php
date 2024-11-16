<?php require_once('parts/top.php'); ?>

</head>

<body>


    <?php require_once('parts/navbar.php'); ?>
    <main role="main" class="container-fluid my-3">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Join Now</h4>
                    <!-- Form Wizard -->
                    <form id="registrationForm">
                        <div class="step-container active" id="step1">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                    required>
                            </div>
                            <button type="button" class="btn btn-primary" id="next1">Next</button>
                        </div>

                        <div class="step-container" id="step2">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                    required>
                            </div>
                            <button type="button" class="btn btn-secondary" id="prev2">Previous</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>

    <?php require_once('parts/footer.php'); ?>

    <!-- Custom Script -->
    <script>
    $(document).ready(function() {
        // Handle next button click for step 1
        $('#next1').click(function() {
            $('#step1').removeClass('active');
            $('#step2').addClass('active');
        });

        // Handle previous button click for step 2
        $('#prev2').click(function() {
            $('#step2').removeClass('active');
            $('#step1').addClass('active');
        });

        // Handle form submission
        $('#registrationForm').submit(function(e) {
            e.preventDefault();
            // Perform validation or further actions before submission
            alert('Form submitted!');
        });
    });
    </script>