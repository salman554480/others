<?php 
require_once('admin/parts/db.php');
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$select_setting = "SELECT * FROM setting ";
	$run_setting = mysqli_query($conn,$select_setting);
	$row_setting = mysqli_fetch_array($run_setting);
				
	$setting_id = $row_setting['setting_id'];
	$website_title = $row_setting['website_title'];
	$website_url = $row_setting['website_url'];
	$website_logo = $row_setting['website_logo'];
	$website_favicon = $row_setting['website_favicon'];
	$website_head_code = $row_setting['website_head_code'];
	$ad_code_one = $row_setting['ad_code_one'];
	$ad_code_two = $row_setting['ad_code_two'];
	$ad_code_three = $row_setting['ad_code_three'];
	
	$footer_text = $row_setting['footer_text'];
	$facebook = $row_setting['facebook'];
	$instagram = $row_setting['instagram'];
	$twitter = $row_setting['twitter'];
	$pinterest = $row_setting['pinterest'];
	
$base_url = $website_url;?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $meta_title;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="<?php echo $meta_title;?>">
	<meta name="description" content="<?php echo $meta_description;?>">
	<meta name="keywords" content="<?php echo $meta_keywords;?>">
	<meta name="robots" content="index, follow">
	
	<link rel="canonical" href="<?php echo $actual_link;?>" />
	<link rel="icon" type="image/x-icon" href="<?php echo $base_url;?>/admin/upload/<?php echo $website_favicon;?>">
	
	<!-- Facebook Meta Tags -->
  <meta property="og:url" content="<?php echo $website_url;?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo $meta_title;?>">
  <meta property="og:description" content="<?php echo $meta_description;?>">
  <meta property="og:image" content="<?php echo $base_url;?>/admin/upload/<?php echo $website_logo;?>">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta property="twitter:domain" content="<?php echo $website_url;?>">
  <meta property="twitter:url" content="<?php echo $website_url;?>">
  <meta name="twitter:title" content="<?php echo $meta_title;?>">
  <meta name="twitter:description" content="<?php echo $meta_description;?>">
  <meta name="twitter:image" content="<?php echo $base_url;?>/admin/upload/<?php echo $website_logo;?>">
  
	
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<!--Extra Head Code-->
<?php echo $website_head_code;?>