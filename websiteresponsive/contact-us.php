<?php 
require_once('admin/parts/db.php');  
	$select_page = "SELECT * FROM page WHERE page='contact-us'";
	$run_page = mysqli_query($conn,$select_page);
		$row_page =  mysqli_fetch_array($run_page);
			$page_title =  $row_page['page_title'];	
			$page_content =  $row_page['page_content'];	
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
            <h1><?php echo $page_title?></h1>
				<div class="content-area">	
					<?php echo $page_content; ?>
				</div>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <?php require_once('parts/sidebar.php'); ?>
    </div>
  </div>

<?php require_once('parts/footer.php'); ?>
</body>

</html>