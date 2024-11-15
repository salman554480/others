<?php
 $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';

// URL to get updates
  $url = "https://api.telegram.org/bot$botToken/getUpdates";

// Make the HTTP request
 $response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['ok']) {
    $documentMessages = [];

    foreach ($data['result'] as $update) {
        if (isset($update['message']) && isset($update['message']['document'])) {
            $documentMessages[] = $update['message'];
        }
    }

    // Sort the document messages by message_id in descending order
    usort($documentMessages, function($a, $b) {
        return $b['message_id'] - $a['message_id'];
    });

    if (!empty($documentMessages)) {
        foreach ($documentMessages as $message) {
            $chat_id = $message['chat']['id'];
            $message_id = $message['message_id'];
            $file_name = $message['document']['file_name'];
            $file_type = $message['document']['mime_type'];
            $file_id = $message['document']['file_id'];
            $file_size = $message['document']['file_size'];
            $file_date = date('Y-m-d H:i:s', $message['date']);
            
            $file_sizekb = $file_size / 1024;
            $file_sizemb = round($file_sizekb / 1024);
        ?>
<p>Chat ID: <?php echo $chat_id; ?></p>
<p>Message ID: <?php echo $message_id; ?></p>
<p>File Name: <?php echo $file_name; ?></p>
<p>File Type: <?php echo $file_type; ?></p>
<p>File ID: <?php echo $file_id; ?></p>
<p>File Size: <?php echo $file_sizemb; ?> mb</p>
<p>Date: <?php echo $file_date; ?></p>
<hr>
<?php }
    } else {
        echo 'No document messages found.';
    }
} else {
    echo 'Error: ' . $data['description'];
}
?>