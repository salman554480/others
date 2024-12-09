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

<?php
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $select_file = "SELECT * FROM file WHERE file_code='$code'";
    $run_file = mysqli_query($conn, $select_file);
    $row_file =  mysqli_fetch_array($run_file);
    $file_background =  $row_file['file_background'];
    $file_foreground =  $row_file['file_foreground'];
    $file_height =  $row_file['file_height'];
    $file_width =  $row_file['file_width'];
}
?>

<style>
<?php $select_font="SELECT * FROM font ";
$run_font=mysqli_query($conn, $select_font);

while ($row_font=mysqli_fetch_array($run_font)) {
    $font_path=$row_font['font_path'];

    echo $font_path;
}


?>.preview-area {
    height: <?php echo $file_height ?>px;

    width: <?php echo $file_width ?>px;
    /* height: 500px;
    width: 500px; */
    background-image: url('uploads/<?php echo $code; ?>_background.png');
    background-position: center;
    background-size: cover;
    position: relative;
}

.preview-area .text {
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 0;
    color: black;
    font-size: 100px;
    text-align: center;
    transition: all 0.3s ease;
    /* Smooth transition for dynamic changes */
}


.preview-area img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Ensures the image covers the entire div without distortion */
    z-index: 1;
    /* Places the image behind the text */
}
</style>

<!-- Updated html2canvas v1.4.1 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>



    <?php require_once('parts/navbar.php'); ?>

    <div class="container">
        <div class="ad-area my-4">
            <?php if ($ad_code_one == "") {
                echo "<img class='w-100' src='https://dummyimage.com/1400x150/a7a7a7/000000&text=++++++++++++++++Advertisement+++++++++++++'>";
            } {
                echo $ad_code_one;
            } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="preview-area" id="preview-area">
                    <h1 class="text" id="dynamic-text">HELLO</h1>
                    <img src="uploads/<?php echo $code; ?>_foreground.png" width="100%" alt="">
                </div>
                <button class="btn btn-success mt-4" onclick="downloadPreview()">Download Preview</button>

                <script>
                function downloadPreview() {
                    const previewArea = document.getElementById('preview-area');

                    // Ensure the background image is fully loaded before capturing
                    const backgroundImage = new Image();
                    backgroundImage.src = 'uploads/0CFCFBF1_background.png';
                    backgroundImage.onload = function() {
                        // Use html2canvas to capture the div as an image with the promise-based .then() API
                        html2canvas(previewArea, {
                            backgroundColor: null, // Keeps the transparent background
                            logging: true, // Optional: Logs messages for debugging
                            useCORS: true, // Allows cross-origin images
                            allowTaint: true, // Allows tainting of images from cross-origin sources
                            x: 0, // Starting X coordinate for the screenshot
                            y: 0, // Starting Y coordinate for the screenshot
                            width: previewArea.offsetWidth, // Width of the div
                            height: previewArea.offsetHeight, // Height of the div
                        }).then(function(canvas) {
                            const link = document.createElement('a');
                            link.href = canvas.toDataURL('image/png');
                            link.download = 'preview.png';
                            link.click();
                        }).catch(function(error) {
                            console.error("Error capturing the preview:", error);
                        });
                    };
                }
                </script>

                <div class="ad-area my-4">
                    <?php if ($ad_code_two == "") {
                        echo "<img class='w-100' src='https://dummyimage.com/700x200/a7a7a7/000000&text=++++++++++++++++Advertisement+++++++++++++'>";
                    } {
                        echo $ad_code_one;
                    } ?>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Interface for text customization -->
                <div class="text-controls">
                    <div class="form-group">

                        <label for="text-content">Text:</label>
                        <input type="text" class="form-control" id="text-content" value="HELLO" />
                    </div>

                    <div class="form-group">
                        <label for="font-family">Font Family:</label>
                        <select id="font-family" class="form-control">
                            <?php $select_font = "SELECT * FROM font ORDER BY font_id DESC";
                            $run_font = mysqli_query($conn, $select_font);

                            while ($row_font = mysqli_fetch_array($run_font)) {
                                $font_path = $row_font['font_path'];
                                $font_name = $row_font['font_name'];
                            ?>
                            <option style="font-family:<?php echo $font_name; ?>" value="<?php echo $font_name; ?>">
                                <?php echo $font_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="text-color">Text Color:</label>
                        <input type="color" class="form-control" id="text-color" value="#000000">
                    </div>


                    <div class="form-group">

                        <label for="text-x-position">X Position:</label>
                        <input type="number" class="form-control" id="text-x-position" value="50" min="0" max="100">
                    </div>

                    <div class="form-group">
                        <label for="text-y-position">Y Position:</label>
                        <input type="number" class="form-control" id="text-y-position" value="30" min="0" max="100">
                    </div>

                    <div class="form-group">
                        <label for="font-size">Font Size (px):</label>
                        <input type="number" class="form-control" id="font-size" value="100" min="10" max="200">
                    </div>

                    <div class="form-group">
                        <label for="font-weight">Font Weight:</label>
                        <select id="font-weight" class="form-control">
                            <option value="normal">Normal</option>
                            <option value="bold">Bold</option>
                            <option value="bolder">Bolder</option>
                            <option value="lighter">Lighter</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="font-opacity">Font Opacity:</label>
                        <input type="range" class="form-control" id="font-opacity" value="1" min="0" max="1" step="0.1">
                    </div>
                    <div class="form-group">
                        <label for="text-rotate">Text Rotate (degrees):</label>
                        <input type="number" class="form-control" id="text-rotate" value="0" min="0" max="360">

                    </div>
                </div>
            </div>
        </div>
        <script>
        // Get the elements
        const textElement = document.getElementById('dynamic-text');
        const textContentInput = document.getElementById('text-content');
        const fontFamilyInput = document.getElementById('font-family');
        const textColorInput = document.getElementById('text-color');
        const textXPositionInput = document.getElementById('text-x-position');
        const textYPositionInput = document.getElementById('text-y-position');
        const fontSizeInput = document.getElementById('font-size');
        const fontWeightInput = document.getElementById('font-weight');
        const fontOpacityInput = document.getElementById('font-opacity');
        const textRotateInput = document.getElementById('text-rotate');

        // Function to update the text properties
        function updateTextProperties() {
            const content = textContentInput.value;
            const fontFamily = fontFamilyInput.value;
            const textColor = textColorInput.value;
            const xPosition = textXPositionInput.value;
            const yPosition = textYPositionInput.value;
            const fontSize = fontSizeInput.value;
            const fontWeight = fontWeightInput.value;
            const fontOpacity = fontOpacityInput.value;
            const textRotate = textRotateInput.value;

            // Apply changes to the text element
            textElement.textContent = content;
            textElement.style.fontFamily = fontFamily;
            textElement.style.color = textColor;
            textElement.style.left = `${xPosition}%`;
            textElement.style.top = `${yPosition}%`;
            textElement.style.fontSize = `${fontSize}px`;
            textElement.style.fontWeight = fontWeight;
            textElement.style.opacity = fontOpacity;
            textElement.style.transform = `translate(-50%, -50%) rotate(${textRotate}deg)`; // Keep centering + rotate
        }

        // Add event listeners to inputs to update text properties
        textContentInput.addEventListener('input', updateTextProperties);
        fontFamilyInput.addEventListener('change', updateTextProperties);
        textColorInput.addEventListener('input', updateTextProperties);
        textXPositionInput.addEventListener('input', updateTextProperties);
        textYPositionInput.addEventListener('input', updateTextProperties);
        fontSizeInput.addEventListener('input', updateTextProperties);
        fontWeightInput.addEventListener('change', updateTextProperties);
        fontOpacityInput.addEventListener('input', updateTextProperties);
        textRotateInput.addEventListener('input', updateTextProperties);

        // Initial update to apply the default values
        updateTextProperties();
        </script>



    </div>
    <?php require_once('parts/footer.php'); ?>

</body>

</html>