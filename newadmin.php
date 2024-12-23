<?php
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($password !== $confirm) {
        echo "<script>
                alert('Passwords do not match!');
                document.location.href = 'register.php';
              </script>";
        exit;
    }

    // Endpoint API Flask
    $url = "http://localhost:5000/api/register";

    // Data untuk dikirim ke API
    $data = [
        'username' => $username,
        'password' => $password
    ];

    // cURL untuk mengirimkan POST ke Flask
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode === 201) {
        echo "<script>
                alert('New Admin has been created!');
                document.location.href = 'login.php';
              </script>";
    } else {
        $response_data = json_decode($response, true);
        $message = $response_data['message'] ?? 'Registration failed!';
        echo "<script>
                alert('$message');
              </script>";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Create Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="loginpack/css/style.css">

	</head>
	<body>
		
			
	<section class="ftco-section">
		<div class="container">
			<!-- <div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Create Admin</h2>
				</div>
			</div> -->
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(loginpack/images/gemoy.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Create bre...</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="" class="signin-form" method="post">
			      		<div class="form-group mb-3">
			      			<label class="label" for="username">Username</label>
			      			<input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
		            </div>
                    <div class="form-group mb-3">
		            	<label class="label" for="confirm">Confirm Password</label>
		              <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="register" class="form-control btn btn-primary rounded submit px-3">Create Account</button>
		            </div>
		            <!-- <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label for="remember" class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" name="remember" id="remember">
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div> -->
		          </form>
		          <!-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="loginpack/js/jquery.min.js"></script>
  <script src="loginpack/js/popper.js"></script>
  <script src="loginpack/js/bootstrap.min.js"></script>
  <script src="loginpack/js/main.js"></script>

	</body>
</html>

