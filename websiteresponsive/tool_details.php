<?php
require_once('admin/parts/db.php');
if (isset($_GET['tool_url'])) {
	$tool_url = $_GET['tool_url'];


	$select_tool = "SELECT * FROM tool WHERE tool_url='$tool_url'";
	$run_tool = mysqli_query($conn, $select_tool);
	$row_tool = mysqli_fetch_array($run_tool);

	$tool_id = $row_tool['tool_id'];
	$tool_name = $row_tool['tool_name'];
	$tool_url = $row_tool['tool_url'];
	$tool_html = $row_tool['tool_html'];
	$tool_css = $row_tool['tool_css'];
	$tool_js = $row_tool['tool_js'];
	$tool_php = $row_tool['tool_php'];
	$tool_content = $row_tool['tool_content'];
	$meta_title = $row_tool['tool_meta_title'];
	$meta_description = $row_tool['tool_meta_description'];
	$meta_keywords = $row_tool['tool_meta_keywords'];
	$tool_status = $row_tool['tool_status'];
	$tool_views = $row_tool['tool_views'];

	$updated_views =  $tool_views + 1;
	$update_views = "UPDATE tool SET tool_views='$updated_views' WHERE tool_id='$tool_id'";
	$run_update_views =  mysqli_query($conn, $update_views);
}
?>
<?php require_once('parts/top.php'); ?>
<?php echo $tool_css; ?>
</head>

<body>

    <?php require_once('parts/navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo $ad_code_one; ?>
                <div class="row bg-white p-5 custom-shadow">
                    <div class="col-md-12">
                        <h1><?php echo $tool_name; ?></h1>
                        <div id="tool-area" class="mt-4">
                            <?php echo $tool_html; ?>
                        </div>
                        <?php echo $tool_js; ?>

                    </div>
                </div>

                <div class="row bg-white p-3 custom-shadow mt-5">
                    <div class="col-md-12 ">
                        <?php echo $tool_content; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>