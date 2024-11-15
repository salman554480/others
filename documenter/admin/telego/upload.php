<?php
$conn =  mysqli_connect('localhost', 'root', '', 'videostreamer');
if (isset($_FILES['file'])) {
    $file_tmp_path = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $user_id = $_POST['user_id'];
    $file_access_key = $_POST['file_access_key'];

    $upload_dir = '../chunks/';
    $file_url = $upload_dir . basename($file_name);

    if (move_uploaded_file($file_tmp_path, $file_url)) {
        // Your Telegram Bot Token
        $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
        $chatId = '-1002230179133'; // Correct chat ID obtained from getUpdates

        // cURL to send the file
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$botToken/sendDocument");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'chat_id' => $chatId,
            'document' => new CURLFile($file_url, mime_content_type($file_url), basename($file_url)),
            'caption' => "$user_id-$file_access_key"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $responseData = json_decode($response, true);

        if ($httpCode === 200 && isset($responseData['ok']) && $responseData['ok'] === true) {
            $file_id = $responseData['result']['document']['file_id'];
            $file_name = $responseData['result']['document']['file_name'];
            $file_size = $responseData['result']['document']['file_size'];

            $insert_data = "INSERT INTO data(file_access_code, data_file_id, data_file_name, data_file_size, user_id) VALUES('$file_access_key','$file_id','$file_name','$file_size','$user_id')";
            $run_insert_data = mysqli_query($conn, $insert_data);

            echo "Data inserted for file: $file_name";

            unlink($file_url);
        } else {
            echo "Failed to send file: $file_url. Error: " . $responseData['description'];
        }
    } else {
        echo "Error moving the uploaded file: $file_name";
    }
}