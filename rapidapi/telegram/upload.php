<?php

if (isset($_FILES['document'])) {

    // Get file details
    $file_tmp_path = $_FILES['document']['tmp_name'];
    $file_name = $_FILES['document']['name'];
    $file_size = $_FILES['document']['size'];
    $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
    $chatId = '-1002230179133'; // Correct chat ID
    
    
    if(move_uploaded_file($file_tmp_path,"uploads/$file_name")){
    
        $filePath = "uploads/".$file_name;
        // Your Telegram Bot Token and Chat ID
             
                // Prepare and execute cURL request to send the document
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$botToken/sendDocument");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, [
                    'chat_id' => $chatId,
                    'document' => new CURLFile(realpath($filePath)), // Use CURLFile for file upload
                    'caption' => "Tele-File_" . $file_name
                ]);

                // Execute the cURL request
              echo  $apiResponse = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                // Decode the Telegram API response
                $apiResponseData = json_decode($apiResponse, true);
    }
                
}
?>