<?php
session_start();
$error = false;
    function checkToken($token) {
        $url = "http://localhost:5000/protected"; // Endpoint Flask untuk verifikasi token
    
        // Buat cURL request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token, // Kirim token di header
            'Content-Type: application/json'
        ]);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        return $httpcode === 200; // Token valid jika status code 200
    }
    
    $token = $_SESSION['token'] ?? null;
    
    if (checkToken($token) == 200) {
        header("Location: admin.php"); 
        exit;
	}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Endpoint API Flask
    $url = "http://localhost:5000/api/login";

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

    if ($httpcode === 200) {
        $response_data = json_decode($response, true);
        $_SESSION['token'] = $response_data['token']; // Simpan token di sesi
        $_SESSION['username'] = $username;

        if (isset($_POST['remember'])) {
            setcookie('token', $response_data['token'], time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
        }

		print_r($_SESSION['token']);
		

        header("Location: admin.php");
        exit;
    } else {
        $error = true;
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="loginpack/css/style.css">

	</head>
	<body>
		<?php if($error) {
			echo 	"<script>
						alert('Incorrect username or password!')
					</script>";
			
		}
			
		?>
			
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<!-- <div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div> -->
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(loginpack/images/ex.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
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
		            <div class="form-group">
		            	<button type="submit" name="login" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label for="remember" class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" name="remember" id="remember">
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div>
		          </form>
		          <p class="text-center">Not a member? <a  href="newadmin.php">Sign Up</a></p>
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

