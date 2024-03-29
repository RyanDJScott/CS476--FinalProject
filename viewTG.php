<?php
    //Include class definitions for login check
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/display.php');
    include_once(__DIR__ . '/PHP/TGE.php');
    include_once(__DIR__ . '/PHP/review.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Create a display object for the page
    $display = new Display();

    //Fetch game title from the GET method
    if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0) {
        //Get the game title
        $gameTitle = $_GET["gameTitle"];

        //Create a new TGE object 
        $thisGame = new TGE($gameTitle);

        //Get the status information for this game
        $gameStatus = $thisGame->getStatusInfo();
    } else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["gameTitle"]) && strlen($_POST["gameTitle"]) > 0) {
        //Get the game title
        $gameTitle = $_POST["gameTitle"];

        //Create a new TGE object 
        $thisGame = new TGE($gameTitle);

        //Get the status information for this game
        $gameStatus = $thisGame->getStatusInfo();
    }

    //If the user presses the flag button, set the flag
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["gameTitle"]) && isset($_POST["UID"])) {
        //If the user is logged in, they are allowed to flag a review
        if (isset($_SESSION["UID"]) && is_object($_SESSION["userObj"])) {
            //Instantiate the review from the information
            $thisReview = new Review($_POST["gameTitle"], $_POST["UID"]);
            
            //Use the user to flag this review
            $_SESSION["userObj"]->flagReview($thisReview);

            //Take them back to the same page
            header("Location: viewTG.php?gameTitle=" . $_POST["gameTitle"] . "");
        } else {
            //They aren't logged in, take them to the login page
            header("Location: login.php");
        }
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
        <div class="headerImageMessage">
            <?php 
                if (isset($gameTitle)) 
                    echo $gameTitle; 
            ?>
        </div>
    </div> 

    <?php
        //If the game has been rejected or is pending, show error information
        if (isset($gameStatus) && ($gameStatus["status"] == 0 || $gameStatus["status"] == 2)) {
    ?>
    <p class="errorMessage">This game has not been approved for publication on the site.</p>
    <p class="errorMessage">Please contact the site administrators for more information!</p>
    <?php
        //Otherwise, display the information for the review
        } else {
    ?>
    <!-- Container for page elements -->
    <div class="overallContainer">
        <?php $display->displayTGE($thisGame); ?>
        <!-- Container for each review... multiples will be added -->
        <?php
            //Get all of the reviews for this tabletop game 
            $reviews = $thisGame->getReviews();

            //Print each review on this page
            if (sizeof($reviews) > 0) {
                foreach($reviews as $gameReview) {
                    $display->displayReview($gameReview);
                }
            }
        ?>
    </div>
        <?php }?>

</body>
</HTML>