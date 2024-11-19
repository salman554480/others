<?php
// API credentials (username and password for Imgflip)
$username = 'your_username'; // Replace with your Imgflip account username
$password = 'your_password'; // Replace with your Imgflip account password

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect the data from the form
    $memeId = $_POST['memeId'];
    $imageUrl = $_POST['imageUrl'];
    $boxes = $_POST['boxes'];

    // Prepare the boxes array for the API
    $textBoxes = [];
    foreach ($boxes as $box) {
        $textBoxes[] = [
            'text' => $box['text'],
            'x' => 10,  // X position for the text box (You can adjust this later)
            'y' => 10,  // Y position for the text box (You can adjust this later)
            'width' => 500,  // Width of the text box
            'height' => 100,  // Height of the text box
            'color' => '#ffffff',  // Text color
            'outline_color' => '#000000'  // Outline color of the text
        ];
    }

    // Prepare data for POST request to generate meme
    $url = 'https://api.imgflip.com/caption_image';
    $postData = [
        'template_id' => $memeId,
        'username' => 'salman554480',
        'password' => 'facebook786',
        'text0' => $boxes[0]['text'],  // Text for box 0
        'text1' => $boxes[1]['text'],  // Text for box 1
        // Add more text fields depending on box_count
    ];

    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute the cURL request
    $result = curl_exec($ch);
    curl_close($ch);

    // Decode the result
    $resultData = json_decode($result, true);

    if ($resultData['success']) {
        // If the meme was successfully created, redirect to the new meme image
        header('Location: ' . $resultData['data']['url']);
        exit();
    } else {
        echo 'Error: ' . $resultData['error_message'];
    }
}