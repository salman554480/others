<?php require_once('parts/top.php'); ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                <h1><i class="bi bi-speedometer"></i> Blank Page</h1>
                <p>Start a beautiful journey here</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input class="form-control" type="text" placeholder="Enter full name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">URL</label>
                                        <input class="form-control" type="email" placeholder="URL" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea id="hidden-textarea" name="editor-content"
                                            style="display:none;"></textarea>

                                        <!-- Quill Editor Container -->
                                        <div id="editor-container">
                                            <!-- The Quill editor will be rendered here -->
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <input class="form-control" type="email" placeholder="Enter email address">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox">I accept the terms and
                                                conditions
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Access Key</label>
                                        <input class="form-control" type="text" placeholder="Enter full name">
                                        <small>Upload Video <a target="_blank"
                                                href="https://scripts.vaultifier.space/transfer/">Here</a> to get
                                            <b>Access Key</b>
                                        </small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-control">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                        </form>
                        <!-- Include Quill's JavaScript -->
                        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

                        <script>
                        // Initialize Quill editor on the container
                        var quill = new Quill('#editor-container', {
                            theme: 'snow', // Theme: snow is the default
                            modules: {
                                toolbar: [
                                    [{
                                        'header': '1'
                                    }, {
                                        'header': '2'
                                    }, {
                                        'font': []
                                    }],
                                    [{
                                        'list': 'ordered'
                                    }, {
                                        'list': 'bullet'
                                    }],
                                    ['bold', 'italic', 'underline'],
                                    [{
                                        'align': []
                                    }],
                                    ['link', 'image'],
                                    ['blockquote', 'code-block']
                                ]
                            }
                        });

                        // Sync Quill content with the hidden textarea
                        quill.on('text-change', function(delta, oldDelta, source) {
                            // Update the hidden textarea with the content of the Quill editor
                            document.getElementById('hidden-textarea').value = quill.root.innerHTML;
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once('parts/footer.php'); ?>