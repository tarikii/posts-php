<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - Tarik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Custom Theme files -->
    <link href="auth.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- //web font -->
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
    <!-- main -->
    <div class="main-w3layouts wrapper">
        <h1>Contact Us</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <input class="text email" type="email" name="email" placeholder="Email" required="">
                    <textarea style="
                        font-size: 0.9em;
                        color: #fff;
                        font-weight: 100;
                        width: 94.5%;
                        display: block;
                        border: none;
                        padding: 0.8em;
                        border: solid 1px rgba(255, 255, 255, 0.37);
                        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, #fff 4%);
                        background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, #fff 4%);
                        background-position: -800px 0;
                        background-size: 100%;
                        background-repeat: no-repeat;
                        font-family: 'Roboto', sans-serif;
                        resize: none;
                        height: 150px;
                    " name="message" placeholder="Your message" rows="5" required=""></textarea>
                    <div class="wthree-text">
                        <label class="anim">
                            <input type="checkbox" class="checkbox" required="">
                            <span>I Agree To The Terms & Conditions</span>
                        </label>
                        <div class="clear"> </div>
                    </div>
                    <input type="submit" value="Send Message">
                </form>
            </div>
        </div>
        <!-- copyright -->
        <div class="colorlibcopy-agile">
            <p>© 2023 Contact Form. All rights reserved | Design by Tarik</p>
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
