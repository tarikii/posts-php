<?php
session_start(); // Start the session
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database
include("database.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get postId from the URL
$postId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$postId) {
    echo "Invalid post ID.";
    exit();
}

// Fetch the post details from the database
$sql = "SELECT postId, title, content FROM posts WHERE postId = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $postId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "Post not found.";
    exit();
}

// Fetch the post data
$post = mysqli_fetch_assoc($result);

// Check if the form is submitted to update the post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newTitle = $_POST['title'];  // No need to escape here, we will use prepared statements
    $newContent = $_POST['content'];

    // Update the post in the database
    $updateSql = "UPDATE posts SET title = ?, content = ? WHERE postId = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "ssi", $newTitle, $newContent, $postId);

    if (mysqli_stmt_execute($updateStmt)) {
        // Redirect back to the home page after successful update
        header("Location: home.php");
        exit();
    } else {
        echo "Error updating post: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="container mt-5">
        <h1>Edit Post</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title'], ENT_QUOTES); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($post['content'], ENT_NOQUOTES); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="home.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
