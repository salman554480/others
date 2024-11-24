<?php require_once('parts/top.php'); ?>
</head>

<body>

    <?php require_once('parts/navbar.php'); ?>
    <?php
    require_once('admin/parts/db.php');
    $select_file = "SELECT * FROM file ORDER by file_id DESC LIMIT 1";
    $run_select_file = mysqli_query($conn, $select_file);
    $row_select_file =  mysqli_fetch_array($run_select_file);
    $file_id =  $row_select_file['file_id'];
    $file_name =  $row_select_file['file_name'];

    $path = $base_url . "/Uploads/" . $file_name;

    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-center">Your Uploaded Files</h3>
                <div class="input-group">
                    <input type="text" class="form-control" value="<?php echo $path; ?>" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-success" type="button">COPY URL</button>
                    </div>
                </div>

                <div class="mt-4">
                    <div id="qr-code"></div>
                </div>
                <form id="qr-form">
                    <button type="button" class="btn btn-success my-4" id="download">Download QR Code</button>
                </form>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

            <script>
                $(document).ready(function() {
                    const qrCodeDiv = document.getElementById("qr-code");
                    const qrCode = new QRCode(qrCodeDiv, {
                        width: 128,
                        height: 128
                    });

                    const text = "<?php echo $path; ?>";
                    qrCode.clear();
                    qrCode.makeCode(text);

                    $("#download").click(function() {
                        const qrCodeDataUrl = qrCodeDiv.querySelector("img").src;
                        const link = document.createElement("a");
                        link.href = qrCodeDataUrl;
                        link.download = "qrcode.png";
                        link.click();
                    });
                });
            </script>


        </div>
        <div class="col-md-3"></div>
    </div>
    </div>


    <script>
        const uploadForm = document.getElementById("uploadForm");
        const fileInput = document.getElementById("fileToUpload");
        const uploadProgress = document.getElementById("uploadProgress");
        const uploadMessage = document.getElementById("uploadMessage");
        const uploadStatus = document.getElementById("uploadStatus");

        uploadForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append("fileToUpload", fileInput.files[0]);

            const xhr = new XMLHttpRequest();

            let startTime = Date.now();

            xhr.upload.addEventListener("progress", (e) => {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    uploadProgress.value = percentComplete;

                    const elapsedTime = (Date.now() - startTime) / 1000; // in seconds
                    const bytesUploaded = e.loaded;
                    const totalBytes = e.total;
                    const megabytesUploaded = bytesUploaded / (1024 * 1024); // Convert to MB

                    const bytesPerSecond = bytesUploaded / elapsedTime;
                    const bytesRemaining = totalBytes - bytesUploaded;
                    const secondsRemaining = bytesRemaining / bytesPerSecond;

                    uploadStatus.innerHTML = `Uploaded: ${megabytesUploaded.toFixed(2)} MB (${percentComplete.toFixed(2)}%)<br>
                        Elapsed Time: ${elapsedTime.toFixed(2)} seconds<br>
                        Remaining Time: ${secondsRemaining.toFixed(2)} seconds`;
                }
            });

            xhr.addEventListener("load", () => {
                if (xhr.status === 200) {
                    uploadMessage.innerHTML = "File uploaded successfully!";
                    window.open('index.php', '_self');
                } else {
                    uploadMessage.innerHTML = "File upload failed.";
                }
            });

            xhr.open("POST", "upload.php", true);
            xhr.send(formData);
        });
    </script>

    <div class="footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="footer_menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Works</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer_copyright">
                        <p>© 2021 Sai. All Rights Reserved.</p>
                    </div>
                    <div class="footer_profile">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </div>



</body>

</html>