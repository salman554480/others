<?php require_once('parts/top.php'); ?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
    });
</script>
<?php echo require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">

    <?php require_once('parts/navbar.php'); ?>

    <div id="layoutSidenav">

        <?php require_once('parts/sidebar.php'); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="main-content-container container-fluid px-4">
                    <!-- Page Header -->

                    <div class="page-header ">
                        <div class="col-12 mt-4  mb-4 ">
                            <h4 class="mb-3">Add New Page</h4>

                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- form start -->
                    <div class="card mb-1">

                        <div class="card-header">
                            Add Page
                        </div>

                        <div class="card-body">
                            <form class="row g-3" action="" method="post" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <label class="form-label">Title*</label>
                                    <input type="text" name="page_title" id="page_title" class="form-control" autofocus required />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">URL*</label>
                                    <input type="text" name="page_url" id="page_url" class="form-control" required />
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Content*</label>
                                    <textarea id="mytextarea" type="text" name="page_content" class="add-new-post__editor mb-1"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Meta Title*</label>
                                    <input type="text" name="meta_title" class="form-control" required />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Meta Keywords*</label>
                                    <input type="text" name="meta_keywords" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Meta Description*</label>
                                    <textarea name="meta_description" class="form-control"></textarea>
                                </div>
                                <br><br>
                                <div class="col-md-12">

                                    <input type="submit" name="insert_btn" class="btn btn-sm btn-success" value="Update Record" />
                                </div>

                            </form>
                            <script>
                                // Function to generate a slug from a string
                                function generateSlug(title) {
                                    return title
                                        .toLowerCase() // Convert to lowercase
                                        .replace(/\s+/g, '-') // Replace spaces with dashes
                                        .replace(/[^a-z0-9-]/g, '') // Remove non-alphanumeric characters and dashes
                                        .replace(/--+/g, '-'); // Replace multiple dashes with a single dash
                                }

                                // Get references to the title and URL input fields
                                const titleInput = document.getElementById('page_title');
                                const urlInput = document.getElementById('page_url');

                                // Add event listener to the title input field
                                titleInput.addEventListener('input', function() {
                                    const titleValue = titleInput.value;
                                    const slug = generateSlug(titleValue);
                                    urlInput.value = slug;
                                });
                            </script>

                        </div>
                    </div>
                    <!-- form end -->

                    <?php
                    require_once('parts/db.php');
                    if (isset($_POST['insert_btn'])) {

                        $page_title = $_POST['page_title'];
                        $page_url = $_POST['page_url'];
                        $page_content = $_POST['page_content'];
                        $meta_title = $_POST['meta_title'];
                        $meta_description = $_POST['meta_description'];
                        $meta_keywords = $_POST['meta_keywords'];

                        $epage_content = str_replace("'", "\'", $epage_content);
                        $emeta_title = str_replace("'", "\'", $emeta_title);
                        $emeta_description = str_replace("'", "\'", $emeta_description);


                        $update_page = "INSERT INTO page(page_title,page_url,page_content,meta_title,meta_description,meta_keywords) VALUES('$page_title','$page_url','$page_content','$meta_title','$meta_description','$meta_keywords')";

                        $run_page = mysqli_query($conn, $update_page);

                        if ($run_page == true) {
                            echo "<script>alert('Record update');</script>";
                            //				echo "<script>window.open('page_edit.php?edit=$page_id','_self');</script>";


                        } else {
                            //echo "fail";
                            echo "<script>alert('Failed');</script>";
                        }
                    }

                    ?>


                </div>

        </div>
    </div>
    <?php require_once('parts/footer.php'); ?>
    <!--Footercdn--->
    <?php require_once('parts/footercdn.php'); ?>

</body>

</html>