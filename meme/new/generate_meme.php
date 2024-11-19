<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topText = $_POST['topText'];
    $bottomText = $_POST['bottomText'];
    $imageData = $_POST['imageData']; // The base64 image string

    // Decode the image data
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $image = base64_decode($imageData);

    // Save the image to a file
    $filePath = 'uploads/meme_' . time() . '.png';
    file_put_contents($filePath, $image);

    // Respond with the path of the saved meme
    echo json_encode(['filePath' => $filePath]);
}
?>