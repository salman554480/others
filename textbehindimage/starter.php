<?php
require_once('admin/parts/db.php');
$select_page = "SELECT * FROM page WHERE page='homepage'";
$run_page = mysqli_query($conn, $select_page);
$row_page =  mysqli_fetch_array($run_page);
$page_title =  $row_page['page_title'];
$page_content =  $row_page['page_content'];
$meta_title =  $row_page['meta_title'];
$meta_description =  $row_page['meta_description'];
$meta_keywords =  $row_page['meta_keywords'];

?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
        // Replace with your remove.bg API key
        $apiKey = 'gKzRiCoDmu1Pj8xy3MEDohny';

        // Handle the uploaded image
        $image = $_FILES['image'];

        // Check if file is an image
        if (getimagesize($image['tmp_name']) === false) {
            echo "The uploaded file is not a valid image.";
            exit;
        }

        // Generate an 8-digit random code
        $randomCode = strtoupper(bin2hex(random_bytes(4))); // 8-digit random code (hexadecimal)

        // Prepare upload directory
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create directory if not exists
        }

        // Define the paths for foreground and background images
        $frontImagePath = $uploadDir . $randomCode . '_foreground.png';
        $backgroundImagePath = $uploadDir . $randomCode . '_background.png';

        // Send image to remove.bg API
        $formData = [
            'image_file' => new CURLFile($image['tmp_name']),
            'size' => 'auto', // Auto size for processing
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Api-Key: ' . $apiKey,
        ]);

        $response = curl_exec($ch);

        // Check for errors in cURL request
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
            exit;
        }
        curl_close($ch);

        // Debugging: Output the response from the API
        if (empty($response)) {
            echo 'Error: The response from remove.bg is empty.';
            exit;
        }

        // Save the front image (foreground) to the uploads folder
        $foregroundSaved = file_put_contents($frontImagePath, $response);

        if ($foregroundSaved === false) {
            echo 'Error: Unable to save the foreground image.';
            exit;
        }

        // Save the background image (original) to the uploads folder
        if (move_uploaded_file($image['tmp_name'], $backgroundImagePath)) {
            $insert_file = "INSERT INTO file(file_code) VALUES('$randomCode')";
            $run_insert_file =  mysqli_query($conn, $insert_file);
            if ($run_insert_file) {
                echo "<script>window.open('starter.php?code=$randomCode','_self');</script>";
            }
        }
    }
    ?>

    <?php require_once('parts/navbar.php'); ?>
    <div class="container">
        <h1 class="starter-heading">Upload Image</h1>
        <div class="row">
            <div class="col-md-5">

                <form method="POST" enctype="multipart/form-data">

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="inputGroupFile04"
                                aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-success btn-sm" type="submit"
                                id="inputGroupFileAddon04">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <?php if (isset($frontImagePath) && isset($backgroundImagePath)): ?>
            <div class="image-container">
                <h2>Foreground (Without Background):</h2>
                <img src="<?php echo $frontImagePath; ?>" alt="Foreground Image">
                <a href="<?php echo $frontImagePath; ?>" download="<?php echo basename($frontImagePath); ?>">Download
                    Foreground
                    Image</a>
            </div>

            <div class="image-container">
                <h2>Background (Original Image):</h2>
                <img src="<?php echo $backgroundImagePath; ?>" alt="Background Image">
                <a href="<?php echo $backgroundImagePath; ?>"
                    download="<?php echo basename($backgroundImagePath); ?>">Download
                    Background Image</a>
            </div>
        <?php endif; ?>
    </div>
    <?php require_once('parts/footer.php'); ?>

</body>

</html>