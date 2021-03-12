<?php
    //Include dependencies
    include_once(__DIR__ . '/PHP/userFactory.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/display.php');
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Check to see if they are logged in; redirect if not
    if (!isset($_SESSION["UID"]) && !is_object($_SESSION["userObj"]))
        header("Location: login.php");

    //Create a display object
    $display = new Display();
?>
<!DOCTYPE html>
<HTML lang="en">

<head>
    <title>Dashboard - Queen City's Gambit</title>
    <meta charset="UTF=8">
    <!--==========================Stylsheets=================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/dashboard.css">
</head>

<body>
    <!-- The navigation bar -->
    <nav> 
        <a href="index.php"><img src="dependencies/miniLogo.png" alt="Mini Logo Home Button" class="miniLogo" /></a>
        <?php
            //This page can only be accessed by logged in
            loggedInNavBar();   
        ?>
    </nav>

    <?php $display->displayDashboard($_SESSION["userObj"]); ?>
</body>

</html>