<?php
session_start(); // Start the session

// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About This Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="about.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <div class="topnav">
        <a href="home.php">Home</a> <!-- Link back to the post listing page -->
        <a href="https://news.google.com" target="_blank">News</a>
        <a href="contact.php">Contact</a>
        <a class="active" href="about.php">About</a>
    </div>
    
    <div class="container mt-5">
        <h1 class="font-weight-bold">About This Page</h1>
        <p>This page is designed to display a list of posts created by different users. Users can interact with the posts based on who created them. Below is a breakdown of the functionality available on this page:</p>

        <h2 style="font-weight: bold;" class="mt-4">Features</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Post Listing:</strong> All posts from different users are displayed in a list. Each post shows the title, content, and the author’s username. The posts are listed in reverse chronological order, with the most recent posts appearing at the top.
            </li>
            <li class="list-group-item">
                <strong>View Other Users' Posts:</strong> You can view posts created by other users by clicking the <i class="fas fa-eye"></i> (View) button next to the post. This will open the post in a detailed view where you can read its full content.
            </li>
            <li class="list-group-item">
                <strong>Edit and Delete Your Own Posts:</strong> If you are the author of a post, you have the option to edit or delete your post. These options appear as <i class="fas fa-pencil-alt"></i> (Edit) and <i class="fas fa-trash-alt"></i> (Delete) buttons. Editing allows you to update the content of the post, while deleting removes it entirely.
            </li>
            <li class="list-group-item">
                <strong>Create a New Post:</strong> You can create a new post by clicking the "New Post" button located at the top of the page. This will take you to a form where you can enter the title and content for your new post.
            </li>
        </ul>

        <h2 style="font-weight: bold;" class="mt-4">Post Visibility and User Interaction</h2>
        <p>
            When you log in, you have full control over your own posts. You can delete or edit any post that you have created. However, for posts created by other users, you only have the option to view the post without making any changes. 
        </p>

        <h2 style="font-weight: bold;" class="mt-4">Security Features</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Authentication:</strong> You need to be logged in to access this page. If you are not logged in, you will be redirected to the login page.
            </li>
            <li class="list-group-item">
                <strong>Data Sanitization:</strong> All user input is sanitized to prevent malicious attacks such as Cross-Site Scripting (XSS). This ensures that all content displayed is safe and secure.
            </li>
        </ul>

        <h2 style="font-weight: bold;" class="mt-4">Database Integration</h2>
        <p>The data for the posts and users is fetched from a MySQL database. The posts are stored in the <code>posts</code> table, and users are stored in the <code>users</code> table. A join operation is performed to fetch posts along with the username of the user who created them. Posts are displayed in reverse chronological order.</p>
    </div>
</body>
</html>
