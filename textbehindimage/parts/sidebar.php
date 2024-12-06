<div class="col-md-3">
    <?php echo $ad_code_one; ?>
    <div class="bg-white p-3 custom-shadow">
        <?php
		require_once('admin/parts/db.php');
		$select_sidebar_category = "SELECT * FROM category ";
		$run_sidebar_category = mysqli_query($conn, $select_sidebar_category);
		while ($row_sidebar_category = mysqli_fetch_array($run_sidebar_category)) {

			$sidebar_category_id = $row_sidebar_category['category_id'];
			$sidebar_category_name = $row_sidebar_category['category_name'];
			$sidebar_category_url = $row_sidebar_category['category_url'];
		?>
        <h5>Popular <?php echo $sidebar_category_name; ?>s</h5>

        <div class="list-group sidebar-list  mb-5">
            <?php

				require_once('admin/parts/db.php');
				$select = "SELECT * FROM tool WHERE category_id='$sidebar_category_id' ORDER BY tool_views DESC LIMIT 5";
				$run = mysqli_query($conn, $select);
				while ($row = mysqli_fetch_array($run)) {

					$tool_id = $row['tool_id'];
					$tool_name = $row['tool_name'];
					$tool_url = $row['tool_url'];

				?>
            <a href="tool_details.php?tool_url=<?php echo $tool_url; ?>"
                class="list-group-item list-group-item-action"><?php echo $tool_name; ?></a>
            <?php } ?>
        </div>
        <?php } ?>

    </div>
</div>