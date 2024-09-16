<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection
include("database.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the post ID is provided
if (isset($_GET['id'])) {
    $postId = intval($_GET['id']); // Sanitize the input

    // Fetch the post details from the database
    $sql = "SELECT posts.title, posts.content, posts.created_at, users.username 
            FROM posts 
            JOIN users ON posts.userId = users.userId 
            WHERE posts.postId = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $postId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Format the date
            $date = new DateTime($row['created_at']);
            $formattedDate = $date->format('M jS \o\f Y, \a\t H:i:s'); // "Sept 10th of 2024, at 14:57:54"
        } else {
            echo "Post not found or you do not have permission to view this post.";
            exit();
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "No post ID provided for viewing.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Post</title>
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
    
    <br>
    <div style="margin-bottom: 60px; background: #b6dacc; border: 1px solid #67c53b; border-radius: 5px;" class="container mt-5">
        <h1 style="margin-top: 20px; font-weight: bold;"><?php echo htmlspecialchars($row['title']); ?></h1>
        <p class="text-muted">By <?php echo htmlspecialchars($row['username']); ?> on <?php echo htmlspecialchars($formattedDate); ?></p>
        <hr>
        <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
        <a style="margin-bottom: 20px;" href="home.php" class="btn btn-primary mt-4">Back to Home</a>
    </div>
</body>
</html>
