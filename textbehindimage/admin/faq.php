<?php require_once('parts/top.php'); ?>
</head>

<body class="sb-nav-fixed">

    <?php require_once('parts/navbar.php'); ?>

    <div id="layoutSidenav">

        <?php require_once('parts/sidebar.php'); ?>

        <?php

        // Create operation: Insert new FAQ
        if (isset($_POST['submit'])) {
            $faq_question = $_POST['faq_question'];
            $faq_answer = $_POST['faq_answer'];

            $sql = "INSERT INTO faq (faq_question, faq_answer) VALUES ('$faq_question', '$faq_answer')";
            if ($conn->query($sql) === TRUE) {
                //    echo "New FAQ created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Update operation
        if (isset($_POST['update'])) {
            $faq_id = $_POST['faq_id'];
            $faq_question = $_POST['faq_question'];
            $faq_answer = $_POST['faq_answer'];

            $sql = "UPDATE faq SET faq_question = '$faq_question', faq_answer = '$faq_answer' WHERE faq_id = $faq_id";
            if ($conn->query($sql) === TRUE) {
                echo "FAQ updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Delete operation
        if (isset($_GET['delete'])) {
            $faq_id = $_GET['delete'];

            $sql = "DELETE FROM faq WHERE faq_id = $faq_id";
            if ($conn->query($sql) === TRUE) {
                echo "FAQ deleted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Fetch all FAQ records
        $sql = "SELECT * FROM faq";
        $result = $conn->query($sql);
        ?>

        <div id="layoutSidenav_content" class="">
            <main class="">
                <div class="container-fluid  px-4">

                    <div class="page-header">
                        <div class="col-12 mt-4 mb-4">
                            <h4 class="mb-3">FAQ</h4>

                        </div>
                    </div>
                    <div class="card mb-3 bg-white">

                        <div class="card-body ">


                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="faq_question" class="form-label">FAQ Question</label>
                                    <input type="text" class="form-control" id="faq_question" name="faq_question"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="faq_answer" class="form-label">FAQ Answer</label>
                                    <textarea class="form-control" id="faq_answer" name="faq_answer"
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['faq_id']; ?></td>
                                        <td><?php echo $row['faq_question']; ?></td>
                                        <td><?php echo $row['faq_answer']; ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                onclick="editFAQ(<?php echo $row['faq_id']; ?>, '<?php echo $row['faq_question']; ?>', '<?php echo $row['faq_answer']; ?>')">Edit</button>
                                            <!-- Delete Button -->
                                            <a href="?delete=<?php echo $row['faq_id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this FAQ?')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Edit FAQ Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit FAQ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="">
                                        <input type="hidden" id="edit_faq_id" name="faq_id">
                                        <div class="mb-3">
                                            <label for="edit_faq_question" class="form-label">FAQ Question</label>
                                            <input type="text" class="form-control" id="edit_faq_question"
                                                name="faq_question" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_faq_answer" class="form-label">FAQ Answer</label>
                                            <textarea class="form-control" id="edit_faq_answer" name="faq_answer"
                                                required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="update">Update FAQ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    // Function to fill the modal with current FAQ data
                    function editFAQ(id, question, answer) {
                        document.getElementById('edit_faq_id').value = id;
                        document.getElementById('edit_faq_question').value = question;
                        document.getElementById('edit_faq_answer').value = answer;
                    }
                    </script>

            </main>
            <?php require_once('parts/footer.php'); ?>
        </div>

    </div>
    <!--Footercdn--->
    <?php require_once('parts/footercdn.php'); ?>

</body>

</html>