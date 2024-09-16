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

    // Prepare and execute the SQL delete statement
    $sql = "DELETE FROM posts WHERE postId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $postId);
        mysqli_stmt_execute($stmt);
        
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Redirect to the home page with a success message
            header("Location: home.php?message=Post+deleted+successfully");
            exit();
        } else {
            echo "Error: Could not delete the post. It might not exist or you might not have permissions.";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the SQL statement: " . mysqli_error($conn);
    }
} else {
    echo "No post ID provided for deletion.";
}

// Close the database connection
mysqli_close($conn);
?>
