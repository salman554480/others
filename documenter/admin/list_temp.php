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
                    <h1 class="h3 mb-4 text-gray-800">Temp Folder</h1>
                    <div class="card bg-white p-2">
                        <?php
// Define the path to the directory
$directory = '../temp/';

// Handle file deletion if a delete request has been made
if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']); // Sanitize input to avoid directory traversal attacks
    $filePath = $directory . $fileToDelete;

    // Check if the file exists before attempting to delete
    if (file_exists($filePath)) {
        unlink($filePath);
        echo "<p>File '$fileToDelete' has been deleted.</p>";
        echo "<script>window.open('list_temp.php','_self');</script>";
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