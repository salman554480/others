<!DOCTYPE html>
<html>

<head>
    <title>File Upload</title>
</head>

<body>
    <?php
    $conn =  mysqli_connect('localhost', 'root', '', 'videostreamer');
    if (isset($_GET['file_access_key'])) {
        $file_access_key = $_GET['file_access_key'];
        $user_id = $_GET['user_id'];
    }
    ?>

    <form id="fileUploadForm" action="" method="post" enctype="multipart/form-data">
        <label for="files">Select files to upload:</label>
        <input type="file" name="files[]" id="files" multiple required>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="file_access_key" value="<?php echo $file_access_key; ?>">
        <input type="button" id="uploadButton" value="Upload">
    </form>
    <div id="uploadStatus"></div>

    <script>
    document.getElementById('uploadButton').addEventListener('click', async function() {
        const files = document.getElementById('files').files;
        const user_id = document.querySelector('input[name="user_id"]').value;
        const file_access_key = document.querySelector('input[name="file_access_key"]').value;

        for (let i = 0; i < files.length; i++) {
            const formData = new FormData();
            formData.append('file', files[i]);
            formData.append('user_id', user_id);
            formData.append('file_access_key', file_access_key);

            try {
                const response = await fetch(
                'upload.php', { // Change 'upload.php' to your PHP handling file
                    method: 'POST',
                    body: formData
                });

                const result = await response.text();
                document.getElementById('uploadStatus').innerHTML +=
                    `Response for ${files[i].name}: ${result}<hr>`;
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('uploadStatus').innerHTML += `Error uploading ${files[i].name}<br>`;
            }
        }
    });
    </script>

    <form id="fileUploadForm" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="file_access_key" value="<?php echo $file_access_key; ?>">
        <input type="submit" name="done" id="" value="Done">
    </form>
    <?php
    if (isset($_POST['done'])) {
        $file_access_key =  $_POST['file_access_key'];
        $update_state = "UPDATE file SET file_state='upload' WHERE file_access_key='$file_access_key'";
        $run_update_state =  mysqli_query($conn, $update_state);
        if ($run_update_state === true) {
            echo "<script>window.open('../index.php','self');</script>";
        }
    }
    ?>
</body>

</html>