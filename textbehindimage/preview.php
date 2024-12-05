<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .preview-area {
        height: 500px;
        width: 500px;
        background-image: url('uploads/6CC12EBB_background.png');
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
        /* Ensures the text is on top of the background */
        color: white;
        /* You can adjust the text color */
        font-size: 100px;
        /* Adjust the font size as needed */
        text-align: center;
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

    /* Style the button */
    .download-btn {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
    }
    </style>

    <!-- Updated html2canvas v1.4.1 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>
    <div class="preview-area" id="preview-area">
        <h1 class="text">HELLO</h1>
        <img src="uploads/6CC12EBB_foreground.png" width="100%" alt="">
    </div>

    <button class="download-btn" onclick="downloadPreview()">Download Preview</button>

    <script>
    function downloadPreview() {
        const previewArea = document.getElementById('preview-area');

        // Ensure the background image is fully loaded before capturing
        const backgroundImage = new Image();
        backgroundImage.src = 'uploads/6CC12EBB_background.png';
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
</body>

</html>