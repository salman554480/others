<?php require_once('parts/top.php');

$folder_key = "123456789";
$package_id = "2";

?>
<style>
.file-container {
    margin-bottom: 0px;
}

.progress {
    margin-top: 10px;
}

.file-upload-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: #00695c;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-bottom: 20px;
}

.file-upload-label:hover {
    background-color: #00695c;
}

.file-upload-input {
    display: none;
    /* Hide the default file input */
}
</style>
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php require_once('parts/navbar.php'); ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php require_once('parts/sidebar.php'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-upload"></i> Upload Files</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <label for="fileInput" class="file-upload-label"><i class="bi bi-upload"></i> Select
                            Files</label>
                        <input type="file" id="fileInput" class="mb-5 file-upload-input" multiple />
                        <div id="progress"></div>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <script>
                        async function uploadFileInChunks(file, fileIndex, chunkSize = 1 * 1024 * 1024) { // 1 MB chunks
                            const totalChunks = Math.ceil(file.size / chunkSize);
                            let startTime = Date.now();
                            const UserId = <?php echo json_encode($user_id); ?>;
                            const FolderId = <?php echo json_encode($folder_key); ?>;
                            const PackageId = <?php echo json_encode($package_id); ?>;

                            if (PackageId == 1) {
                                if (totalChunks > 500) {
                                    alert(
                                        'The file size exceeds the allowed limit of 500 MB. Please upgrade your account to upload larger files.'
                                    );
                                    location.reload();
                                }
                            } else if (PackageId == 2) {
                                if (totalChunks > 2028) {
                                    alert(
                                        'The file size exceeds the allowed limit of 2 GB. Please upgrade your account to upload larger files.'
                                    );
                                    location.reload();
                                }
                            }


                            // Generate an 8-digit number
                            const randomEightDigitNumber = Math.floor(10000000 + Math.random() * 90000000);
                            const newFileName = `${randomEightDigitNumber}_${file.name}`;

                            for (let i = 0; i < totalChunks; i++) {
                                const start = i * chunkSize;
                                const end = Math.min(start + chunkSize, file.size);
                                const chunk = file.slice(start, end);

                                const formData = new FormData();
                                formData.append('fileChunk', chunk);
                                formData.append('chunkIndex', i);
                                formData.append('totalChunks', totalChunks);
                                formData.append('fileName', newFileName);
                                formData.append('UserId', UserId);
                                formData.append('FolderId', FolderId);

                                const chunkStartTime = Date.now();
                                const response = await fetch('counter-upload.php', {
                                    method: 'POST',
                                    body: formData
                                });
                                const chunkEndTime = Date.now();

                                // Calculate upload rate and remaining time
                                const chunkTime = (chunkEndTime - chunkStartTime) / 1000; // in seconds
                                const chunkSizeMB = chunk.size / (1024 * 1024); // convert to MB
                                const uploadRate = (chunkSizeMB / chunkTime).toFixed(2); // MB/s

                                const totalTime = (Date.now() - startTime) / 1000; // total time in seconds
                                const estimatedTotalTime = (totalTime / (i + 1)) * totalChunks;
                                const remainingTime = (estimatedTotalTime - totalTime).toFixed(
                                    2); // remaining time in seconds
                                const remainingTimeMin = (remainingTime / 60).toFixed(2);

                                // Update progress for this file
                                document.getElementById(`status-${fileIndex}`).innerText =
                                    `Uploading ${i + 1}/${totalChunks} MB`;
                                document.getElementById(`uploadRate-${fileIndex}`).innerText =
                                    `Speed: ${uploadRate} MB/s`;
                                document.getElementById(`remainingTime-${fileIndex}`).innerText =
                                    `Remaining Time: ${remainingTimeMin} Min`;

                                // Update progress bar
                                const progressBar = document.getElementById(`progress-${fileIndex}`);
                                progressBar.value = i + 1; // Update progress
                            }

                            // Mark upload completion for this file
                            document.getElementById(`status-${fileIndex}`).innerText =
                                `Upload Completed for ${file.name}`;
                            document.getElementById(`uploadRate-${fileIndex}`).style.display = "none";
                            document.getElementById(`remainingTime-${fileIndex}`).style.display = "none";
                        }

                        const fileInput = document.getElementById('fileInput');
                        fileInput.addEventListener('change', (event) => {
                            const files = event.target.files;
                            const progressContainer = document.getElementById('progress');
                            progressContainer.innerHTML = ''; // Clear previous progress

                            Array.from(files).forEach((file, fileIndex) => {
                                // Create a container for each file's progress
                                const fileContainer = document.createElement('div');
                                fileContainer.classList.add('file-container');

                                // Add progress bar
                                const progressBar = document.createElement('progress');
                                progressBar.classList.add('w-100');
                                progressBar.id = `progress-${fileIndex}`;
                                progressBar.value = 0;
                                progressBar.max = Math.ceil(file.size / (1 * 1024 *
                                    1024)); // Max is total chunks

                                fileContainer.innerHTML = `
                                            <p id="status-${fileIndex}">Status: Waiting for ${file.name}...</p>
                                            <div class="d-flex justify-content-between">
                                                <p id="uploadRate-${fileIndex}">Upload Rate: 0 MB/s</p>
                                                <p id="remainingTime-${fileIndex}">Remaining Time: Calculating...</p>
                                            </div>
                                        `;
                                fileContainer.appendChild(progressBar);
                                progressContainer.appendChild(fileContainer);

                                // Start uploading file in chunks
                                uploadFileInChunks(file, fileIndex);
                            });
                        });
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>