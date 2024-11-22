<?php require_once('parts/top.php'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
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


        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input class="form-control" type="text" name="post_title" id="postTitle"
                                            placeholder="Enter Title Here..." maxlength="100" oninput="generateURL()">
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://example.com/</span>
                                        </div>
                                        <input type="text" name="post_url" id="posturl" class="form-control"
                                            placeholder="URL/SLUG" readonly>
                                    </div>

                                    <!-- <div class="col-md-12 mb-3">
                                        <label class="form-label">URL</label>
                                        <input type="text" name="tool_url" id="posturl" class="form-control" readonly
                                            required />
                                    </div> -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="post_content" id="editor"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <input class="form-control" name="post_tags" type="text"
                                            placeholder="e.g. Web, Entertainment, Games ">
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="meta_keyword" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <label class="form-label">Meta Description</label>
                                        <textarea id="" type="text" name="meta_description"
                                            class="form-control"></textarea>
                                    </div>




                                </div>

                                <div class="col-md-3">

                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            <?php
                                            $select_category = "SELECT * FROM category";
                                            $result_category = mysqli_query($conn, $select_category);
                                            while ($row_category = mysqli_fetch_array($result_category)) {
                                                $category_id = $row_category['category_id'];
                                                $category_name = $row_category['category_name'];
                                            ?>
                                            <option value="<?php echo $category_id ?>"><?php echo $category_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Subcategory</label>
                                        <select class="form-control" name="subcategory_id" id="subcategory_id">
                                            <option value="">Select Subcategory</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail</label>
                                        <input class="form-control" name="post_thumbnail" type="file"
                                            id="videoThumbnail" onchange="validateImage()">
                                        <small class="text-muted">Size: 1280x720</small>
                                        <div id="error-message" style="color: red; display: none;"></div>
                                        <!-- Error message will be shown here -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="post_status">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Upload" name="upload"
                                            class="btn btn-success btn-block w-100">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <?php
                        if (isset($_POST['upload'])) {
                            $post_title =  $_POST['post_title'];
                            $post_url =  $_POST['post_url'];
                            $post_content =  $_POST['post_content'];
                            $category_id =  $_POST['category_id'];
                            $subcategory_id =  $_POST['subcategory_id'];
                            $post_status =  $_POST['post_status'];
                            $post_thumbnail_name =  $post_url . "_" . $_FILES['post_thumbnail']['name'];
                            $post_thumbnail_tmpname =   $_FILES['post_thumbnail']['tmp_name'];

                            $meta_title = htmlspecialchars($_POST['meta_title'], ENT_QUOTES, 'UTF-8');
                            $meta_description = htmlspecialchars($_POST['meta_description'], ENT_QUOTES, 'UTF-8');
                            $meta_keyword = htmlspecialchars($_POST['meta_keyword'], ENT_QUOTES, 'UTF-8');


                            $post_date = date('Y-m-d');
                            $post_time = date('h:i A');
                            echo        $insert_post = "INSERT INTO post(user_id,post_title,post_url,category_id,subcategory_id,post_content,post_thumbnail,post_date,post_time,post_status) VALUES('$user_id','$post_title','$post_url','$category_id','$subcategory_id','$post_content','$post_thumbnail_name','$post_date','$post_time','$post_status')";
                            $run_post =  mysqli_query($conn, $insert_post);
                            if ($run_post) {
                                move_uploaded_file($post_thumbnail_tmpname, '../assets/img/thumbnail/' . $post_thumbnail_name);


                                echo         $select_latest = "SELECT * FROM post where post_url='$post_url'";
                                $run_latest = mysqli_query($conn, $select_latest);
                                $row_latest_post =  mysqli_fetch_array($run_latest);
                                $post_id = $row_latest_post['post_id'];

                                $insert_meta = "INSERT INTO meta(meta_title,meta_description,meta_keyword,meta_source,meta_source_id) VALUES('$meta_title','$meta_description','$meta_keyword','post','$post_id')";
                                $run_meta = mysqli_query($conn, $insert_meta);

                                echo '<script>alert("post uploaded successfully")</script>';
                                echo '<script>window.location.href="post_view.php"</script>';
                            } else {
                                echo '<script>alert("Failed to upload post")</script>';
                            }
                        }
                        ?>



                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

                        <!-- Slug Generate -->
                        <script>
                        function generateURL() {
                            // Get the value from the title input
                            var title = document.getElementById('postTitle').value;

                            // Convert the title to a URL-friendly format (lowercase, spaces replaced with hyphens)
                            var url = title.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');

                            // Set the URL input field value
                            document.getElementById('posturl').value = url;
                        }
                        </script>


                        <!-- CKEditor -->
                        <script>
                        ClassicEditor
                            .create(document.querySelector('#editor'))
                            .catch(error => {
                                console.error(error);
                            });
                        </script>


                        <!-- Dynamic Subcategory -->
                        <script>
                        document.getElementById('category_id').addEventListener('change', function() {
                            var category_id = this.value;

                            // Check if a category is selected
                            if (category_id) {
                                // Make an AJAX request to fetch the subcategories
                                var xhr = new XMLHttpRequest();
                                xhr.open('GET', 'get_subcategories.php?category_id=' + category_id, true);
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        var subcategories = JSON.parse(xhr.responseText);
                                        var subcategory_select = document.getElementById('subcategory_id');

                                        // Clear any previous subcategories
                                        subcategory_select.innerHTML =
                                            '<option value="">Select Subcategory</option>';

                                        // Populate subcategories
                                        subcategories.forEach(function(subcategory) {
                                            var option = document.createElement('option');
                                            option.value = subcategory.subcategory_id;
                                            option.textContent = subcategory.subcategory_name;
                                            subcategory_select.appendChild(option);
                                        });
                                    }
                                };
                                xhr.send();
                            } else {
                                // Clear subcategory select if no category is selected
                                document.getElementById('subcategory_id').innerHTML =
                                    '<option value="">Select Subcategory</option>';
                            }
                        });
                        </script>


                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>