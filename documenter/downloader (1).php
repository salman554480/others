<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  #link-ready{display:none;}

.pre-scrollable {
    max-height: 400px;
    overflow-y: scroll;
}
  
  </style>
  
  <?php
    require_once('parts/db.php');
    $botToken = '7147572018:AAF_uX7c5FbA_V5DoglL1AuQbtHTWnix1Yg';
                if (isset($_GET['file_access_key'])) {
                    $file_access_key  = $_GET['file_access_key'];
                    $select_file = "SELECT * FROM file WHERE file_access_key='$file_access_key'";
                    $run_select_file = mysqli_query($conn, $select_file);
                    if (mysqli_num_rows($run_select_file) > 0) {
                        $row_file = mysqli_fetch_array($run_select_file);

                        $file_id =  $row_file['file_id'];
                        $folder_key =  $row_file['folder_key'];
                        $file_access_key =  $row_file['file_access_key'];
                        $file_name =  $row_file['file_name'];
                        $file_size =  $row_file['file_size'];
                        $file_type =  $row_file['file_type'];
                        $file_extension =  $row_file['file_extension'];
                        $file_unique_id =  $row_file['file_unique_id'];
                        $file_date =  $row_file['file_date'];
                        $file_state =  $row_file['file_state'];

                        if($file_type == "application" ){
                            $file_icon = 'fas fa-file'; 
                        }else if($file_type == "image"){
                            $file_icon = 'fas fa-file-image'; 
                        }else if($file_type == "video"){
                            $file_icon = 'fas fa-file-video'; 
                        }else if($file_type == "text"){
                            $file_icon = 'fas fa-file-alt'; 
                        }
                    

                        $file_sizeMb =  round($file_size / 1024,1);
                        
                        $parts = round($file_sizeMb / 19);
                        

                        $select_top_folders = "SELECT * FROM folder WHERE folder_key='$folder_key'";
                        $run_top_folders = mysqli_query($conn, $select_top_folders);
                        if (mysqli_num_rows($run_top_folders) > 0) {
                            $row_top_folders = mysqli_fetch_array($run_top_folders);
                            $folder_id = $row_top_folders['folder_id'];
                            $folder_name = $row_top_folders['folder_name'];
                        }else{
                            $folder_name = "Drive";
                        }
                    } else {
                        echo "<script>window.open('dashboard.php', '_self');</script>";
                    }
                }
                ?>
                
                
                <?php
                    if(isset($_GET['download'])){
                        if($file_unique_id != ""){
                        $url = "https://api.telegram.org/bot$botToken/getFile?file_id=$file_unique_id";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        $responseData = json_decode($response, true);
                        if (isset($responseData['ok']) && $responseData['ok'] && isset($responseData['result']['file_path'])) {
                             $filePath = $responseData['result']['file_path'];
                            $download_path = "https://api.telegram.org/file/bot$botToken/$filePath";
                        
                        } else {
                            echo "Failed to fetch the file path.\n";
                            if (isset($responseData['description'])) {
                                echo "Error: " . $responseData['description'] . "\n";
                            }
                        }
                        }else{
                            $download_path = "";
                        }
                    }
                
                ?>
  
</head>
<body>
<main class="container my-4">
    
 
        <center><img src="images/download-animation.gif" /></center>
        <div class="app-title">
            <div>
                <h4>Download: <?php echo substr($file_name,9,100);?></h4>
                <p><?php echo $file_sizeMb;?> Mb - <?php echo $file_type?>/<?php echo $file_extension?></p>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        
                        
                        <table id="dataTable" class="table table-bordered mb-3 table-sm">
                          <tr>
                            <th scope="col">Access Key</th>    <td><?php echo $file_access_key; ?></td>
                          </tr>
                          <tr>
                            <th scope="col">Type</th>    <td><?php echo $file_type;?>/<?php echo $file_extension;?></td>
                          </tr>
                          <tr>
                            <th scope="col">Size</th>    <td><?php echo $file_sizeMb; ?> Mb</td>
                           </tr>   
                           <tr>
                            <th scope="col">Created Date</th>    <td><?php echo $file_date; ?></td>
                            </tr>
                            <?php if($file_state == "wait"){ ?>
                            <tr>
                            <th scope="col">Download</th>    <td><a class="btn btn-danger btn-sm" href="upload/<?php echo $file_name;?>">Download</a></td>
                            </tr>
                            <?php }  ?>
                          
                          
                        </table>
                        
                        <?php if($file_sizeMb < 19){ ?>
                                <h5 class="tile-heading"><small><a class='btn btn-success btn-sm' href="downloader.php?file_access_key=<?php echo $file_access_key?>&download=1">Click Here to Load Preview</a></small></h5> 
                                    <?php if(isset($_GET['download'])){ ?>
                                   <!-- <button class="btn btn-success mb-2" id="redirect-button">Download Now</button>-->
                                    
                                    <form id="downloadForm" action="" method="post">
                                        <input type="hidden" id="file_url" name="file_url" value="<?php echo $download_path; ?>" required>
                                         <button id="downloadButton" class="btn btn-success btn-sm mb-2" type="submit" name="download">
                                            <span class="btn-text">Download</span>
                                       </button>
                                    </form>
                                    <small class="text-secondary">Use VPN if you find any difficulty in downloading file.</small><br>
                                    
                                    <?php if($file_type == "image"){ ?>
                                        <img src="<?php echo $download_path;?>" class="w-50 d-block mx-auto" style="object-fit: fill;">
                                    <?php }else if($file_type == "video"){  ?>
                                    <center><video width="50%" style="d-block mx-auto"  controls>
                                      <source src="<?php echo $download_path;?>" type="video/mp4">
                                    </video></center>
                                    <?php }?>
                                
                                
                                    <?php }?>
                                <?php } ?>
                        
                            <?php
                            if (isset($_POST['download'])) {
                                // Get the file URL from the POST request
                                $fileUrl = filter_input(INPUT_POST, 'file_url', FILTER_SANITIZE_URL);
                                
                                if (empty($fileUrl) || !filter_var($fileUrl, FILTER_VALIDATE_URL)) {
                                    echo "Invalid URL.";
                                    exit;
                                }
                            
                                // Define the download directory and file name
                                $downloadDir = 'download';
                                $filePath = $downloadDir . '/' . $file_name;
                            
                                // Create the download directory if it does not exist
                                if (!is_dir($downloadDir)) {
                                    mkdir($downloadDir, 0755, true);
                                }
                            
                                // Download the file and save it to the server
                                $fileContent = file_get_contents($fileUrl);
                                if ($fileContent === false) {
                                    echo "Failed to download file.";
                                    exit;
                                }
                            
                                file_put_contents($filePath, $fileContent);
                                
                                $insert_download = "INSERT INTO download(user_id,download_file,download_file_size) VALUES('$user_id','$file_name','$file_size')";
                                $run_insert_download =  mysqli_query($conn,$insert_download);
                            
                                // Provide the download link
                                echo "<script>window.open('download/$file_name','_blank');</script>";
                               // echo "Your Files are Ready,: <a href='download/$file_name' download>Download Now</a>";
                            } 
                            ?>
                        
                    </div>
                </div>
                
                <?php if($file_sizeMb >=  19){?>
                
                <div class="tile">
                    <div class="tile-body">
                        
                         <!-- Button to start downloading -->
                         <?php if($file_state == "upload"){ ?>
                        <button id="startDownloadBtn" class="btn btn-success">Start</button>
                        <?php } ?>
                        <!-- Area to display the status of each download -->
                        <div id="statusContainer" class="pre-scrollable"></div>
                    
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                        $(document).ready(function () {
                            let filesToDownload = []; // Array to store all files' data
                            let fileAccessKey = "<?php echo $file_access_key?>"; // Get the file_access_key from PHP
                            let parts = "<?php echo $parts?>";
                    
                            $('#startDownloadBtn').click(function () {
                                startDownload();
                            });
                    
                            function startDownload() {
                                $('#startDownloadBtn').prop('disabled', true); // Disable the button to prevent multiple clicks
                                $('#statusContainer').empty(); // Clear previous status
                    
                                // Fetch the list of files from the server first
                                $.ajax({
                                    url: 'getFiles.php',  // The PHP file that fetches the file data from DB
                                    method: 'GET',
                                    data: { file_access_key: fileAccessKey },  // Pass file_access_key via GET
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response.status === 'success') {
                                            filesToDownload = response.files; // Store the files' data
                                            downloadNextFile(0); // Start downloading from the first file
                                        } else {
                                            $('#statusContainer').append('<p class="status error">No files available for download.</p>');
                                            $('#startDownloadBtn').prop('disabled', false); // Re-enable the button
                                        }
                                    },
                                    error: function () {
                                        $('#statusContainer').append('<p class="status error">An error occurred while fetching files.</p>');
                                        $('#startDownloadBtn').prop('disabled', false); // Re-enable the button
                                    }
                                });
                            }
                    
                            function downloadNextFile(index) {
                                if (index >= filesToDownload.length) {
                                    $('#statusContainer').append('<p class="status success">All downloads complete!</p>');
                                    document.getElementById("link-ready").submit();
                                    $('#startDownloadBtn').prop('disabled', false); // Re-enable the button after all downloads
                                    return;
                                }
                    
                                const file = filesToDownload[index];
                    
                                // Send the AJAX request to download the current file
                                $.ajax({
                                    url: 'download.php',  // The PHP file to handle the download of each file
                                    method: 'POST',
                                    data: { 
                                        action: 'download', 
                                        file_id: file.data_file_id, 
                                        file_name: file.data_file_name,
                                        file_access_key: fileAccessKey // Pass the file_access_key to download.php
                                    },
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response.status === 'success') {
                                            $('#statusContainer').append('<div class="p-1 bg-success text-light mt-1">File ' + response.chunk_number+'/'+ parts + ' downloaded successfully!</div>');
                                        } else {
                                            $('#statusContainer').append('<p class="status error">Error downloading "' + response.file_name + '": ' + response.message + '</p>');
                                        }
                    
                                        // Continue to the next file
                                        downloadNextFile(index + 1);
                                    },
                                    error: function () {
                                        $('#statusContainer').append('<p class="status error">An error occurred while downloading "' + file.data_file_name + '".</p>');
                                        downloadNextFile(index + 1);  // Continue to the next file even if there is an error
                                    }
                                });
                            }
                        });
                    </script>
                        
                    </div>
                    
                    
                        <form id="link-ready" action="" method="post" style="display:block;">
                            <input type="hidden"  value="<?php echo $file_access_key; ?>"id="unique_code" name="unique_code" required>
                        </form>
                    

                    

<?php
if (isset($_POST['unique_code'])) {
  
     echo '<script>document.getElementById("dwnldActivatorBtn").style.display = "none";</script>';
     echo '<script>document.getElementById("startDownloadBtn").style.display = "none";</script>';
    
    // Define constants
    define('UPLOAD_DIR', 'downloads/'); // Directory where files are stored

    $uniqueCode = $file_access_key; // Replace with your unique code
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
                    
                    
 







                    </div>    
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
    
     
     
     
     
    

</body>
</html>
