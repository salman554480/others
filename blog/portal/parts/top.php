<?php session_start();
require_once('../parts/db.php');

if (!isset($_SESSION['user_email'])) {
    // echo "no session";
    echo "<script>window.open('login.php','_self');</script>";
} else {
    $user_email = $_SESSION['user_email'];

    $select_user = "SELECT * FROM user WHERE user_email='$user_email' ";
    $run_user = mysqli_query($conn, $select_user);
    $row_user = mysqli_fetch_array($run_user);

    $user_id = $row_user['user_id'];
    $user_email = $row_user['user_email'];
    $user_name = $row_user['user_name'];
    $user_image = $row_user['user_image'];
    $user_password = $row_user['user_password'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description"
        content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 5 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
        content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <title>Vali Admin - Free Bootstrap 5 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">