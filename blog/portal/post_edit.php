<?php require_once('parts/top.php'); ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php require_once('parts/sidebar.php'); ?>
    <?php
    if (isset($_GET['video_id'])) {
        $video_id =  $_GET['video_id'];
        $select_video = "SELECT * From video WHERE video_id='$video_id'";
        $result_video = mysqli_query($conn, $select_video);
        $row_video = mysqli_fetch_array($result_video);
        $video_id =  $row_video['video_id'];
        $video_title =  $row_video['video_title'];
        $video_guid  =  $row_video['video_guid'];
        $video_access_key =  $row_video['video_access_key'];
        $dbcategory_id =  $row_video['category_id'];
        $video_tags =  $row_video['video_tags'];
        $video_description =  $row_video['video_description'];
        $video_thumbnail =  $row_video['video_thumbnail'];
        $video_status =  $row_video['video_status'];
    }
    ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-speedometer"></i> Blank Page</h1>
                <p>Start a beautiful journey here</p>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input class="form-control" type="text" name="video_title" id="videoTitle"
                                            value="<?php echo $video_title; ?>" maxlength="100">
                                        <small id="charCount" class="form-text ">0 / 60 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea id="hidden-textarea" name="video_description"
                                            style="display:none;"><?php echo $video_description; ?></textarea>

                                        <!-- Quill Editor Container -->
                                        <div id="editor-container">
                                            <!-- The Quill editor will be rendered here -->
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <input class="form-control" name="video_tags" type="text"
                                            value="<?php echo $video_tags ?>">
                                    </div>


                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Access Key</label>
                                        <input class="form-control" name="video_access_key" type="text"
                                            value="<?php echo $video_access_key ?>">
                                        <small class="text-muted">Upload Video <a target="_blank"
                                                href="https://scripts.vaultifier.space/transfer/">Here</a> to get
                                            <b>Access Key</b>
                                        </small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="category_id">
                                            <?php
                                            $select_category = "SELECT * From category";
                                            $result_category = mysqli_query($conn, $select_category);
                                            while ($row_category = mysqli_fetch_array($result_category)) {
                                                $category_id =  $row_category['category_id'];
                                                $category_name =  $row_category['category_name'];
                                            ?>
                                            <option <?php if ($dbcategory_id ==  $category_id) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $category_id ?>">
                                                <?php echo $category_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail</label>
                                        <input class="form-control" name="video_thumbnail" type="file"
                                            id="videoThumbnail" onchange="validateImage()">
                                        <small class="text-muted">Size: 1280x720</small><br>
                                        <div id="error-message" style="color: red; display: none;"></div>
                                        <!-- Error message will be shown here -->
                                        <small class="text-muted">Selected:
                                            <?php echo substr($video_thumbnail, 37, 100); ?>
                                        </small>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="video_status">
                                            <option <?php if ($video_status == "publish") {
                                                        echo "selected";
                                                    } ?> value="publish">Publish
                                            </option>
                                            <option <?php if ($video_status == "draft") {
                                                        echo "selected";
                                                    } ?> value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Upload" name="upload"
                                            class="btn btn-success btn-block w-100">
                                    </div>
                                </div>
                        </form>
                        <?php
                        if (isset($_POST['upload'])) {
                            $evideo_title =  $_POST['video_title'];
                            $evideo_description =  $_POST['video_description'];
                            $evideo_access_key =  $_POST['video_access_key'];
                            $ecategory_id =  $_POST['category_id'];
                            $evideo_tags =  $_POST['video_tags'];
                            $evideo_status =  $_POST['video_status'];
                            $video_thumbnail_name =  $video_guid . "_" . $_FILES['video_thumbnail']['name'];
                            $video_thumbnail_tmpname =   $_FILES['video_thumbnail']['tmp_name'];

                            if (empty($video_thumbnail_name)) {
                                $video_thumbnail_name = $video_thumbnail;
                            } else {
                                // Define the file path
                                $file_path = "images/thumbnail/" . $video_thumbnail;

                                // Check if the file exists
                                if (file_exists($file_path)) {
                                    // Attempt to delete the file
                                    unlink($file_path);
                                } else {
                                    echo "Error: The file does not exist.";
                                }
                            }

                            $video_date = date('Y-m-d');
                            $video_time = date('h:i A');
                            $insert_video = "Update video SET video_access_key='$evideo_access_key',video_title='$evideo_title',category_id='$ecategory_id',video_description='$evideo_description',video_thumbnail='$video_thumbnail_name',video_tags='$evideo_tags',video_status='$evideo_status' WHERE video_id='$video_id'";
                            $run_video =  mysqli_query($conn, $insert_video);
                            if ($run_video) {
                                move_uploaded_file($video_thumbnail_tmpname, 'images/thumbnail/' . $video_thumbnail_name);
                                echo '<script>alert("Video Updated successfully")</script>';
                                echo '<script>window.location.href="video_view.php"</script>';
                            } else {
                                echo '<script>alert("Failed to upload video")</script>';
                            }
                        }
                        ?>




                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <!-- Title Validation  -->
                        <script>
                        const titleInput = document.getElementById('videoTitle');
                        const charCountDisplay = document.getElementById('charCount');

                        // Best practice length range
                        const minLength = 50;
                        const maxLength = 60;

                        // Update character count and apply color logic
                        titleInput.addEventListener('input', () => {
                            const currentLength = titleInput.value.length;

                            // Display the current length and max length
                            charCountDisplay.textContent = `${currentLength} / 60 characters`;

                            // Change color based on length
                            if (currentLength >= minLength && currentLength <= maxLength) {
                                charCountDisplay.classList.remove('char-count-bad');
                                charCountDisplay.classList.add('char-count-good');
                            } else {
                                charCountDisplay.classList.remove('char-count-good');
                                charCountDisplay.classList.add('char-count-bad');
                            }
                        });
                        </script>

                        <!-- Image Validation -->
                        <script>
                        function validateImage() {
                            // Get the file input element
                            var fileInput = document.getElementById('videoThumbnail');
                            var file = fileInput.files[0];

                            // Ensure a file is selected
                            if (file) {
                                var img = new Image(); // Create a new image object
                                img.onload = function() {
                                    // Check if the image dimensions are 1280x720
                                    if (img.width === 1280 && img.height === 720) {
                                        // Valid image dimensions
                                        document.getElementById('error-message').style.display =
                                            'none'; // Hide error message
                                    } else {
                                        // Invalid image dimensions
                                        document.getElementById('error-message').style.display = 'block';
                                        document.getElementById('error-message').innerText =
                                            'Error: Image dimensions must be 1280x720. Your image is ' + img.width +
                                            'x' + img.height + '.';
                                        fileInput.value = ''; // Optionally, clear the file input
                                    }
                                };
                                // Read the image file to trigger the onload event
                                img.src = URL.createObjectURL(file);
                            }
                        }
                        </script>


                        <!-- Include Quill's JavaScript -->
                        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

                        <script>
                        // Initialize Quill editor
                        var quill = new Quill('#editor-container', {
                            theme: 'snow', // You can change the theme
                            modules: {
                                toolbar: [
                                    [{
                                        'header': '1'
                                    }, {
                                        'header': '2'
                                    }, {
                                        'font': []
                                    }],
                                    [{
                                        'list': 'ordered'
                                    }, {
                                        'list': 'bullet'
                                    }],
                                    ['bold', 'italic', 'underline'],
                                    [{
                                        'align': []
                                    }],
                                    ['link']
                                ]
                            }
                        });

                        // Set the content of the Quill editor to the value of the PHP variable
                        // We use <?php echo json_encode($video_description); ?> to safely echo the value
                        var videoDescription = <?php echo json_encode($video_description); ?>;
                        quill.root.innerHTML = videoDescription;

                        // Sync the Quill editor content with the hidden textarea when the form is submitted
                        document.querySelector('form').addEventListener('submit', function() {
                            var hiddenTextarea = document.getElementById('hidden-textarea');
                            hiddenTextarea.value = quill.root
                                .innerHTML; // Sync the HTML content with the textarea
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>