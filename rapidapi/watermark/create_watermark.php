<?php

// Enable CORS for Postman to access the API
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['original_image']) && isset($_FILES['watermark_image']) && isset($_POST['watermark_position']) && isset($_POST['watermark_size'])) {

    // Get the uploaded images and user inputs from POST
    $original_image_path = $_FILES['original_image']['tmp_name'];
    $watermark_image_path = $_FILES['watermark_image']['tmp_name'];
    $watermark_position = $_POST['watermark_position']; // Position option (top-left, etc.)
    $watermark_size = intval($_POST['watermark_size']); // Watermark size (in px)

    // Define the output image path
    $output_image_path = 'download/' . mt_rand() . '_watermarked_image.png'; // This can be dynamic if needed

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

        return $output_image_path;
    }

    // Call the function to add watermark and get the output path
    $output_image_path = add_watermark($original_image_path, $watermark_image_path, $output_image_path, $watermark_position, $watermark_size);

    // Prepare the response
    $response = [
        'status' => 'success',
        'message' => 'Watermarked image generated successfully.',
        'download_link' => $output_image_path
    ];
} else {
    // If required data is missing, send an error response
    $response = [
        'status' => 'error',
        'message' => 'Missing required parameters (images, position, or size).'
    ];
}

// Send the JSON response
echo json_encode($response);