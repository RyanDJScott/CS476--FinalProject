<?php
    //Include class definitions for login check
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/display.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();
    
    //If you were sent here by the GET method; grab the userID
    if (isset($_GET["UID"]) && $_GET["UID"] > 0) {
        $userID = $_GET["UID"];

        //Create a display object
        $display = new Display();
    }
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
            //Check if the user is logged in
            if ((isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) && is_object($_SESSION["userObj"])) 
                loggedInNavBar();
             else 
                loggedOutNavBar();   
        ?>
    </nav>

    <!-- Dashboard header image -->
    <div class="dashboardHeader">
        <img src="dependencies/dashboardImage.png" class="dashboardHeaderImage" alt="Welcome to Queen City's Gambit!" />
    </div>
    
    <?php $display->displayViewProfile($userID); ?>    

</body>

</HTML>