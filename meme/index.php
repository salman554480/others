<?php
// Define the API URL
$apiUrl = 'https://api.imgflip.com/get_memes';

// Fetch the JSON response from the API
$response = file_get_contents($apiUrl);

// Decode the JSON response
$data = json_decode($response, true);

// Check if the response was successful
if ($data['success']) {
    $memes = $data['data']['memes'];
} else {
    $memes = [];
    echo '<p>Failed to load memes.</p>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imgflip Meme Generator</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0;
        background-color: #f7f7f7;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    .meme-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .meme {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        background-color: white;
        text-align: center;
        width: 150px;
        cursor: pointer;
    }

    .meme img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .meme h3 {
        margin-top: 10px;
        font-size: 14px;
    }

    .form-container {
        margin-top: 30px;
        display: none;
        text-align: center;
    }

    .form-container input {
        margin: 5px;
        padding: 5px;
        width: 200px;
    }

    .form-container button {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <h1>Imgflip Meme Generator</h1>
    <p>Click on a meme to add captions:</p>

    <div class="meme-container">
        <?php
        // Loop through each meme and display it
        foreach ($memes as $meme) {
            echo '<div class="meme" onclick="selectMeme(\'' . $meme['id'] . '\', \'' . $meme['name'] . '\', ' . $meme['box_count'] . ')">';
            echo '<img src="' . $meme['url'] . '" alt="' . htmlspecialchars($meme['name']) . '">';
            echo '<h3>' . htmlspecialchars($meme['name']) . '</h3>';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Form to enter meme captions -->
    <div id="formContainer" class="form-container">
        <h2>Enter Text for Meme</h2>
        <form id="memeForm" method="POST" action="generate_meme.php">
            <div id="inputFields"></div>
            <button type="submit">Generate Meme</button>
            <input type="hidden" name="memeId" id="memeId">
            <input type="hidden" name="imageUrl" id="imageUrl">
        </form>
    </div>

    <script>
    // Function to handle meme selection
    function selectMeme(memeId, memeName, boxCount) {
        // Show the form container
        document.getElementById('formContainer').style.display = 'block';

        // Set meme ID and URL
        document.getElementById('memeId').value = memeId;
        document.getElementById('imageUrl').value = `https://i.imgflip.com/${memeId}.jpg`;

        // Clear previous input fields
        const inputFieldsDiv = document.getElementById('inputFields');
        inputFieldsDiv.innerHTML = '';

        // Create input fields based on box_count
        for (let i = 0; i < boxCount; i++) {
            let label = document.createElement('label');
            label.innerHTML = 'Text for box ' + (i + 1) + ':';
            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'boxes[' + i + '][text]';
            input.placeholder = `Enter text for box ${i + 1}`;
            inputFieldsDiv.appendChild(label);
            inputFieldsDiv.appendChild(input);
            inputFieldsDiv.appendChild(document.createElement('br'));
        }
    }
    </script>

</body>

</html>