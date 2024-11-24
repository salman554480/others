<?php
require_once('admin/parts/db.php');
$select_page = "SELECT * FROM page WHERE page='homepage'";
$run_page = mysqli_query($conn, $select_page);
$row_page =  mysqli_fetch_array($run_page);
$page_title =  $row_page['page_title'];
$page_content =  $row_page['page_content'];
$meta_title =  $row_page['meta_title'];
$meta_description =  $row_page['meta_description'];
$meta_keywords =  $row_page['meta_keywords'];

?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

    <?php require_once('parts/navbar.php'); ?>


    <section class="mb-5 pt-5 pb-5 pb-0 homepage-hero-module" style="background-size: cover; min-height: 75vh; background-image: url(&quot;https://images.unsplash.com/photo-1542351967-d5ae722fed71?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1782&amp;q=800&quot;);">
        <div class="bg-overlay position-absolute"></div>
        <div class="container position-relative zindex-1 pt-3 pb-3">
            <div class="row  text-center align-content-center justify-content-between ">
                <div class="col-12 col-md-7 pr-md-5 text-left align-self-center ">
                    <p class="lead text-warning">RANDOM IMAGES </p>
                    <h1 class="mb-4 text-white font-weight-bold  "><strong>Generate Random Images </strong></h1>

                    <p class="lead text-white">Generate Random Images according to your Required Size. Image Shuffle: Let the Pixels Guide Your Journey</p>
                    <img src="https://dummyimage.com/550x100/A7a7a7/fff&text=Advertisement" alt="">

                </div>
                <div class="col-12  col-md-5 ">
                    <div class="card shadow-lg border border-primary text-white text-left h-100">
                        <div class="card-body bg-primary px-4 py-5">
                            <h3 class="pb-3 font-weight-bold text-center">Generate any Size Image on Single Click</h3>
                            <form action="#" method="post" class="registration-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-name">Width(px)</label>
                                            <input type="text" name="width" placeholder="Width (e.g., 400):" class="form-name form-control-lg form-control" id="form-name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-name">Height(px)</label>
                                            <input type="text" name="height" placeholder="Height (e.g., 300):" class="form-name form-control-lg form-control" id="form-name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-name">Category</label>
                                            <input type="text" name="category" placeholder="Category (e.g., nature, people, abstract):" class="form-name form-control-lg form-control" id="form-name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-name">Number of Images</label>
                                            <input type="text" name="count" placeholder="Number of Images:" class="form-name form-control-lg form-control" id="form-name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="grayscale">Grayscale:</label>
                                    <input type="checkbox" class="custom-checkbox" name="grayscale">

                                    <label for="blur">Blur:</label>
                                    <input type="checkbox" class="custom-checkbox" name="blur">
                                </div>
                                <button type="submit" name="submit" class="btn btn-dark btn-lg mt-2 shadow-lg">Generate Images</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <img src="https://dummyimage.com/1600x100/A7a7a7/fff&text=Advertisement" class="w-100" alt="">
    </div>

    <div id="imageContainer mt-5">
        <h1 class="text-center">Random Generated Images</h1>
        <?php
        if (isset($_POST['submit'])) {
            $width = $_POST['width'];
            $height = $_POST['height'];
            $category = $_POST['category'];
            $count = $_POST['count'];
            $grayscale = isset($_POST['grayscale']) ? "&grayscale" : "";
            $blur = isset($_POST['blur']) ? "&blur" : "";

            for ($i = 0; $i < $count; $i++) {
                $imageUrl = "https://picsum.photos/$width/$height?random=$i&category=$category$grayscale$blur";
        ?>

                <div class='image-card'>
                    <img src='<?php echo $imageUrl ?>' alt='Random Image <?php echo $i; ?>'>

                </div>

        <?php }
        }
        ?>
    </div>

    <div class="container">
        <img src="https://dummyimage.com/1600x100/A7a7a7/fff&text=Advertisement" class="w-100" alt="">
    </div>



    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <?php echo $page_content; ?>
            </div>
        </div>
    </div>





    <?php require_once('parts/footer.php'); ?>



</body>

</html>