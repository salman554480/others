<?php
require_once('parts/db.php');
session_start();

if (!isset($_SESSION['admin_email'])) {
	echo "<script>window.open('login.php','_self');</script>";
} else {
	$admin_email = $_SESSION['admin_email'];

	$select_admin = "SELECT * FROM admin WHERE admin_email='$admin_email' ";
	$run_admin = mysqli_query($conn, $select_admin);
	$row_admin = mysqli_fetch_array($run_admin);

	$admin_id = $row_admin['admin_id'];
	$admin_email = $row_admin['admin_email'];
	$admin_name = $row_admin['admin_name'];
	$admin_password = $row_admin['admin_password'];
	$admin_image = $row_admin['admin_image'];
	$admin_role = $row_admin['admin_role'];
}



$select_setting = "SELECT * FROM setting ";
$run_setting = mysqli_query($conn, $select_setting);
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
$db_api = $row_setting['api'];

$footer_text = $row_setting['footer_text'];
$facebook = $row_setting['facebook'];
$twitter = $row_setting['twitter'];
$instagram = $row_setting['instagram'];
$pinterest = $row_setting['pinterest'];







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>