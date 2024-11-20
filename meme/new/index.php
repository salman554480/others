<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meme Generator</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <form id="memeForm">
            <?php
            $text_count = 3;
            // Dynamically generate text fields based on $text_count
            for ($i = 1; $i <= $text_count; $i++) {
                echo "<input type='text' id='text{$i}' placeholder='Text {$i}' required>";
            }
            ?>
            <button type="submit">Generate Meme</button>
        </form>
        <canvas id="memeCanvas" width="600" height="400"></canvas>
        <div id="output"></div>
    </div>


    <script>
    let textArray = []; // To store dynamic text values
    let textPositions = []; // To store positions of dynamic text fields

    // Predefined image path
    const imagePath = 'image.png'; // Replace with your actual image path

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
        ctx.font = "30px Arial";
        ctx.fillStyle = "white";
        ctx.strokeStyle = "black";
        ctx.lineWidth = 3;
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
</body>

</html>