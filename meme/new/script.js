document.getElementById('imageInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (event) {
            const img = new Image();
            img.src = event.target.result;

            img.onload = function () {
                // Set canvas dimensions to match image
                const canvas = document.getElementById('memeCanvas');
                const ctx = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;

                // Draw the image on canvas
                ctx.drawImage(img, 0, 0);

                // Redraw text every time the canvas is updated
                drawImageWithText();
            };
        };

        reader.readAsDataURL(file);
    }
});

let topText = '';
let bottomText = '';
let topTextPosition = { x: 150, y: 40 };
let bottomTextPosition = { x: 150, y: 350 };

document.getElementById('topText').addEventListener('input', updateText);
document.getElementById('bottomText').addEventListener('input', updateText);

function updateText() {
    topText = document.getElementById('topText').value;
    bottomText = document.getElementById('bottomText').value;
    drawImageWithText();
}

function drawImageWithText() {
    const canvas = document.getElementById('memeCanvas');
    const ctx = canvas.getContext('2d');
    const img = new Image();
    
    // Get the image file
    const fileInput = document.getElementById('imageInput');
    const file = fileInput.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            img.src = event.target.result;
            img.onload = function () {
                // Clear canvas and redraw the image
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                // Draw top text
                ctx.font = "30px Arial";
                ctx.fillStyle = "white";
                ctx.strokeStyle = "black";
                ctx.lineWidth = 3;
                ctx.textAlign = "center";
                ctx.fillText(topText, topTextPosition.x, topTextPosition.y);
                ctx.strokeText(topText, topTextPosition.x, topTextPosition.y);

                // Draw bottom text
                ctx.fillText(bottomText, bottomTextPosition.x, bottomTextPosition.y);
                ctx.strokeText(bottomText, bottomTextPosition.x, bottomTextPosition.y);
            };
        };
        reader.readAsDataURL(file);
    }
}

// Handle drag functionality
let isDraggingTop = false;
let isDraggingBottom = false;

document.getElementById('memeCanvas').addEventListener('mousedown', (e) => {
    const mouseX = e.offsetX;
    const mouseY = e.offsetY;

    if (mouseX > topTextPosition.x - 100 && mouseX < topTextPosition.x + 100 && mouseY > topTextPosition.y - 20 && mouseY < topTextPosition.y + 20) {
        isDraggingTop = true;
    }

    if (mouseX > bottomTextPosition.x - 100 && mouseX < bottomTextPosition.x + 100 && mouseY > bottomTextPosition.y - 20 && mouseY < bottomTextPosition.y + 20) {
        isDraggingBottom = true;
    }
});

document.getElementById('memeCanvas').addEventListener('mousemove', (e) => {
    if (isDraggingTop || isDraggingBottom) {
        const mouseX = e.offsetX;
        const mouseY = e.offsetY;

        if (isDraggingTop) {
            topTextPosition.x = mouseX;
            topTextPosition.y = mouseY;
        }

        if (isDraggingBottom) {
            bottomTextPosition.x = mouseX;
            bottomTextPosition.y = mouseY;
        }

        // Redraw image with text
        drawImageWithText();
    }
});

document.getElementById('memeCanvas').addEventListener('mouseup', () => {
    isDraggingTop = false;
    isDraggingBottom = false;
});
