<?php
    //Include class definitions for login check
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/display.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //If sent by the GET method, grab user ID and create objects
    if (isset($_GET["UID"]) && $_GET["UID"] > 0) {
        $userID = $_GET["UID"];

        //
    //Create a display object for the page
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
        <div class="headerImageMessage">
            USER INFO HERE
        </div>
    </div>

    <h1>User Information</h1>
    <!-- Main Area Container Which holds all -->
    <div class="mainContainer">

        <!-- user information container -->
        <div class="userInformation">

            <!-- image and basic information container -->
            <div class="userInformationLeft">

                <!-- image container -->
                <div class="userProfileImage">
                    <img src="userImage.png" alt="profile picture">
                </div>

                <!-- information container -->
                <div class="simpleUserInfo">
                    <p>Ryan Scott</p>
                    <p>23/04/2001</p>
                    <p>ryanscott@geekagogo.ca</p>
                </div>
            </div>

            <!-- biography, favourites, and edit profile container-->
            <div class="userInformationRight">

                <!-- biography -->
                <div class="userBiography">
                    <p>My name is Ryan DJ Scott and I enjoy tabletop games!
                        My name is Ryan DJ Scott and I enjoy tabletop games!
                        My name is Ryan DJ Scott and I enjoy tabletop games!
                        My name is Ryan DJ Scott and I enjoy tabletop games!
                        My name is Ryan DJ Scott and I enjoy tabletop games!
                    </p>
                </div>

                <!-- right side information-->
                <div class="favouritesInfo">
                    <p>Favourite Game: GeekAGone</p>
                    <p>Type: Strategy</p>
                    <p>Time Playing Game: 10+ years</p>
                </div>

            </div>

        </div>
    </div>

</body>

</HTML>