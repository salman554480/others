<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['original_image']) && isset($_FILES['watermark_image'])) {
    // Process the uploaded files and add the watermark
    $original_image_path = $_FILES['original_image']['tmp_name'];
    $watermark_image_path = $_FILES['watermark_image']['tmp_name'];

    // Get the user's inputs
    $watermark_position = $_POST['watermark_position']; // Position option (top-left, etc.)
    $watermark_size = intval($_POST['watermark_size']); // Watermark size (in px)

    // Define the output image path
    $output_image_path = mt_rand() . '_watermarked_image.png'; // This can be dynamic if needed

    // Function to add watermark
    function add_watermark($original_image_path, $watermark_image_path, $output_image_path, $watermark_position, $watermark_size)
    {
        // Load the original image and watermark image
        $original_image = imagecreatefromstring(file_get_contents($original_image_path));
        $watermark_image = imagecreatefromstring(file_get_contents($watermark_image_path));

        // Get dimensions of the original image
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        // Calculate the watermark size (maintain aspect ratio)
        $watermark_width = $watermark_size;
        $watermark_height = imagesy($watermark_image) * ($watermark_width / imagesx($watermark_image));

        // Resize the watermark to the specified size
        $resized_watermark = imagescale($watermark_image, $watermark_width, $watermark_height);

        // Get new dimensions of the resized watermark
        $resized_watermark_width = imagesx($resized_watermark);
        $resized_watermark_height = imagesy($resized_watermark);

        // Calculate position for the watermark based on user's choice
        switch ($watermark_position) {
            case 'top-left':
                $x_position = 0;
                $y_position = 0;
                break;
            case 'top-right':
                $x_position = $original_width - $resized_watermark_width;
                $y_position = 0;
                break;
            case 'bottom-left':
                $x_position = 0;
                $y_position = $original_height - $resized_watermark_height;
                break;
            case 'bottom-right':
                $x_position = $original_width - $resized_watermark_width;
                $y_position = $original_height - $resized_watermark_height;
                break;
            default:
                $x_position = 0;
                $y_position = 0;
                break;
        }

        // Merge the watermark onto the original image
        imagecopy($original_image, $resized_watermark, $x_position, $y_position, 0, 0, $resized_watermark_width, $resized_watermark_height);

        // Save the image to the output path
        imagepng($original_image, $output_image_path); // Save as PNG

        // Clean up memory
        imagedestroy($original_image);
        imagedestroy($watermark_image);
        imagedestroy($resized_watermark);
    }

    // Call the function to add watermark
    add_watermark($original_image_path, $watermark_image_path, $output_image_path, $watermark_position, $watermark_size);

    // Provide the download link for the watermarked image
    $download_link = $output_image_path;
} else {
    $download_link = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watermark Image</title>
</head>

<body>

    <!-- Form for uploading images -->
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <label for="original_image">Original Image:</label>
        <input type="file" name="original_image" id="original_image" required><br><br>

        <label for="watermark_image">Watermark Image (PNG):</label>
        <input type="file" name="watermark_image" id="watermark_image" required><br><br>

        <label for="watermark_position">Watermark Position:</label>
        <select name="watermark_position" id="watermark_position" required>
            <option value="top-left">Top-Left</option>
            <option value="top-right">Top-Right</option>
            <option value="bottom-left">Bottom-Left</option>
            <option value="bottom-right">Bottom-Right</option>
        </select><br><br>

        <label for="watermark_size">Watermark Size (px):</label>
        <input type="number" name="watermark_size" id="watermark_size" value="50" min="10" required><br><br>

        <input type="submit" value="Add Watermark">
    </form>

    <?php if ($download_link): ?>
    <h2>Watermarked Image Generated!</h2>
    <p><a href="<?php echo $download_link; ?>" download>Click here to download your watermarked image</a></p>
    <?php endif; ?>
</body>

</html>