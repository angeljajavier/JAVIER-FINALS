<?php 
        require('function.php');
        session_start();
        $con = openConnection();
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/login.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(img/bg.jpg);">
        <?php 
                if (isset($_POST['loginbtn'])) {
                    $password = $_POST['password'];
                    $email = $_POST['email'];
            
                    $email = stripcslashes($email);
                    $password= stripslashes($password);
            
                    $email = mysqli_real_escape_string($con, $email);
                    $password = mysqli_real_escape_string($con, $password);
            
                    $password = md5($password);
            
                    $strSql = "SELECT * FROM tbl_user
                            WHERE username ='$email'
                            AND password = '$password'
                            ";
            
                    if ($rsLogin = mysqli_query($con, $strSql)) {
                        if (mysqli_num_rows($rsLogin)>0) {
                            echo 'Welcome to the system';
                            foreach ($rsLogin as $key => $value) {
                                header('location: dashboard.php');
                            }
                        }else
                            echo '<div class="alert alert-danger text-center" role="alert">
                                    Invalid Account/Password
                                </div>';
                    }
                    else
                        echo "could not execute your request";
                }
        ?>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Admin Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Welcome Admin</h3>
		      	<form method="post" class="signin-form">
		      		<div class="form-group">
		      			<input name="email" type="text" class="form-control" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="loginbtn" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Go back? &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="login.php" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Go Back</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

