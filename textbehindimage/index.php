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

    <?php require_once('parts/navbar.php'); ?>

    <div class="container-fluid bg-white">
        <div class="container hero-section">
            <div class="row">
                <div class="col-md-5">
                    <h1 class="hero-heading">Create Text Behind Image</h1>
                    <p class="hero-text">Create stunning text-behind-image effects in seconds. No design skills needed.
                    </p>
                    <form method="POST" enctype="multipart/form-data">

                        <div class="custom-file mb-2">
                            <input type="file" name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>
                        <button class="btn btn-success btn-lg" type="submit" id="inputGroupFileAddon04">Create</button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
                        // Replace with your remove.bg API key
                        $apiKey = $api;

                        // Handle the uploaded image
                        $image = $_FILES['image'];

                        list($width, $height) = getimagesize($image['tmp_name']);

                        // Set the maximum size limit (800px)
                        $maxSize = 550;

                        // Check if the width or height is larger than the maximum size
                        if ($width > $maxSize || $height > $maxSize) {
                            // Calculate the scaling factor
                            if ($width > $height) {
                                // Scale the width to max size, calculate height accordingly
                                $newWidth = $maxSize;
                                $newHeight = floor($height * ($maxSize / $width));
                            } else {
                                // Scale the height to max size, calculate width accordingly
                                $newHeight = $maxSize;
                                $newWidth = floor($width * ($maxSize / $height));
                            }

                            // Resize the image using the new dimensions
                            // Create a new image resource
                            $srcImage = imagecreatefromjpeg($image['tmp_name']);  // You can change this to match your image type (e.g., imagecreatefrompng for PNG images)

                            // Create a new true color image with the resized dimensions
                            $dstImage = imagecreatetruecolor($newWidth, $newHeight);

                            // Resize the image
                            imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                            // Save the resized image to a file or send it to the next step (e.g., remove.bg API)
                            // For example, you can save it locally
                            $resizedImagePath = 'path/to/save/resized_image.jpg';
                            imagejpeg($dstImage, $resizedImagePath);

                            // Clean up
                            imagedestroy($srcImage);
                            imagedestroy($dstImage);
                        }

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
                            $insert_file = "INSERT INTO file(file_code,file_height,file_width) VALUES('$randomCode','$newHeight','$newWidth')";
                            $run_insert_file =  mysqli_query($conn, $insert_file);
                            if ($run_insert_file) {
                                echo "<script>window.open('starter.php?code=$randomCode','_self');</script>";
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <div class="before-after-container">
                        <div class="before" style="background-image: url('assets/img/before.png');"></div>
                        <div class="after" style="background-image: url('assets/img/after.png');"></div>
                        <div class="slider" id="slider">
                            <div class="slider-button" id="sliderButton"></div> <!-- Slider button -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    // Add the event listener to the slider for mouse interaction
    const slider = document.getElementById('slider');
    const beforeImage = document.querySelector('.before');
    const afterImage = document.querySelector('.after');

    let isDragging = false;

    slider.addEventListener('mousedown', (e) => {
        isDragging = true;
        document.body.style.userSelect = 'none'; // Disable text selection while dragging
    });

    document.addEventListener('mousemove', (e) => {
        if (isDragging) {
            let containerRect = slider.parentElement.getBoundingClientRect();
            let offsetX = e.clientX - containerRect.left;
            let width = Math.min(Math.max(0, offsetX), containerRect.width);
            afterImage.style.width = width + 'px';
            slider.style.left = width + 'px';
        }
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
        document.body.style.userSelect = 'auto'; // Re-enable text selection
    });
    </script>
    <div class="container gallery py-5">
        <div class="masonry-list">
            <img src="assets/img/uc1.webp" alt="">
            <img src="assets/img/uc2.webp" alt="">
            <img src="assets/img/uc3.webp" alt="">
            <img src="assets/img/uc4.webp" alt="">
            <img src="assets/img/uc5.webp" alt="">
            <img src="assets/img/uc6.webp" alt="">
            <img src="assets/img/uc7.webp" alt="">
            <img src="assets/img/uc8.webp" alt="">
            <img src="assets/img/uc9.webp" alt="">
            <img src="assets/img/uc10.webp" alt="">
        </div>

    </div>

    <div class="container py-5">
        <div class="ad-area my-4">
            <?php if ($ad_code_one == "") {
                echo "<img class='w-100' src='https://dummyimage.com/1400x150/a7a7a7/000000&text=++++++++++++++++Advertisement+++++++++++++'>";
            } {
                echo $ad_code_one;
            } ?>
        </div>
        <h2 class="text-center">Frequently Asked Questions</h2>
        <div id="faqAccordion" class="my-4">
            <!-- FAQ Item 1 -->
            <?php
            $select_faq = "SELECT * FROM faq";
            $run_faq =  mysqli_query($conn, $select_faq);
            while ($row_faq =  mysqli_fetch_array($run_faq)) {
                $faq_id =  $row_faq['faq_id'];
                $faq_question =  $row_faq['faq_question'];
                $faq_answer =  $row_faq['faq_answer'];
            ?>
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse"
                            data-target="#collapse<?php echo $faq_id; ?>" aria-expanded="true"
                            aria-controls="collapse<?php echo $faq_id; ?>">
                            <?php echo $faq_question; ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?php echo $faq_id; ?>" class="collapse " aria-labelledby="headingOne"
                    data-parent="#faqAccordion">
                    <div class="card-body">
                        <?php echo $faq_answer; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center">Latest Blog</h2>
            <div class="row my-4">
                <!-- Blog Post 1 -->
                <?php

                require_once('admin/parts/db.php');
                $select = "SELECT * FROM post WHERE post_status='publish' ORDER BY post_id DESC LIMIT 3";
                $run = mysqli_query($conn, $select);
                while ($row = mysqli_fetch_array($run)) {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_url = $row['post_url'];

                    $post_thumbnail = $row['post_thumbnail'];
                    $post_content = $row['post_content'];

                    // Remove HTML tags
                    $plain_text = strip_tags($post_content);

                    // Decode HTML entities to their corresponding characters
                    $plain_text = html_entity_decode($plain_text);

                    // Optionally, remove extra whitespace
                    $plain_text = trim(preg_replace('/\s+/', ' ', $plain_text));

                ?>
                <div class="col-md-4 mb-4">
                    <div class="card blog-card">
                        <a href="post_details.php?post_url=<?php echo $post_url; ?>">
                            <img class="card-img-top" src="admin/upload/<?php echo $post_thumbnail; ?>"
                                alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="post_details.php?post_url=<?php echo $post_url; ?>" <h5
                                class="card-title"><?php echo substr($post_title, 0, 60); ?></h5>
                                <?php if (strlen($post_title) > 50) {
                                        echo "...";
                                    } ?>
                            </a>
                            <p class="card-text"><?php echo substr($post_content, 8, 50) ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="d-flex justify-content-center">
                <a href="page.php?page_url=blog" class="btn btn-primary">View More</a>
            </div>
        </div>
    </section>


    <?php require_once('parts/footer.php'); ?>

</body>

</html>