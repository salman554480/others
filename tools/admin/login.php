<?php session_start(); 
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Calculator</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-image:url('assets/img/calculator.jpg');background-size:cover; background-position:center;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
										
                                            </div>
                                           
                                            <div class="d-flex-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" class="btn btn-danger" name="submit" value="Login">	
                                            </div>
                                        </form>
                                        <?php
						require_once('parts/db.php'); 
					if(isset($_POST['submit'])){
						$email =  $_POST['email'];
						$password =  $_POST['password'];
					
									$select = "SELECT * FROM admin WHERE admin_email='$email'";
						$run =  mysqli_query($conn,$select);
						if(mysqli_num_rows($run) > 0){
						
						$row =  mysqli_fetch_array($run);
						
						
						$user_email =  $row['admin_email'];
						$user_password =  $row['admin_password'];
						
						if($email ==   $user_email && $password ==  $user_password){
							//header('Location:index.php');
							echo "<script>window.open('index.php','_self');</script>";
							$_SESSION['admin_email'] =  $user_email;
						}else{
							echo "Invalid Login";
						}
						
						
						
						}else{
							echo "No Email Found";
						}				
										
										}
				
				
 				?>





                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="https://www.buymeacoffee.com/websterytcR/extras">For More Scripts, Click Here!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
