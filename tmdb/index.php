<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search TV Show</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Custom styles for the search box */
    .search-box-container {
        margin-top: 100px;
    }

    .search-box {
        max-width: 500px;
        width: 100%;
        margin: 0 auto;
    }

    .search-box .form-control {
        border-radius: 25px;
    }

    .search-box .btn {
        border-radius: 25px;
        width: 100%;
        padding: 10px;
    }
    </style>
</head>

<body>

    <!-- User Input Form -->
    <div class="container">
        <div class="search-box-container">
            <form method="POST" action="process.php" class="search-box">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <input type="text" name="showName" class="form-control" placeholder="Enter TV Show Name"
                            required>
                    </div>
                    <div class="col-md-4 mt-2 mt-md-0">
                        <button type="submit" class="btn btn-primary btn-block">Get Seasons</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for interactions like dropdowns) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>