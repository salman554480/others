<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>
    <?php
    if (isset($_GET['video_guid'])) {
        $video_guid = $_GET['video_guid'];
        $select_video = "SELECT * From video WHERE video_guid='$video_guid'";
        $result_video = mysqli_query($conn, $select_video);
        $row_video = mysqli_fetch_array($result_video);
        $video_id =  $row_video['video_id'];
        $video_views =  $row_video['video_views'];
        $video_title =  $row_video['video_title'];
        $video_access_key =  $row_video['video_access_key'];
        $dbcategory_id =  $row_video['category_id'];
        $video_tags =  $row_video['video_tags'];
        $video_description =  $row_video['video_description'];

        $incremented_video_views =  $video_views + 1;
        $update_views = "UPDATE video SET video_views='$incremented_video_views' WHERE video_id='$video_id'";
        $run_update_views =  mysqli_query($conn, $update_views);




        //get from file
        echo   $select_file = "SELECT * FROM file WHERE file_access_key='$video_access_key'";
        $run_select_file = mysqli_query($conn, $select_file);
        $row_select_file =  mysqli_fetch_array($run_select_file);
        $file_state = $row_select_file['file_state'];
        $file_name = $row_select_file['file_name'];
        $file_size =  $row_select_file['file_size'];

        $file_sizeMb =  round($file_size / 1024, 1);
        $parts = round($file_sizeMb / 19);

        if ($file_state == "wait") {
            $file_name = $row_select_file['file_name'];
            $video_source = "portal/assets/upload/" . $file_name;
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('videoContainer').style.display = 'none';
                    });
                  </script>";
        }
    }
    ?>

    <main role="main" class="container-fluid my-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="image-container">
                    <img src="https://picsum.photos/1280/720" alt="Image" class="image">
                    <div class="play-icon-container">
                        <span class="play-icon"><i class="fa-solid fa-play" id="startDownloadBtn"></i></span>
                        <!-- Play icon -->
                    </div>
                </div>

                <!-- Area to display the status of each download -->
                <div id="statusContainer" class="pre-scrollable"></div>



                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                $(document).ready(function() {
                    let filesToDownload = []; // Array to store all files' data
                    let fileAccessKey = "<?php echo $video_access_key ?>"; // Get the file_access_key from PHP
                    let parts = "<?php echo $parts ?>";


                    $('#startDownloadBtn').click(function() {
                        startDownload();
                    });

                    function startDownload() {
                        $('#startDownloadBtn').prop('disabled',
                            true); // Disable the button to prevent multiple clicks
                        $('#statusContainer').empty(); // Clear previous status

                        // Fetch the list of files from the server first
                        $.ajax({
                            url: 'getFiles.php', // The PHP file that fetches the file data from DB
                            method: 'GET',
                            data: {
                                file_access_key: fileAccessKey
                            }, // Pass file_access_key via GET
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    filesToDownload = response.files; // Store the files' data
                                    downloadNextFile(0); // Start downloading from the first file
                                } else {
                                    $('#statusContainer').append(
                                        '<p class="status error">No files available for download.</p>'
                                    );
                                    $('#startDownloadBtn').prop('disabled',
                                        false); // Re-enable the button
                                }
                            },
                            error: function() {
                                $('#statusContainer').append(
                                    '<p class="status error">An error occurred while fetching files.</p>'
                                );
                                $('#startDownloadBtn').prop('disabled',
                                    false); // Re-enable the button
                            }
                        });
                    }

                    function downloadNextFile(index) {
                        if (index >= filesToDownload.length) {
                            $('#statusContainer').append(
                                '<p class="status success">All downloads complete!</p>');
                            document.getElementById("link-ready").submit();
                            $('#startDownloadBtn').prop('disabled',
                                false); // Re-enable the button after all downloads
                            return;
                        }

                        const file = filesToDownload[index];

                        // Send the AJAX request to download the current file
                        $.ajax({
                            url: 'download.php', // The PHP file to handle the download of each file
                            method: 'POST',
                            data: {
                                action: 'download',
                                file_id: file.data_file_id,
                                file_name: file.data_file_name,
                                file_access_key: fileAccessKey // Pass the file_access_key to download.php
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    $('#statusContainer').append(
                                        '<div class="p-1 bg-success text-light mt-1">File ' +
                                        response.chunk_number + '/' + parts +
                                        ' downloaded successfully!</div>');
                                } else {
                                    $('#statusContainer').append(
                                        '<p class="status error">Error downloading "' + response
                                        .file_name + '": ' + response.message + '</p>');
                                }

                                // Continue to the next file
                                downloadNextFile(index + 1);
                            },
                            error: function() {
                                $('#statusContainer').append(
                                    '<p class="status error">An error occurred while downloading "' +
                                    file.data_file_name + '".</p>');
                                downloadNextFile(index +
                                    1); // Continue to the next file even if there is an error
                            }
                        });
                    }
                });
                </script>

                <form id="link-ready" action="" method="post" style="display:block;">
                    <input type="hidden" value="<?php echo $file_access_key; ?>" id="unique_code" name="unique_code"
                        required>
                </form>




                <?php
                if (isset($_POST['unique_code'])) {

                    echo '<script>document.getElementById("dwnldActivatorBtn").style.display = "none";</script>';
                    echo '<script>document.getElementById("startDownloadBtn").style.display = "none";</script>';

                    // Define constants
                    define('UPLOAD_DIR', 'assets/downloads/'); // Directory where files are stored

                    $uniqueCode = $video_access_key; // Replace with your unique code
                    $outputFilePath = UPLOAD_DIR . $uniqueCode . '_merged_output.zip'; // Path for the merged output file

                    // Get all files matching the unique code pattern
                    $files = glob(UPLOAD_DIR . $uniqueCode . '_*.zip');
                    if (empty($files)) {
                        die('No files found with the given unique code'); // No files found
                    }

                    // Sort files by modification time (ascending order)
                    usort($files, function ($a, $b) {
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
                    echo "<div class='bg-success p-1 text-light text-center'>File Created successfully!</div>";
                    echo "<br><a class='btn btn-danger my-3' href='$outputFilePath' download >Download File</a>";

                    // Extract the merged ZIP file
                    $zip = new ZipArchive;
                    $extractDir = UPLOAD_DIR . $uniqueCode . '_extracted/'; // Directory for extracted files

                    if ($zip->open($outputFilePath) === TRUE) {
                        // Create the extraction directory if it doesn't exist
                        if (!is_dir($extractDir)) {
                            mkdir($extractDir, 0777, true);
                        }
                        $zip->extractTo($extractDir);
                        $zip->close();
                        //echo 'Files extracted successfully!<br>';

                        // List extracted files and show preview button
                        //echo "<h3>Extracted Files:</h3>";
                        $extractedFiles = glob($extractDir . '*'); // Get all extracted files
                        foreach ($extractedFiles as $extractedFile) {
                            $fileName = basename($extractedFile);
                            echo "<a class='btn btn-info ml-2' href='$extractedFile' target='_blank'>Preview</a><br>";

                            echo '<script>
            document.getElementById("link-ready").style.display = "block";
            document.getElementById("loadFileBtn").style.display = "none";
            document.getElementById("downloadAllBtn").style.display = "none";
            document.getElementById("loading-spinner").style.display = "none";
            document.getElementById("fileList").style.display = "none";
            document.getElementById("dwnldActivatorBtn").style.display = "none";
            document.getElementById("dataTable").style.display = "none";
            document.getElementById("startDownloadBtn").style.display = "none";
            
            
        </script>';

                            //    if (strpos($file_type, 'video') !== false) {
                            // For video files
                            //echo "<video width='100%'  controls>
                            //      <source src='$extractedFile' type='$file_type/$file_extension'>
                            //      </video><br>";
                            //      } elseif (strpos($file_type, 'image') !== false) {
                            // For image files
                            //        echo "<img src='$extractedFile' alt='$fileName' style='max-width: 100%; height: auto;'><br>";
                            //   } elseif (strpos($file_type, 'text/plain') !== false || strpos($file_type, 'application/pdf') !== false) {
                            // For text or document files
                            //       echo "<iframe src='$extractedFile' style='width:100%; height:500px;' frameborder='0'></iframe><br>";
                            //  } elseif (strpos($file_type, 'application') !== false) {
                            // For application files, do not display anything
                            //            continue; // Skip displaying this file
                            //       } else {
                            // You can add more conditions if needed for other file types
                            //         echo "<a class='btn btn-info' href='$extractedFile' target='_blank'>Preview</a><br>";
                            //        }
                        }
                    } else {
                        die('Failed to extract the zip file'); // Failed to extract the zip file
                    }
                }
                ?>



                <div class="video-container" id="videoContainer">
                    <video controls>
                        <source src="<?php echo $video_source; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <h4 class="main-title"><?php echo $video_title; ?></h4>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="author-info mb-2">
                            <img src="https://avatar.iran.liara.run/public/<?php echo $i ?>" alt="Author Image"
                                class="author-img">
                            <div>
                                <span class="author-name">John Doe</span>

                                <div class="video-meta">
                                    <span><strong>1.2M</strong> Follwers</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7 d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Button group example">
                            <!-- Button 1 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-up"></i> 38
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-down"></i> 38
                            </button>

                            <!-- Button 1 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-share"></i> Share
                            </button>

                            <!-- Button 2 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-download"></i> Download
                            </button>

                            <!-- Button 3 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-bookmark"></i> Save
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-2">
                    <?php echo $video_description; ?>



                    <!-- Comment Add Section -->
                    <div class="comment-section">
                        <h6>Add a Comment</h6>
                        <div class="comment-form">
                            <textarea class="form-control" rows="3" placeholder="Write your comment..."></textarea>
                            <button class="btn btn-primary mt-2 btn-sm">Submit Comment</button>
                        </div>
                    </div>

                    <!-- Display Comments Section -->
                    <div class="comment-section">
                        <h6>Recent Comments</h6>

                        <!-- Comment 1 -->
                        <?php
                        $x = 1;
                        while ($x < 4) {
                        ?>
                        <div class="comment">
                            <img src="https://avatar.iran.liara.run/public/<?php echo $x ?>" alt="User Avatar"
                                class="comment-avatar">
                            <div class="comment-body">
                                <div class="comment-author">John Doe</div>
                                <div class="comment-text">This is a very informative video! I learned a lot about web
                                    development concepts. Keep it up!</div>
                                <div class="comment-meta">
                                    <span class="comment-date">2 hours ago</span> •
                                    <span class="comment-reply"><i class="fas fa-reply"></i> Reply</span>
                                </div>
                            </div>
                        </div>
                        <?php $x++;
                        } ?>

                        <!-- Add more comments as needed -->
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <h6>Recent Videos</h6>

                <div class="list-group">
                    <!-- Video 1 -->
                    <?php
                    $i = 1;
                    while ($i < 14) {
                    ?>
                    <div class="list-group-item d-flex align-items-center video-item">
                        <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Video Thumbnail"
                            class="video-thumbnail">
                        <div class="video-info">
                            <div class="video-title">How to Learn Web Development</div>
                            <div class="d-flex justify-content-between">
                                <div class="video-author">By John Doe</div>
                                <div class="video-author">3:00</div>

                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="video-views"><i class="fas fa-eye"></i> 1.5K views</div>
                                <div class="video-time"><i class="fas fa-clock"></i> 2 days ago</div>

                            </div>
                        </div>
                    </div>
                    <?php $i++;
                    } ?>


                    <!-- Add more videos as needed -->
                </div>
            </div>
        </div>



    </main>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>