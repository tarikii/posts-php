# Posts PHP Project - Tarik

Welcome to the Posts PHP Project! This project is a simple forum-like web application where users can create, view, edit, and delete posts. It’s built using PHP, MySQL for the database, and styled with Bootstrap for a clean and modern user interface.

## Key Features

1. **User Authentication:**  

    - Users can register an account and log in to access the platform.
    - Sessions are used to keep users logged in and restrict certain actions (like creating or editing posts) to logged-in users only.  

2. **Posts Management:**  

    - Users can create new posts with a title and content.
    - Posts are displayed in reverse chronological order, with the latest posts appearing first.
    - Each post shows the author's username, the date it was posted, and gives options to view, edit, or delete posts.  

3. **Role-Based Actions:**  

    - Logged-in users can edit or delete only the posts they created.
    - Users can view posts created by others but cannot edit or delete them.  

4. **Responsive Design:**
    - The app is styled with Bootstrap, making it responsive and mobile-friendly.
    - The design includes navigation links, buttons for creating new posts, and a simple layout for displaying posts.  

## How to Use

### Home Page
- When you visit the home page, you will see a list of all the posts. Each post is displayed with the following details:  

    - Title of the post.
    - Username of the author.
    - Date the post was created.
    - Buttons:
        - A View button to see the full content of the post.
        - If you're the author of the post, you'll also see:
            - An Edit button to modify the post.
            - A Delete button to remove the post.  

## Create a New Post

- To create a new post, click the New Post button, which redirects you to a form where you can input the post title and content.

## Edit Post

- If you want to edit a post you created, click the Edit button on the post. You’ll be taken to a form pre-filled with the current title and content, which you can modify and save.

## Delete Post

- If you want to delete one of your posts, click the Delete button. You’ll be asked to confirm the deletion before the post is removed from the database.

## Contact and About

- There are also navigation links to a Contact and About page where users can learn more about the project or get in touch.

## Tech Stack

- Frontend: HTML, CSS, Bootstrap
- Backend: PHP
- Database: MySQL
- Session Management: PHP sessions to handle user authentication and permissions.

## Project Structure

- **home.php:** Displays all posts and allows navigation between pages.
- **register.php / login.php:** Handles user registration and login.
- **formPost.php:** Form for creating new posts.
- **editPost.php:** Page for editing an existing post.
- **deletePost.php:** Handles deletion of posts.
- **seePost.php:** Displays the full content of a single post.
- **contact.php / about.php:** Static pages with more information.