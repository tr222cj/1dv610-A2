<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Example</title>
</head>
<body>
<h1>Assignment 2</h1>
<h2><?php echo (Session::get("isUserLoggedIn")) ? 'Logged in' : 'Not logged in'; ?></h2>

<div class="container">
    <?php require_once($view); ?>

    <?php require_once('DateTimeView.php'); ?>
</div>
</body>
</html>