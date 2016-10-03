<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Example</title>
</head>
<body>
<h1>Assignment 2</h1>
<?php if (\core\Session::get("isUserLoggedIn")) {
    echo '<h2>Logged in</h2>';
} else {
    if (\core\Session::get('action') === "register") {
        echo '<a href="?">Back to login</a>';
    } else {
        echo '<a href="?register">Register a new user</a>';
    }
    echo '<h2>Not logged in</h2>';
} ?>

<div class="container">
    <?php require_once($view); ?>

    <?php require_once('DateTimeView.php'); ?>
</div>
</body>
</html>