<?php
	session_start();
    include("database.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Posts PHP Login - Tarik</title>
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
		<h1>Login Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
					<input class="text" type="text" name="username" placeholder="Username" required="">
                    <br><br>
					<input class="text" type="password" name="password" placeholder="Password" required="">
                    <br><br>
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="Login">
				</form>
				<p>Don't have an Account? <a href="register.php"> Register Now!</a></p>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user inputs
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        // Check if inputs are empty
        if (empty($username)) {
            echo "Please enter your username!";
        } elseif (empty($password)) {
            echo "Please enter your password!";
        } else {
            // Prepare and execute the SQL query
            $sql = "SELECT * FROM users WHERE username = ?";
			// Execute the same statement repeatedly with high efficiency and prevent SQL injection.
            $stmt = mysqli_prepare($conn, $sql);
			// Binds variables to the prepared statement as parameters.
            mysqli_stmt_bind_param($stmt, 's', $username);
			// Executes the prepared statement
            mysqli_stmt_execute($stmt);
			// Retrieves the result set from the executed statement.
            $result = mysqli_stmt_get_result($stmt);
			// Fetches a single row from the result set as an associative array.
            $user = mysqli_fetch_assoc($result);

            // Check if the user exists and verify the password
            if ($user && password_verify($password, $user['password'])) {
                // Start session and set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['userId'] = $user['userId'];

                // Redirect to home page
                header("Location: home.php");
                exit();
            } else {
                echo "Invalid username or password!";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close database connection
    mysqli_close($conn);
?>