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
    if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0) {
        $gameTitle = $_GET["gameTitle"];
        $thisGame = new TGE($gameTitle);
    }
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
        <?php $display->displayTGE($thisGame); ?>
        <!-- Container for each review... multiples will be added -->
        <?php
            //Get all of the reviews for this tabletop game 
            $reviews = $thisGame->getReviews();

            //Print each review on this page
            foreach($reviews as $gameReview) {
                $display->displayReview($gameReview);
            }
        ?>
    </div>

</body>
</HTML>