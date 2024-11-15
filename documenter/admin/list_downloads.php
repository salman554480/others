<?php require_once('parts/top.php'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('parts/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('parts/navbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Downloads Folder</h1>
                    
                    
                     <!-- Button to trigger PHP script -->
    <form method="POST">
        <button type="submit" class="btn btn-danger " name="delete_files">Delete All</button>
    </form>

    <?php
    if (isset($_POST['delete_files'])) {
        delete_old_files();
    }
    ?>
    
    <?php
function delete_old_files() {
    $downloads_folder = "../downloads";
    $current_time = time(); // Get current timestamp
    $file_age_limit = 4 * 60 * 60; // 4 hours in seconds

    // Check if the directory exists
    if (!is_dir($downloads_folder)) {
        echo "Directory does not exist!";
        return;
    }

    // Open the directory
    $dir = opendir($downloads_folder);

    // Array to keep track of deleted items
    $deleted_items = [];

    // Iterate over the files and directories
    while (($item = readdir($dir)) !== false) {
        $item_path = $downloads_folder . DIRECTORY_SEPARATOR . $item;

        // Skip directories (.) and (..)
        if ($item == '.' || $item == '..') {
            continue;
        }

        // Check if the item is a file
        if (is_file($item_path)) {
            // Check the file's modification time
            $file_time = filemtime($item_path);

            // If the file is older than 4 hours, delete it
            if ($current_time - $file_time >= $file_age_limit) {
                if (unlink($item_path)) {
                    $deleted_items[] = "File: $item";
                }
            }
        }

        // Check if the item is a directory
        if (is_dir($item_path)) {
            // Check the directory's modification time
            $dir_time = filemtime($item_path);

            // If the directory is older than 4 hours, recursively delete contents
            if ($current_time - $dir_time >= $file_age_limit) {
                delete_directory($item_path); // Call to delete directory and its contents
                $deleted_items[] = "Directory: $item";
            }
        }
    }

    closedir($dir);

    // Show result
    if (count($deleted_items) > 0) {
        echo "Deleted items: <br>" . implode("<br>", $deleted_items);
    } else {
        echo "No files or folders older than 4 hours were found.";
    }
}

// Function to recursively delete directory and its contents
function delete_directory($dir_path) {
    // Open the directory and read its contents
    $files = array_diff(scandir($dir_path), array('.', '..'));

    // Iterate through the files and delete them
    foreach ($files as $file) {
        $file_path = $dir_path . DIRECTORY_SEPARATOR . $file;
        
        // If it's a directory, recursively delete its contents
        if (is_dir($file_path)) {
            delete_directory($file_path);
        } else {
            // If it's a file, delete it
            unlink($file_path);
        }
    }

    // Delete the now-empty directory
    rmdir($dir_path);
}
?>

                    
                    
                    
                    <div class="card bg-white p-2">
                        <?php
// Define the path to the directory
$directory = '../downloads/';

// Handle file deletion if a delete request has been made
if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']); // Sanitize input to avoid directory traversal attacks
    $filePath = $directory . $fileToDelete;

    // Check if the file exists before attempting to delete
    if (file_exists($filePath)) {
        unlink($filePath);
        echo "<p>File '$fileToDelete' has been deleted.</p>";
        echo "<script>window.open('list_downloads.php','_self');</script>";
    } else {
        echo "<p>File '$fileToDelete' not found.</p>";
    }
}

// Open the directory
$files = scandir($directory);

// Start the HTML table
echo "<table class='table'>";
echo "<tr><th>Filename</th><th>File Size</th><th>Last Modified</th><th>Actions</th></tr>";

// Loop through the files and generate table rows
foreach ($files as $file) {
    // Skip special entries . and ..
    if ($file === '.' || $file === '..') {
        continue;
    }

    // Get file path
    $filePath = $directory . $file;

    // Get file size
    $fileSize = filesize($filePath);

    // Get last modified time
    $lastModified = date("F d Y H:i:s.", filemtime($filePath));
    
    // Convert size to Mb
    $fileSizeKb = round($fileSize / 1024);
    $fileSizeMb = number_format($fileSizeKb / 1024, 1);
    ?>

    <tr>
        <td><?php echo htmlspecialchars($file); ?></td>
        <td><?php echo htmlspecialchars($fileSizeMb); ?> Mb</td>
        <td><?php echo htmlspecialchars($lastModified); ?></td>
        <td>
            <!-- Delete button form -->
            <form method="get" action="">
                <input type="hidden" name="delete" value="<?php echo htmlspecialchars($file); ?>">
                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
            </form>
        </td>
    </tr>

<?php
}

// End the HTML table
echo "</table>";
?>


                        
                        
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php require_once('parts/footer.php'); ?>