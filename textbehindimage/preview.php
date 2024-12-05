<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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

        // Use html2canvas to capture the div as an image
        html2canvas(previewArea).then(function(canvas) {
            // Create an anchor element
            const link = document.createElement('a');
            // Convert canvas to data URL
            link.href = canvas.toDataURL('image/png');
            // Set the download filename
            link.download = 'preview.png';
            // Trigger a click event on the anchor to download the image
            link.click();
        });
    }
    </script>
</body>

</html>