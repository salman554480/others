<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 4 Offline Example</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Offcanvas navbar</a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-truncate" href="#">Switch account</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Settings</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 text-nowrap">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="nav-scroller bg-white box-shadow">
        <nav class="nav nav-underline">
            <a class="nav-link active" href="#">Dashboard</a>
            <a class="nav-link" href="#"> Friends <span class="badge badge-pill bg-light align-text-bottom">27</span>
            </a>
            <a class="nav-link" href="#">Explore</a>
            <a class="nav-link" href="#">Suggestions</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
        </nav>
    </div>


    <div class="container my-4">
        <h2 class="text-center">Meme Generator</h2>
        <p class="text-center">Meme Generator
            The Fastest Meme Generator on the Planet. Easily add text to images or memes.</p>
        <div class="row my-5 bg-white p-4">
            <div class="col-md-5">
                <h4>Select Template</h4>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "meme");


                $select_meme = "SELECT * FROM template";
                $run_meme = mysqli_query($conn, $select_meme);
                while ($row_meme = mysqli_fetch_array($run_meme)) {
                    $template_id = $row_meme['template_id'];
                    $template_name = $row_meme['template_name'];
                ?>
                <a href="index.php?template_id=<?php echo $template_id; ?>" class="mb-3"><img
                        src="meme-images/<?php echo  $template_name; ?>" style="height:80px; object-fit:cover;"
                        alt=""></a>
                <?php } ?>
            </div>
            <div class="col-md-7">

                <?php
                if (isset($_GET['template_id'])) {
                    $template_id = $_GET['template_id'];
                    $select_meme = "SELECT * FROM template WHERE template_id='$template_id'";
                    $run_meme = mysqli_query($conn, $select_meme);
                    $row_meme = mysqli_fetch_array($run_meme);
                    $template_id = $row_meme['template_id'];
                    $template_name = $row_meme['template_name'];
                    $template_height = $row_meme['template_height'];
                    $template_width = $row_meme['template_width'];
                    $text_count = $row_meme['template_text_count'];
                    $template_text_color = $row_meme['template_text_color'];
                    $template_text_size = $row_meme['template_text_size'];

                    $image_path = "meme-images/" . $template_name;
                    $font =  $template_text_size . " Ariel";
                }
                ?>



                <form id="memeForm" class="my-3">
                    <?php
                    // Dynamically generate text fields based on $text_count
                    for ($i = 1; $i <= @$text_count; $i++) { ?>
                    <div class="form-group">
                        <input type="text" id="text<?php echo $i ?>" class="form-control"
                            placeholder="Text <?php echo $i; ?>" required>

                    </div>
                    <?php
                    }
                    ?>
                    <!-- <button type="submit">Generate Meme</button> -->
                </form>
                <canvas id="memeCanvas" width="600" height="400"></canvas>
                <div id="output"></div>
            </div>
        </div>



    </div>


    <script>
    let textArray = []; // To store dynamic text values
    let textPositions = []; // To store positions of dynamic text fields

    // Predefined image path
    const imagePath = "<?php echo $image_path; ?>"; // Replace with your actual image path

    // Load the image by default when the page loads
    const img = new Image();
    img.src = imagePath;

    // Wait until the image is loaded
    img.onload = function() {
        const canvas = document.getElementById('memeCanvas');
        const ctx = canvas.getContext('2d');

        // Set canvas dimensions to match the image dimensions
        canvas.width = img.width;
        canvas.height = img.height;

        // Draw the image on the canvas
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        // Initialize text positions (spacing them evenly)
        const spacing = canvas.height / (textCount + 1);
        for (let i = 0; i < textCount; i++) {
            textPositions.push({
                x: canvas.width / 2,
                y: spacing * (i + 1)
            });
        }

        // Draw the text on the canvas for the first time
        drawTextOnCanvas();
    };

    // Get the text count from PHP
    const textCount = <?php echo $text_count; ?>;

    // Listen to user input for the dynamic text fields
    for (let i = 1; i <= textCount; i++) {
        document.getElementById('text' + i).addEventListener('input', updateText);
    }

    // Function to update text and redraw it on the canvas
    function updateText() {
        textArray = []; // Reset the text array
        for (let i = 1; i <= textCount; i++) {
            textArray.push(document.getElementById('text' + i).value);
        }
        drawTextOnCanvas();
    }

    // Function to draw text on the canvas over the image
    function drawTextOnCanvas() {
        const canvas = document.getElementById('memeCanvas');
        const ctx = canvas.getContext('2d');

        // Clear canvas before redrawing
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Redraw the image
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        // Draw the dynamic text
        ctx.font = "<?php echo $font ?>";
        ctx.fillStyle = "<?php echo $template_text_color ?>";
        ctx.strokeStyle = "<?php echo $template_text_color ?>";
        ctx.lineWidth = 1;
        ctx.textAlign = "center";

        for (let i = 0; i < textCount; i++) {
            // Draw each piece of text based on its dynamic position
            ctx.fillText(textArray[i], textPositions[i].x, textPositions[i].y);
            ctx.strokeText(textArray[i], textPositions[i].x, textPositions[i].y);
        }
    }

    // Handle drag functionality for text
    let isDragging = null; // Null indicates no dragging

    document.getElementById('memeCanvas').addEventListener('mousedown', (e) => {
        const mouseX = e.offsetX;
        const mouseY = e.offsetY;

        // Check if any of the text positions are clicked
        for (let i = 0; i < textCount; i++) {
            const textPos = textPositions[i];
            if (mouseX > textPos.x - 100 && mouseX < textPos.x + 100 && mouseY > textPos.y - 20 && mouseY <
                textPos.y + 20) {
                isDragging = i; // Set the index of the text being dragged
                break;
            }
        }
    });

    document.getElementById('memeCanvas').addEventListener('mousemove', (e) => {
        if (isDragging !== null) {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;

            // Update the position of the dragged text
            textPositions[isDragging].x = mouseX;
            textPositions[isDragging].y = mouseY;

            // Redraw the image with updated text
            drawTextOnCanvas();
        }
    });

    document.getElementById('memeCanvas').addEventListener('mouseup', () => {
        isDragging = null; // Reset the dragging state
    });
    </script>

    <div class="container bg-white p-4 mb-4">
        <h3>Popular Memes</h3>
        <div class="row mt-4 ">
            <?php
            $pic = 1;
            while ($pic < 7) {
            ?>
            <div class="col-md-2">
                <img src="https://picsum.photos/300/300?random=<?php echo $pic; ?>" class="w-100" alt="">
            </div>
            <?php $pic++;
            } ?>
        </div>
    </div>

    <div class="container bg-white p-4 mb-4">
        <div class="row">
            <div class="col-md-12">
                <div id="gen-qa" class="content-area">
                    <h2 class="gen-q">What is the Meme Generator?</h2>
                    <p>It's a free online image maker that lets you add custom resizable text, images, and much more to
                        templates.
                        People often use the generator to customize established <a
                            href="https://en.wikipedia.org/wiki/Meme">memes</a>,
                        such as those found in Imgflip's collection of <a href="/memetemplates">Meme Templates</a>.
                        However, you can also upload your own templates or start from scratch with empty templates.</p>
                    <h2 class="gen-q">How to make a meme</h2>
                    <ol>
                        <li><b>Choose a template.</b> You can use one of the popular templates, search through more than
                            1 million
                            user-uploaded templates using the search input, or hit "Upload new template" to upload your
                            own template
                            from your device or from a url. For designing from scratch, try searching "empty" or "blank"
                            templates.
                        </li>
                        <li><b>Add customizations.</b> Add text, images, stickers, drawings, and spacing using the
                            buttons beside
                            your meme canvas.</li>
                        <li><b>Create and share.</b> Hit "Generate Meme" and then choose how to share and save your
                            meme. You can
                            share to social apps or through your phone, or share a link, or download to your device. You
                            can also
                            share with one of Imgflip's many meme communities.</li>
                    </ol>
                    <h2 class="gen-q">How can I customize my meme?</h2>
                    <ul>
                        <li>You can move and resize the text boxes by dragging them around. If you're on a mobile
                            device,
                            you may have to first check "enable drag/drop" in the More Options section. You can add as
                            many
                            additional text boxes as you want with the Add Text button.
                        </li>
                        <li>You can customize the font color and outline color next to where you type your text.
                        </li>
                        <li>You can further customize the font for each text box using the gear icon next to the text
                            input.
                            Imgflip supports all fonts installed on your device including the default Windows, Mac, and
                            web fonts,
                            including bold and italic. Over 1,300 free fonts are also supported for all devices. Any
                            other font
                            you want can be used if you first install it on your device and then type in the font name
                            on Imgflip.
                        </li>
                        <li>You can insert popular or custom stickers and other images including scumbag hats,
                            deal-with-it
                            sunglasses, speech bubbles, and more. Opacity and resizing are supported, and you can
                            copy/paste images
                            using CMD/CTRL + C/V for quick creation.
                        </li>
                        <li>You can rotate, flip, and crop any templates you upload.
                        </li>
                        <li>You can draw, outline, or scribble on your meme using the panel just above the meme preview
                            image.
                        </li>
                        <li>You can create "meme chains" of multiple images stacked vertically by adding new images with
                            the
                            "below current image" setting.
                        </li>
                        <li>You can add special image effects like posterize, jpeg artifacts, blur, sharpen, and color
                            filters
                            like grayscale, sepia, invert, and brightness.</li>
                        <li>You can remove our subtle imgflip.com watermark (as well as remove ads and supercharge your
                            image
                            creation abilities) using <a href="/pro?from=mfaq_watermark">Imgflip Pro</a>
                            or <button type="button" class="a mm-show-pro-basic">Imgflip Pro Basic</button>.</li>
                    </ul>
                    <h2 class="gen-q">Can I use the generator for more than just memes?</h2>
                    <p>
                        Yes! The Meme Generator is a flexible tool for many purposes. By uploading custom images and
                        using
                        all the customizations, you can design many creative works including
                        posters, banners, advertisements, and other custom graphics.
                    </p>
                    <h2 class="gen-q">Can I make animated or video memes?</h2>
                    <p>
                        Yes! Animated meme templates will show up when you search in the Meme Generator above (try
                        "party parrot").
                        If you don't find the meme you want, browse all the <a href="/gif-templates">GIF Templates</a>
                        or upload
                        and save your own animated template using the <a href="/gif-maker">GIF Maker</a>.
                    </p>
                    <h2 class="gen-q">Do you have a wacky AI that can write memes for me?</h2>
                    <p>
                        Funny you ask. Why yes, we do. Here you go:
                        <a href="/ai-meme">imgflip.com/ai-meme</a> (warning, may contain vulgarity)
                    </p>

                </div>
            </div>
        </div>
    </div>

    <div class="container bg-white p-4 mb-4">
        <h3>Latest Blogs</h3>
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <a href="post_details.php?post_url=<?php echo $post_url; ?>">
                        <img class="card-img-top" src="https://picsum.photos/1280/720" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="post_details.php?post_url=<?php echo $post_url; ?>" <h5 class="card-title">What is
                            MemeGenerator?
                            </h5>
                        </a>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat maiores
                            alias eos sint soluta adipisci, dolorem excepturi fugit explicab.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <a href="post_details.php?post_url=<?php echo $post_url; ?>">
                        <img class="card-img-top" src="https://picsum.photos/1280/720" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="post_details.php?post_url=<?php echo $post_url; ?>" <h5 class="card-title">How it
                            Works??
                            </h5>
                        </a>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat maiores
                            alias eos sint soluta adipisci, dolorem excepturi fugit explicab.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <a href="post_details.php?post_url=<?php echo $post_url; ?>">
                        <img class="card-img-top" src="https://picsum.photos/1280/720" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <a href="post_details.php?post_url=<?php echo $post_url; ?>" <h5 class="card-title">How to
                            Create Meme?
                            </h5>
                        </a>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat maiores
                            alias eos sint soluta adipisci, dolorem excepturi fugit explicab.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <!-- Footer Links -->
                <div class="col-md-4 d-flex align-items-center">
                    <h4 class="text-white">WebsiteName</h4>
                </div>
                <div class="col-md-4">
                    <h5 class="text-center">Quick Links</h5>
                    <ul class="nav d-flex justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>

                <!-- Social Icons -->
                <div class="col-md-4">
                    <h5 class="text-center">Follow Us</h5>
                    <div class="d-flex justify-content-center">
                        <div>
                            <a href="#" class="text-white mr-3"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>

                </div>


            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <p class="text-center">&copy; 2024 Your Company. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>





    <!-- Link to Bootstrap JS (with Popper.js) -->
    <script src="assets/bootstrap/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/bootstrap/popper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="assets/js/script.js"></script>
</body>

</html>