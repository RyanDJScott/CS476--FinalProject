<?php

function loggedInNavBar () {
    echo '
    <a href="./PHP/logoutScript.php" class="navButton">Logout</a>
    <a href="dashboard.php" class="navButton">Dashboard</a>
    <a href ="search.php" class="navButton">Search</a>';
}

function loggedOutNavBar () {
    echo '<a href="login.php" class="navButton">Login</a>
    <a href="signup.php" class="navButton">Signup</a>
    <a href ="search.php" class="navButton">Search</a>';
}

?>