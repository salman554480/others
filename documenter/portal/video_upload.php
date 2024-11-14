<?php require_once('parts/top.php'); ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-speedometer"></i> Blank Page</h1>
                <p>Start a beautiful journey here</p>
            </div>
        </div>
        <?php
        function generate_guid()
        {
            return sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff), // 32 bits for "time_low"
                mt_rand(0, 0xffff), // 16 bits for "time_mid"
                mt_rand(0, 0x0fff) | 0x4000, // 16 bits for "time_high_and_version" with version 4
                mt_rand(0, 0x3fff) | 0x8000, // 16 bits for "clk_seq_hi_res" with variant 1
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff) // 48 bits for "node"
            );
        }

        $video_guid = generate_guid();
        // Outputs a randomly generated GUID in the format xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx
        ?>

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
                                            placeholder="Enter Title Here..." maxlength="100">
                                        <small id="charCount" class="form-text ">0 / 60 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea id="hidden-textarea" name="video_description"
                                            style="display:none;"></textarea>

                                        <!-- Quill Editor Container -->
                                        <div id="editor-container">
                                            <!-- The Quill editor will be rendered here -->
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <input class="form-control" name="video_tags" type="text"
                                            placeholder="e.g. Web, Entertainment, Games ">
                                    </div>


                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Access Key</label>
                                        <input class="form-control" name="video_access_key" type="text"
                                            placeholder="Enter Access Key">
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
                                            <option value="<?php echo $category_id ?>"><?php echo $category_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail</label>
                                        <input class="form-control" name="video_thumbnail" type="file"
                                            id="videoThumbnail" onchange="validateImage()">
                                        <small class="text-muted">Size: 1280x720</small>
                                        <div id="error-message" style="color: red; display: none;"></div>
                                        <!-- Error message will be shown here -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="video_status">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
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
                            $video_title =  $_POST['video_title'];
                            $video_description =  $_POST['video_description'];
                            $video_access_key =  $_POST['video_access_key'];
                            $category_id =  $_POST['category_id'];
                            $video_status =  $_POST['video_status'];
                            $video_thumbnail_name =  $video_guid . "_" . $_FILES['video_thumbnail']['name'];
                            $video_thumbnail_tmpname =   $_FILES['video_thumbnail']['tmp_name'];


                            $video_date = date('Y-m-d');
                            $video_time = date('h:i A');
                            $insert_video = "INSERT INTO video(user_id,video_access_key,video_title,category_id,video_guid,video_description,video_thumbnail,video_date,video_time,video_status) VALUES('$user_id','$video_access_key','$video_title','$category_id','$video_guid','$video_description','$video_thumbnail_name','$video_date','$video_time','$video_status')";
                            $run_video =  mysqli_query($conn, $insert_video);
                            if ($run_video) {
                                move_uploaded_file($video_thumbnail_tmpname, 'images/thumbnail/' . $video_thumbnail_name);
                                echo '<script>alert("Video uploaded successfully")</script>';
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
                        // Initialize Quill editor on the container
                        var quill = new Quill('#editor-container', {
                            theme: 'snow', // Theme: snow is the default
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
                                    ['link', 'image'],
                                    ['blockquote', 'code-block']
                                ]
                            }
                        });

                        // Sync Quill content with the hidden textarea
                        quill.on('text-change', function(delta, oldDelta, source) {
                            // Update the hidden textarea with the content of the Quill editor
                            document.getElementById('hidden-textarea').value = quill.root.innerHTML;
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>