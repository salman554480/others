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
    move_uploaded_file($image['tmp_name'], $backgroundImagePath);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Remover</title>
    <style>
    #output {
        margin-top: 20px;
    }

    .image-container {
        margin-top: 20px;
    }

    img {
        max-width: 100%;
    }
    </style>
</head>

<body>
    <h1>Upload an Image to Remove the Background</h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload and Remove Background</button>
    </form>

    <?php if (isset($frontImagePath) && isset($backgroundImagePath)): ?>
    <div class="image-container">
        <h2>Foreground (Without Background):</h2>
        <img src="<?php echo $frontImagePath; ?>" alt="Foreground Image">
        <a href="<?php echo $frontImagePath; ?>" download="<?php echo basename($frontImagePath); ?>">Download Foreground
            Image</a>
    </div>

    <div class="image-container">
        <h2>Background (Original Image):</h2>
        <img src="<?php echo $backgroundImagePath; ?>" alt="Background Image">
        <a href="<?php echo $backgroundImagePath; ?>" download="<?php echo basename($backgroundImagePath); ?>">Download
            Background Image</a>
    </div>
    <?php endif; ?>

</body>

</html>