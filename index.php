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
?>

<!DOCTYPE html>
<HTML lang="en">
<head>
    <title> Queen City's Gambit - Regina's Tabletop Gaming Community </title>
    <meta charset="UTF=8">
    <meta name="description" content="A website for the tabletop gaming community of Regina - Come here to share your thoughts!">
    <meta name="keywords" content="tabletop, games, gaming, Regina, Saskatchewan, review, community, Queen City's Gambit">
    <meta name="author" content="Nathan Slaney, Ryan Scott">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============================Stylesheets=======================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/index.css">
    <link rel="stylesheet" href="stylesheets/smallGameBox.css">
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
        <img src="dependencies/headerImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!"/>
    </div> 

    <!--Main Area -->
    <!--Main area container-->
    <h1> Featured Table Top Game! </h1>
    <div class="mainAreaContainer">
        
    
        <!-- featured item container-->
        <div class="featuredItem">
            <?php
                $display->displayTGEFeatureGameBox("Betrayal at House on the Hill");
            ?>
        </div>

            
        <div class="gameHeader"><h1>Tabletop Games</h1></div>
        <!-- Regular Games Container-->
        <div class="gameContainer">
            <?php
                $display->displayAllGames();
            ?>
        </div>
    </div>
</body>
</HTML>