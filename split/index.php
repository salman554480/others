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
        // Get the file path from the form
        $filePath = $_POST['filePath'] . ".zip";
        $chunkSize = 19 * 1024 * 1024; // 19 MB per chunk

        // Check if the file exists
        if (!file_exists($filePath)) {
            die("File not found.");
        }

        // Create the chunks directory if it doesn't exist
        $chunksDir = 'chunks';
        if (!is_dir($chunksDir)) {
            mkdir($chunksDir, 0777, true);
        }

        // Get the base file name without extension
        $fileName = pathinfo($filePath, PATHINFO_FILENAME);

        $fileHandle = fopen($filePath, 'rb');
        if (!$fileHandle) {
            die("Could not open the file.");
        }

        $chunkIndex = 1; // Start index from 1
        $totalChunks = 0; // Counter for total chunks

        while (!feof($fileHandle)) {
            // Read chunk from the file
            $buffer = fread($fileHandle, $chunkSize);

            // If we reach the end of the file and the buffer is smaller than chunkSize
            if (strlen($buffer) < $chunkSize) {
                // Pad the buffer with null bytes
                $buffer = str_pad($buffer, $chunkSize, "\0");
            }

            // Create a ZIP file for the current chunk
            $zip = new ZipArchive();
            // Format index to be three digits
            $zipFileName = sprintf("%s/%s_chunk_%03d.zip", $chunksDir, $fileName, $chunkIndex);

            if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                // Add the current chunk to the ZIP file
                $zip->addFromString("chunk_data.txt", $buffer);
                $zip->close();
            }

            $chunkIndex++;
            $totalChunks++;
        }

        fclose($fileHandle);

        // Output the total number of chunks created
        echo "<p>Total number of chunks created: $totalChunks</p>";
    }
    ?>

</body>

</html>