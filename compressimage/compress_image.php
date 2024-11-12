<?php

// Compress image based on quality
function compress_image($source_image, $destination, $quality) {
    // Get the image type
    $image_info = getimagesize($source_image);
    $mime = $image_info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source_image);
            imagejpeg($image, $destination, $quality);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source_image);
            imagepng($image, $destination, floor($quality / 10)); // PNG uses compression level 0-9
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source_image);
            imagegif($image, $destination);
            break;
        default:
            return false;
    }

    imagedestroy($image);
    return true;
}

$response = ['success' => false, 'message' => '', 'download_url' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && isset($_POST['quality'])) {
    $quality = intval($_POST['quality']);
    
    // Ensure quality is between 1 and 100
    if ($quality < 1 || $quality > 100) {
        $response['message'] = 'Quality must be between 1 and 100';
        echo json_encode($response);
        exit;
    }

    $upload_dir = 'uploads/';
    $download_dir = 'compressed/';
    
    // Create directories if they don't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    if (!is_dir($download_dir)) {
        mkdir($download_dir, 0755, true);
    }

    $uploaded_file = $upload_dir . basename($_FILES['image']['name']);
    $compressed_file = $download_dir . 'compressed_' . basename($_FILES['image']['name']);
    
    // Move uploaded file to the upload directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
        if (compress_image($uploaded_file, $compressed_file, $quality)) {
            $response['success'] = true;
            $response['download_url'] = $compressed_file;
        } else {
            $response['message'] = 'Failed to compress the image.';
        }
    } else {
        $response['message'] = 'Failed to upload the image.';
    }
}

// Return JSON response
echo json_encode($response);
?>