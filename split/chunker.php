<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Chunk Splitter</title>
</head>

<body>
    <form action="" method="post">
        <label for="filePath">Enter the file path:</label>
        <input type="text" id="filePath" name="filePath" required>
        <button type="submit">Split File</button>
    </form>

    <?php

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
	
	
// Step 2: Split the downloaded ZIP file into chunks

$output_dir = "chunks/"; 

$zip_file = $_POST['filePath'].".zip";

preg_match('/(\d+)_/', $zip_file, $matches);
$file_access_key = $matches[1]; // $number will be "67874689"

// Size of each chunk in bytes (19MB)
$chunk_size = 19 * 1024 * 1024; // 19MB

// Open the downloaded ZIP file for reading
$file = fopen($zip_file, 'rb');
if (!$file) {
    die("Unable to open file: $zip_file");
}else{
    echo "compressed";
}

$chunk_number = 1;
while (!feof($file)) {
    // Format chunk number with leading zeros
    $formatted_chunk_number = str_pad($chunk_number, 3, '0', STR_PAD_LEFT);
    
    // Create chunk file name
    $chunk_file_name = $output_dir . $file_access_key . '_chunk_' . $formatted_chunk_number . '.zip';
    
    // Open chunk file for writing
    $chunk_file = fopen($chunk_file_name, 'wb');
    
    if (!$chunk_file) {
        die("Unable to create chunk file: $chunk_file_name");
    }
    
    // Read a chunk from the original file
    $data = fread($file, $chunk_size);
    
    // Write the chunk to a new file
    fwrite($chunk_file, $data);
    
    // Close the chunk file
    fclose($chunk_file);
    
    $chunk_number++;
}

// Close the original file
fclose($file);

// Optionally, delete the original downloaded file and the ZIP file if no longer needed

 //unlink($zip_file);

echo "File downloaded, compressed, and split into chunks successfully!\n";


	
    }
    ?>

</body>

</html>
