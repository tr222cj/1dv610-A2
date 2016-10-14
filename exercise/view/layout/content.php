<?php if (\core\Session::isUserLoggedIn()) {
    echo '<h2>Logged in</h2>';
} else {
    if (\core\Session::getAction() === "register") {
        echo '<a href="/">Back to login</a>';
    } else {
        echo '<a href="/?register">Register a new user</a>';
    }
    echo '<h2>Not logged in</h2>';
}
