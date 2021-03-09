<?php
    //Include class definitions for login check
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/display.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Create a display object for the page
    $display = new Display();

    //Fetch game title from the GET method
    if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0)
        $gameTitle = $_GET["gameTitle"];
?>
<!DOCTYPE html>
<HTML lang="en">
<head>
    <title> View Tabletop Game - Queen City's Gambit </title>
    <meta charset="UTF=8">
    <!--=============================Stylesheets=======================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/viewTg.css">
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

    <!-- Main header image -->
    <div class="mainPageHeader">
        <img src="dependencies/boardGameHeaderImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!"/>
    </div> 

    <!-- Container for page elements -->
    <div class="overallContainer">
        <?php $display->displayTGE($gameTitle); ?>
        <!-- Container for each review... multiples will be added -->
        <div class="elementContainer">
            
            <!-- 
                left side for rating information
            -->
            <div class="innerContainer">
                <div class="name">Rating 0/10</div>
                Submitted By: Screenname<br>
                Recommended? Yes<br>
                Number of Players: ____<br>
                Age of Players: ____<br>
                Time for one Round: ____<br>
                Percieved Difficulty: easy<br>
                Number of Times Played: ____<br>
            </div> 

            <!--
                right side for review itself and flag button
            -->
            <div class="innerContainer">
                <p><br>
                    This is a review for a game and this is where the reviews
                    will go. This is a review for a game and this is where the reviews
                    will go. This is a review for a game and this is where the reviews
                    will go. This is a review for a game and this is where the reviews
                    will go. This is a review for a game and this is where the reviews
                    will go.
                </p>
                <input class="flag" type="button" name="flag" id="flag" value="FLAG REVIEW">
            </div>
        </div>
    </div>

</body>
</HTML>