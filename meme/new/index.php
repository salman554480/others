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
        <h1>Create a Meme</h1>
        <form id="memeForm" enctype="multipart/form-data">
            <input type="file" id="imageInput" accept="image/*" required>
            <input type="text" id="topText" placeholder="Top Text" required>
            <input type="text" id="bottomText" placeholder="Bottom Text" required>
            <button type="submit">Generate Meme</button>
        </form>
        <canvas id="memeCanvas" width="600" height="400"></canvas>
        <div id="output"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>
