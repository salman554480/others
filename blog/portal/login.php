<?php session_start();
require_once('../parts/db.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login </title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Admin</h1>
        </div>
        <div class="login-box">
            <?php if (isset($_GET['reset'])) {
        echo "<div class='p-2 bg-success text-light'>Your Updated Password sent to your Email Address</div>";
      } ?>
            <form class="login-form" action="" method="post">
                <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN IN</h3>
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input class="form-control" name="form_email" type="email" placeholder="name@example.com" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">PASSWORD</label>
                    <input class="form-control" name="form_password" type="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <div class="utility">
                        <p class="semibold-text mb-2"><a href="recovery_email.php" data-toggle="flip">Forgot Password
                                ?</a></p>
                        <p class="semibold-text mb-2"><a href="register.php">Create Account</a></p>
                    </div>
                </div>
                <div class="mb-3 btn-container d-grid">
                    <button name="login-btn" type="submit" class="btn btn-primary btn-block"><i
                            class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN
                        IN</button>
                </div>
            </form>
            <form class="forget-form" action="" method="post">
                <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Forgot Password ?</h3>
                <div class="mb-3">
                    <label class="form-label">EMAIL</label>
                    <input class="form-control" name="form_email" type="text" placeholder="Email" required>
                </div>
                <div class="mb-3 btn-container d-grid">
                    <button name="submit" class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>SEND
                        EMAIL</button>
                </div>
                <div class="mb-3 mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="bi bi-chevron-left me-1"></i>
                            Back to Login</a></p>
                </div>
            </form>

            <?php

      if (isset($_POST['login-btn'])) {

        $form_email = $_POST['form_email'];
        $form_password = $_POST['form_password'];

        $select = "SELECT * FROM user WHERE user_email='$form_email'";
        $run = mysqli_query($conn, $select);
        if (mysqli_num_rows($run) > 0) {
          $row_user = mysqli_fetch_array($run);
          $user_email = $row_user['user_email'];
          $user_password = $row_user['user_password'];

          if ($form_email == $user_email && $form_password == $user_password) {
            $_SESSION['user_email'] = $user_email;
            echo "<script>window.open('index.php','_self');</script>";
          } else {
            echo "<div class='p-2 bg-danger text-light'>Invalid Credentials</div>";
          }
        } else {
          echo "<div class='p-2 bg-danger text-light'>No Email Found</div>";
        }
      }
      ?>




            <?php

      if (isset($_POST['submit'])) {

        $form_email = $_POST['form_email'];

        $check_user = "SELECT * FROM user WHERE user_email='$form_email'";
        $run_check_user = mysqli_query($conn, $check_user);
        if (mysqli_num_rows($run_check_user) > 0) {
          $row_check_user = mysqli_fetch_array($run_check_user);
          $user_email = $row_check_user['user_email'];

          $length = 8;

          // Define characters to use in the password
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';

          // Initialize the password variable
          $updated_password = '';

          // Loop to generate the password
          for ($i = 0; $i < $length; $i++) {
            // Randomly pick a character from the $characters string
            $updated_password .= $characters[rand(0, strlen($characters) - 1)];
          }

          $update_user_password = "UPDATE user SET user_password='$updated_password' where user_email='$user_email'";
          $run_update_user_password = mysqli_query($conn, $update_user_password);


          $to = $user_email;
          $subject = "Password Changed";
          $txt = "Your Updated password as follows:\n\n";
          $txt = "Password: $updated_password\n";
          $headers = "From: support@foldious.com	";
          mail($to, $subject, $txt, $headers);

          echo "<script>window.open('login.php?reset=1','_self');</script>";
        } else {
          echo "<div class='alert alert-danger my-2'>Email not Found</div>";
        }
      }
      ?>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
    </script>
</body>

</html>