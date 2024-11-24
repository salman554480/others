<?php
require_once('admin/parts/db.php');
if (isset($_GET['page_url'])) {
    $page_url = $_GET['page_url'];
    $select_page = "SELECT * FROM page WHERE page_url='$page_url'";
    $run_page = mysqli_query($conn, $select_page);
    $row_page =  mysqli_fetch_array($run_page);
    $get_page_title =  $row_page['page_title'];
    $get_page_content =  $row_page['page_content'];
    $page_title = $row_page['page_title'];
    $page_url = $row_page['page_url'];
    $page_content = $row_page['page_content'];
    $meta_title = $row_page['meta_title'];
    $meta_description = $row_page['meta_description'];
    $meta_keywords = $row_page['meta_keywords'];
}
?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

    <?php require_once('parts/navbar.php'); ?>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $get_page_title; ?></h1>
                <?php echo $page_content ?>

                <?php
                if ($page_url == "contact-us") {
                    require_once('parts/contact-form.php');
                }
                ?>
            </div>
        </div>
    </div>


    <?php require_once('parts/footer.php'); ?>



</body>

</html>