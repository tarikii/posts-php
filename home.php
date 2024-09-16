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

// Fetch all posts from the database with the users
$sql = "SELECT posts.postId, posts.title, posts.content, posts.created_at, users.username 
        FROM posts 
        JOIN users ON posts.userId = users.userId 
        ORDER BY posts.created_at DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error fetching posts: " . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page Posts</title>
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

    <div class="newpost-button d-flex justify-content-end">
        <a href="formPost.php" class="btn btn-primary m-4">New Post</a>
    </div>

    <br>

    <div class="posts-container">
        <?php
        // Check if there are any posts and display them
        if (mysqli_num_rows($result) > 0) {
            // Loop through and display each post
            while ($row = mysqli_fetch_assoc($result)) {
                $date = new DateTime($row['created_at']);
                // Format the date
                $formattedDate = $date->format('M jS \o\f Y, \a\t H:i:s'); // "Sept 10th of 2024, at 14:57:54"

                echo '<div class="post d-flex justify-content-between align-items-start">';
                echo '<div class="post-content">';
                echo '<h2 class="font-weight-bold">' . nl2br(htmlspecialchars(stripslashes($row['title']))) . ' - By ' . htmlspecialchars(stripslashes($row['username'])) . '</h2>';
                echo '<p>' . nl2br(htmlspecialchars(stripslashes($row['content']))) . '</p>';
                echo '<small style="font-size: 19px; font-weight: bold;">Posted on: ' . htmlspecialchars($formattedDate) . '</small>';
                echo '</div>';
                // Icon buttons
                echo '<div class="btn-group ml-3">';
                
                // Check if the post is by another user
                if ($row['username'] !== $_SESSION['username']) {
                    // Only show the eye icon
                    echo '<a href="seePost.php?id=' . urlencode($row['postId']) . '" class="btn btn-primary" title="View"><i class="fas fa-eye"></i></a>';
                } else {
                    // Show all icons (edit and delete)
                    echo '<a href="seePost.php?id=' . urlencode($row['postId']) . '" class="btn btn-primary" title="View"><i class="fas fa-eye"></i></a>';
                    echo '<a href="editPost.php?id=' . urlencode($row['postId']) . '" class="btn btn-success" title="Edit"><i class="fas fa-pencil-alt"></i></a>';                    
                    echo '<a href="deletePost.php?id=' . urlencode($row['postId']) . '" class="btn btn-danger" title="Delete" onclick="return confirm(\'Are you sure you want to delete this post?\');"><i class="fas fa-trash-alt"></i></a>';
                }

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No posts available.</p>';
        }
        
        // Free result set and close the connection
        mysqli_free_result($result);
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
