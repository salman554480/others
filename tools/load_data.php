<div class="row">
    <?php
    require_once('admin/parts/db.php');

    if (isset($_POST['limit']) && isset($_POST['offset'])) {
        $limit = $_POST['limit'];
        $offset = $_POST['offset'];

        $sql = "SELECT * FROM tool LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tool_name =  $row['tool_name'];
                $category_id =  $row['category_id'];
                $tool_url =  $row['tool_url'];
                $tool_views =  $row['tool_views'];
    ?>
                <div class="col-lg-6 col-md-6 col-12 mt-4 pt-2">
                    <div class="card border-0 bg-light rounded shadow">
                        <div class="card-body p-4">
                            <h5><?php echo $tool_name; ?></h5>
                            <div class="mt-3">
                                <span class="text-muted d-block"><i class="fa fa-server" aria-hidden="true"></i> Views: <?php echo $tool_views; ?></span>
                            </div>

                            <div class="mt-3">
                                <a href="tool_details.php?tool_url=<?php echo $tool_url;  ?>" class="btn btn-primary btn-sm">Try This</a>
                            </div>
                        </div>
                    </div>
                </div>

    <?php
            }
        }
    }
    ?>
</div>