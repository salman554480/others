<?php

  define('UPLOAD_DIR', 'chunks/'); // Directory where files are stored

    $uniqueCode = "67874689"; // Replace with your unique code
    $outputFilePath = UPLOAD_DIR . $uniqueCode . '_merged_output.zip'; // Path for the merged output file

    // Get all files matching the unique code pattern
    $files = glob(UPLOAD_DIR . $uniqueCode . '_*.zip');
    if (empty($files)) {
        die('No files found with the given unique code'); // No files found
    }

    // Sort files by modification time (ascending order)
    usort($files, function($a, $b) {
        return filemtime($a) - filemtime($b);
    });

    $output = fopen($outputFilePath, 'wb');
    if ($output === false) {
        die('Failed to create output file'); // Failed to create output file
    }

    foreach ($files as $file) {
        $input = fopen($file, 'rb');
        if ($input === false) {
            fclose($output);
            die('Failed to open input file'); // Failed to open input file
        }

        while (!feof($input)) {
            $buffer = fread($input, 8192);
            fwrite($output, $buffer);
        }

        fclose($input);
    }

    fclose($output);

?>