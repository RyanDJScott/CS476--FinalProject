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

    //Set error message
    $errorMessage = "";

    //If you were sent by the GET method, and it's an error, display error
    if (isset($_GET["error"]) && $_GET["error"] === "db_error") 
        $errorMessage = "There was an issue modiyfing this user in the database. Please contact the site administrators.";

    //If you're logged in, an administrator, and pressed either the promote or delete button, execute the following actions
    if ((isset($_SESSION["UID"]) && is_object($_SESSION["userObj"]) && is_a($_SESSION["userObj"], 'adminUser')) && (isset($_POST["promoteUser"]) || isset($_POST["deleteUser"]))) {
        $editUser = FALSE;
        
        //Promote the user to administrator
        if (isset($_POST["promoteUser"]) && $_POST["promoteUser"] === "PROMOTE")
            $editUser = $_SESSION["userObj"]->promoteUser($_POST["UID"]);
        //Delete the users account
        else if (isset($_POST["deleteUser"]) && $_POST["deleteUser"] === "DELETE")
            $editUser = $_SESSION["userObj"]->deleteUser($_POST["UID"]);

        //If the action succeeded, go to the dashboard. Otherwise, post an error.
        if ($editUser == TRUE)
            header("Location: dashboard.php");
        else if ($editUser == FALSE)
            header("Location: viewProfile.php?UID=" . $_POST["UID"] . "&error=db_error");
    }
?>
<!DOCTYPE html>
<HTML lang="en">

<head>
    <title>View Profile - Queen City's Gambit</title>
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

    <p class="errorMessage"><?=$errorMessage?></p>
    
    <?php $display->displayViewProfile($userID); ?>    

</body>

</HTML>