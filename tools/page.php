<?php 
require_once('admin/parts/db.php');  
if(isset($_GET['page_url'])){
	$page_url = $_GET['page_url'];
	$select_page = "SELECT * FROM page WHERE page_url='$page_url'";
	$run_page = mysqli_query($conn,$select_page);
		$row_page =  mysqli_fetch_array($run_page);
			$get_page_title =  $row_page['page_title'];	
			$get_page_content =  $row_page['page_content'];	
			$page_title = $row_page['page_title'];
			$page_url = $row_page['page_url'];
			$page_content = $row_page['page_content'];
			$meta_title = $row_page['meta_title'];
			$meta_description = $row_page['meta_description'];
			$meta_keywords = $row_page['meta_keywords'];
}
 ?>
<?php require_once('parts/top.php'); ?>
</head>

<body>

  <?php require_once('parts/navbar.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <img class="w-100 mb-3" src="https://dummyimage.com/1000x40/caccd1/ffffff&text=Ads+Place+1" alt="">
        <div class="row bg-white p-3 custom-shadow">
          <div class="col-md-12">
            <h1><?php echo $get_page_title?></h1>
				<div class="content-area">	
					<?php echo $get_page_content; ?>
				</div>
          </div>
        </div>
      </div>
      <?php require_once('parts/sidebar.php'); ?>
    </div>
  </div>

<?php require_once('parts/footer.php'); ?>
</body>

</html>