<?php
session_start(); // Start the session
include("database.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if userId is set in the session
if (!isset($_SESSION['userId'])) {
    echo "User ID not set in session. Please log in again.";
    exit();
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_SESSION['userId']; // Get userId from the session
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']); // Changed to match the correct column name

    // Insert into the database
    $sql = "INSERT INTO posts (userId, title, content) VALUES ('$userId', '$title', '$content')";

    if (mysqli_query($conn, $sql)) {
        echo "New post created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creation of a Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <div class="topnav">
        <a class="active" href="home.php">Home</a>
        <a href="https://news.google.com" target="_blank">News</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
    </div>

    <div class="container mt-4">
        <div class="d-flex justify-content-start">
            <h1 style="color: #04AA6D; font-weight: bold;">New Post</h1>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-3">
            <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Title of the Post" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" placeholder="Description of the post" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit Post</button>
        </form>
    </div>

    <?php
        // Close the connection
        mysqli_close($conn);
    ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
