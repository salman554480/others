<div class="footer">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="footer_menu">
                    <ul>
                        <?php
                        require_once('admin/parts/db.php');
                        $select_menu_footer = "SELECT * FROM menu WHERE menu_location='footer'";
                        $run_menu_footer = mysqli_query($conn, $select_menu_footer);
                        while ($row_menu_footer = mysqli_fetch_array($run_menu_footer)) {

                            $page_id_footer = $row_menu_footer['page_id'];


                            $select_page = "SELECT * FROM page WHERE page_id='$page_id_footer' ";
                            $run_page = mysqli_query($conn, $select_page);
                            $row_page = mysqli_fetch_array($run_page);
                            $footer_page_title =  $row_page['page_title'];
                            $footer_page_url =  $row_page['page_url'];
                        ?>
                            <li><a href="<?php echo $base_url; ?>/<?php echo $footer_page_url; ?>"><?php echo $footer_page_title; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="footer_copyright">
                    <?php if ($footer_text == "") { ?>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed malesuada faucibus dolor id lacinia.</p>
                    <?php } else { ?>
                        <p><?php echo $footer_text; ?></p>
                    <?php } ?>
                </div>
                <div class="footer_profile">
                    <ul>
                        <li><a href="https://www.facebook.com/<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.twitter.com/<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/<?php echo $pinterest; ?>"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div><!--- END COL -->
        </div><!--- END ROW -->
    </div><!--- END CONTAINER -->
</div>