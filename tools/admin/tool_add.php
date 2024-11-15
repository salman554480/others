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
            <h4 class="mb-3">Add tool</h4>

            <a href="admin_view.php" class="btn btn-sm btn-outline-danger">View Record*</a>
            <a href="admin_trash.php" class="btn btn-sm btn-outline-primary ">Trash Record*</a>
          </div>
        </div>
        <!-- End Page Header -->

        <!-- form start -->
        <div class="card mb-1">

          <div class="card-header">
            Enter tool Record
          </div>

          <div class="card-body">
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">

              <div class="col-md-4">
                <label class="form-label">Name</label>
                <input type="text" name="tool_name" id="tool_title" class="form-control" autofocus required />
              </div>

              <div class="col-md-4">
                <label class="form-label">URL*</label>
                <input type="text" name="tool_url" id="tool_url" class="form-control" autofocus required />
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
                      <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <label class="form-label">Content*</label>
            <div id="editor" style="height: 300px;"></div>
        <textarea name="content" id="content" style="display:none;"></textarea>

              <div class="col-md-12">
                <label class="form-label">HTML Code*</label>
                <textarea id="" type="text" name="tool_html_code" class="form-control"></textarea>
              </div>

              <div class="col-md-12">
                <label class="form-label">CSS Code*</label>
                <textarea id="" type="text" name="tool_css_code" class="form-control"></textarea>
              </div>

              <div class="col-md-12">
                <label class="form-label">JS Code*</label>
                <textarea id="" type="text" name="tool_js_code" class="form-control"></textarea>
              </div>

              <div class="col-md-12">
                <label class="form-label">PHP Code*</label>
                <textarea id="" type="text" name="tool_php_code" class="form-control"></textarea>
              </div>



              <br><br><br><br>
              <div class="col-md-12">

                <input type="submit" name="insert_btn" class="btn btn-sm btn-success" value="Add Record" />
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
              const titleInput = document.getElementById('tool_title');
              const urlInput = document.getElementById('tool_url');

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
          $tool_name = $_POST['tool_name'];
          $tool_content = $_POST['content'];
          $tool_url = $_POST['tool_url'];
          $tool_html_code = mysqli_real_escape_string($conn, $_POST['tool_html_code']);
          $tool_css_code = mysqli_real_escape_string($conn, $_POST['tool_css_code']);
          $tool_js_code = mysqli_real_escape_string($conn, $_POST['tool_js_code']);
          $tool_php_code = mysqli_real_escape_string($conn, $_POST['tool_php_code']);

          $insert_admin = "INSERT INTO tool(
            category_id,
            tool_name,
            tool_content,
            tool_url,
            tool_html,
            tool_css,
            tool_js,
            tool_php,
            tool_status
            )VALUES(
            '$category_id',
            '$tool_name',
            '$tool_content',
            '$tool_url',
            '$tool_html_code',
            '$tool_css_code',
            '$tool_js_code',
            '$tool_php_code',
            'publish')";

          $run_admin = mysqli_query($conn, $insert_admin);

          if ($run_admin == true) {
            //echo "data is inserted ";
            //		move_uploaded_file($tmp_name,"upload/admin/$admin_image");
            echo "<script>alert('Record Added');</script>";
            echo "<script>window.open('tool_view.php','_self');</script>";
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