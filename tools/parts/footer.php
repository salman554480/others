 <footer class="mt-5">
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                   
					
					
					<?php 
								 require_once('admin/parts/db.php'); 
								  $select_menu_footer = "SELECT * FROM menu WHERE menu_location='footer'";
								  $run_menu_footer = mysqli_query($conn,$select_menu_footer);
								  while( $row_menu_footer = mysqli_fetch_array($run_menu_footer)){
								 
								 $page_id_footer = $row_menu_footer['page_id'];
								 
								 
								 $select_page = "SELECT * FROM page WHERE page_id='$page_id_footer' ";
								 $run_page = mysqli_query($conn,$select_page);
								 $row_page = mysqli_fetch_array($run_page);
								 $footer_page_title =  $row_page['page_title'];
								 $footer_page_url =  $row_page['page_url'];
								 ?>
					
					<a href="<?php echo $base_url;?>/page.php?page_url=<?php echo $footer_page_url; ?>" class="text-white mr-3"><?php echo $footer_page_title;?></a>
								  <?php } ?>
                </div>
                <div class="footer-icons">
                    <a href="https://www.facebook.com/<?php echo $facebook;?>"><i class="fa fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com/<?php echo $twitter;?>"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com/<?php echo $instagram;?>"><i class="fa fa-instagram"></i></a>
                    <a href="https://www.pinterest.com/<?php echo $pinterest;?>"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
			<p class="text-center"><?php echo $footer_text;?></p>
        </div>
    </footer>
