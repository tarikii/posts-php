<?php
    include("database.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Posts PHP Registration - Tarik</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="auth.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Register Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
					<input class="text" type="text" name="username" placeholder="Username" required="">
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<input class="text w3lpass" type="password" name="confirm-password" placeholder="Confirm Password" required="">
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="Register">
				</form>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 Colorlib Signup Form. All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
		$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
		$confirmPassword = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);

		if(empty($username)){
			echo "Please enter a username!";
		}
		else if(empty($password)){
			echo "Please enter a password!";
		}
		else if($password != $confirmPassword){
			echo "Passwords do not match!";
		}
		else {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$hash')";
			mysqli_query($conn, $sql);
		}
	}
    mysqli_close($conn);
?>