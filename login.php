<?php
    //Check to see if they are already logged in; redirect if so
    if (isset($_SESSION["userObj"]) && isset($_SESSION["UID"]))
        header("Location: dashboard.php");
?>
<!DOCTYPE html>
<HTML lang="en">

<head>
    <title> Login - Queen City's Gambit </title>
    <meta charset="UTF=8">
    <!--==============================Stylesheets===========================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/login.css">
</head>

<body>

    <!-- The navigation bar -->
    <nav> 
        <a href="index.html"><img src="dependencies/miniLogo.png" alt="Mini Logo Home Button" class="miniLogo" /></a>
        <a href="login.html" class="navButton">Login</a>
        <a href="signup.html" class="navButton">Signup</a>
        <a href ="search.html" class="navButton">Search</a>
    </nav>

    <!-- login header image -->
    <div class="mainPageHeader">
        <img src="dependencies/loginHeaderImage.png" class="headerImage" alt="Login to Queen City's Gambit" />
    </div>

    <!-- Login Box -->
    <div class="loginContainer">

        <!-- contains the login image -->
        <div class="loginImage">
            <img src="dependencies/loginFormImage.png" class="loginFormImage">
        </div>

        <!-- contains the login form elements and error spaces -->
        <div class="loginFormContainer">
            <form class="loginForm" method="POST" action="PHP/login.php">
                <table class="loginTable">
                    <tr>
                        <td></td><td><span class="errorMessage" id="invalidMessage">
                            <?php 
                                if ($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["login"] === "FAIL")
                                    echo("Login failed. Please try again!");
                            ?>
                        </span></td>
                    </tr>

                    <!-- Login Email -->
                    <tr>
                        <td><label for="loginEmail">Email: </label></td><td><input type="email" id="loginEmail" class="loginInput"></td>
                    </tr>
                    <tr>
                        <td></td><td><span class="errorMessage" id="invalidLoginEmail"><br></span></td>
                    </tr>

                    <!-- Login Password -->
                    <tr>
                        <td><label for="loginPassword">Password:</label></td><td><input type="password" id="loginPassword" class="loginInput"></td>
                    </tr>
                    <tr>
                        <td></td><td><span class="errorMessage" id="invalidLoginPassword"><br></span></td>
                    </tr>

                    <!-- Login Button -->
                    <tr>
                        <td></td><td><input class="loginButton" type="submit" id="loginButton" value="LOGIN"></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</body>

</HTML>