<?php

// Function Name: loggedInNavBar
// Purpose: To display the nav bar for a user who is logged in
// Parameters: none
// Returns: N/A
// Side Effects:
//   <1> Displays the logout button in the nav bar
//   <2> Displays the dashboard navigation button in the nav bar
//   <3> Displays the search navigation button in the nav bar
function loggedInNavBar () {
    echo '
    <a href="./PHP/logoutScript.php" class="navButton">Logout</a>
    <a href="dashboard.php" class="navButton">Dashboard</a>
    <a href="search.php" class="navButton">Search</a>';
}

// Function Name: loggedOutNavBar
// Purpose: To display the nav bar for a user who is NOT logged in
// Parameters: none
// Returns: N/A
// Side Effects:
//   <1> Displays the login button in the nav bar
//   <2> Displays the signup navigation button in the nav bar
//   <3> Displays the search navigation button in the nav bar
function loggedOutNavBar () {
    echo '<a href="login.php" class="navButton">Login</a>
    <a href="signup.php" class="navButton">Signup</a>
    <a href ="search.php" class="navButton">Search</a>';
}

?>