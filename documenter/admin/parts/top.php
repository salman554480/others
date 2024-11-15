<?php

require_once('db.php');
session_start();

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self');</script>";
} else {
    $admin_email = $_SESSION['admin_email'];

    $select_admin = "SELECT * FROM admin WHERE admin_email='$admin_email'";
    $run_admin = mysqli_query($conn, $select_admin);
    $row_admin = mysqli_fetch_array($run_admin);

    $admin_id = $row_admin['admin_id'];
    $admin_email = $row_admin['admin_email'];
    $admin_name = $row_admin['admin_name'];
    $admin_password = $row_admin['admin_password'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">