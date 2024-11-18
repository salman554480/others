<?php require_once('parts/top.php'); ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body class="sb-nav-fixed">

  <?php require_once('parts/navbar.php'); ?>

  <div id="layoutSidenav">

    <?php require_once('parts/sidebar.php'); ?>

    <div id="layoutSidenav_content">
      <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header ">
          <div class="col-12 mt-4  mb-4">
            <h4 class="mb-3">Add Post</h4>

            <a href="admin_view.php" class="btn btn-sm btn-outline-danger">View Record*</a>
            <a href="admin_trash.php" class="btn btn-sm btn-outline-primary ">Trash Record*</a>
          </div>
        </div>
        <!-- End Page Header -->

        <!-- form start -->
        <div class="card mb-1">

          <div class="card-header">
            Enter Post Record
          </div>

          <div class="card-body">
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">

              <div class="col-md-4">
                <label class="form-label">Title</label>
                <input type="text" name="post_title" id="post_title" class="form-control" autofocus
                  required />
              </div>

              <div class="col-md-4">
                <label class="form-label">URL*</label>
                <input type="text" name="post_url" id="post_url" class="form-control" autofocus
                  required />
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Select Category</label>
                  <select class="form-control" name="category_id">
                    <?php

                    require_once('parts/db.php');
                    $select = "SELECT * FROM category ";
                    $run = mysqli_query($conn, $select);
                    while ($row = mysqli_fetch_array($run)) {

                      $category_id = $row['category_id'];
                      $category_name = $row['category_name'];
                    ?>
                      <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <label class="form-label">Content*</label>
              <div id="editor" style="height: 300px;"></div>
              <textarea name="content" id="content" style="display:none;"></textarea>

              <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keyword" class="form-control">
              </div>

              <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <textarea id="" type="text" name="meta_description" class="form-control"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label">Thumbnail</label>
                <input type="file" name="post_thumbnail" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="post_status" class="form-control">
                  <option value="publish">Publish</option>
                  <option value="draft">Draft</option>
                </select>
              </div>


              <br><br><br><br>
              <div class="col-md-12">

                <input type="submit" name="insert_btn" class="btn btn-sm btn-success"
                  value="Add Record" />
              </div>

            </form>

            <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

            <script>
              // Initialize Quill Editor
              var quill = new Quill('#editor', {
                theme: 'snow'
              });

              // Listen for the text-change event in Quill to update the hidden textarea
              quill.on('text-change', function(delta, oldDelta, source) {
                // Update the hidden textarea with the current HTML content of the editor
                document.querySelector('#content').value = quill.root.innerHTML;
              });
            </script>
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
              const titleInput = document.getElementById('post_title');
              const urlInput = document.getElementById('post_url');

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

          $category_id = $_POST['category_id'];
          $post_title = $_POST['post_title'];
          $post_url = $_POST['post_url'];
          $post_content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
          $post_status = $_POST['post_status'];
          $post_thumbnail = $_FILES['post_thumbnail']['name'];
          $post_thumbnail_tmp = $_FILES['post_thumbnail']['tmp_name'];

          $meta_title = htmlspecialchars($_POST['meta_title'], ENT_QUOTES, 'UTF-8');
          $meta_description = htmlspecialchars($_POST['meta_description'], ENT_QUOTES, 'UTF-8');
          $meta_keyword = htmlspecialchars($_POST['meta_keyword'], ENT_QUOTES, 'UTF-8');

          $post_date =  date('Y-m-d');

          $insert_admin = "INSERT INTO post(
            category_id,
            post_title,
            post_content,
            post_url,
            post_thumbnail,
            post_date,
            post_status
            )VALUES(
            '$category_id',
            '$post_title',
            '$post_content',
            '$post_url',
            '$post_thumbnail',
            '$post_date',
            '$post_status')";

          $run_admin = mysqli_query($conn, $insert_admin);

          if ($run_admin == true) {
            move_uploaded_file($post_thumbnail_tmp, "upload/$post_thumbnail");

            $select_latest = "SELECT * FROM post where post_url='$post_url'";
            $run_latest = mysqli_query($conn, $select_latest);
            $row_latest_post =  mysqli_fetch_array($run_latest);
            $post_id = $row_latest_post['post_id'];

            $insert_meta = "INSERT INTO meta(meta_title,meta_description,meta_keyword,meta_source,meta_source_id) VALUES('$meta_title','$meta_description','$meta_keyword','post','$post_id')";
            $run_meta = mysqli_query($conn, $insert_meta);

            echo "<script>alert('Record Added');</script>";
            echo "<script>window.open('post_view.php','_self');</script>";
          } else {
            //echo "fail";
            echo "<script>alert('Failed');</script>";
          }
        }

        ?>


      </div>
      <?php require_once('parts/footer.php'); ?>
    </div>

  </div>
  <!--FooterCdn-->
  <?php require_once('parts/footercdn.php'); ?>
</body>

</html>