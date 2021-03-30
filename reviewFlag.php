<?php
//Include navBar functions and class definitions
include_once(__DIR__ . '/PHP/navBar.php');
include_once(__DIR__ . '/PHP/userFactory.php');
include_once(__DIR__ . '/PHP/TGE.php');
include_once(__DIR__ . '/PHP/review.php');
include_once(__DIR__ . '/PHP/display.php');

//Continue the session
session_start();

//Check to see if they are logged in, if not redirect to login page
if (!isset($_SESSION["UID"]) && !isset($_SESSION["userObj"])) 
    header("Location: login.php");
//Check to see if they are an administrator; redirect to dashboard if not
else if (is_object($_SESSION["userObj"]) && !is_a($_SESSION["userObj"], 'adminUser'))
    header("Location: dashboard.php");
else {
    //Get the necessary information for making a review and TGE
    if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0) {
        //Grab the game title from the URL
        $gameTitle = $_GET["gameTitle"];

        if (isset($_GET["UID"]) && $_GET["UID"] > 0) {
            //Grab the UID from the URL
            $UID = $_GET["UID"];

            //Make a game, review, and display
            $thisGame = new TGE($gameTitle);
            $thisReview = new Review($gameTitle, $UID);
            $display = new Display();
        }
    }

    //Display error message
    $errorMessage = "";

    //Error checking
    if (isset($_GET["error"]) && $_GET["error"] === "db_error")
        $errorMessage = "There was an issue executing your decision on this flagged review. Please try again, or contact the DB administrator.";

    //If the method is POST, execute admin actions
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Get the gameTitle/UID for the functions
        $gameTitle = $_POST["gameTitle"];
        $userID = $_POST["UID"];

        //If the approve button was selected, remove the flag. Otherwise, delete the review from the DB
        if (isset($_POST["removeFlag"]) && $_POST["removeFlag"] === "APPROVE")
            $reviewFlag = $_SESSION["userObj"]->removeFlag($gameTitle, $userID);
        else if (isset($_POST["deleteReview"]) && $_POST["deleteReview"] === "DELETE")
            $reviewFlag = $_SESSION["userObj"]->deleteReview($gameTitle, $userID);
        
        //If the action worked, send them to their dashboard, otherwise send them back with a message
        if ($reviewFlag)
            header("Location: dashboard.php");
        else 
            header("Location: reviewFlag.php?gameTitle=" . $gameTitle . "&UID=" . $UID . "&error=db_error");
    }
?>
<!DOCTYPE html>
<html>
<!-- name and stylesheets-->

<head>
    <title>Flagged Review - Queen City's Gambit</title>
    <meta charset="UTF-8">
    <!--==========================Stylsheets=================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/viewTg.css">
    <link rel="stylesheet" href="stylesheets/reviewTGE.css">
    <link rel="stylesheet" href="stylesheets/reviewFlag.css">
    <!--==========================Script Files===============================-->
    <script type="text/javascript" src="JavaScript/validationFunctions.js"></script>
    <script type="text/javascript" src="JavaScript/reviewFlagValidation.js"></script>
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

    <!-- review flag header image -->
    <div class="mainPageHeader">
        <img src="dependencies/flaggedReview.png" class="headerImage" alt="Welcome to Queen City's Gambit!" />
    </div>

    <!-- 
        Page includes:
            description of the game for which the review has been flagged
            images of said game (max of 4)
            flagged review
            Buttons, one can remove the flag (review is good) other can delete review
    -->

    <!-- page container -->
    <div class="pageAllignment">
        <?php
            //Check if this review is actually flagged
            if ($thisReview->getFlag() == 1) {
            
            //This review has been flagged; implement all display functions etc.
        ?>
        <p class="errorMessage"><?=$errorMessage?></p>

        <?php $display->displayTGE($thisGame); ?>
        
        <!-- another field for the flagged review to be displayed -->
        <?php $display->displayFlaggedReview($thisReview); ?>

        <!-- This is where the buttons will go -->
        <div class="buttonContainer">
            <form class="buttonForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Removes the Flag - i.e. the review is fine -->
                <input class="button" type="submit" name="removeFlag" id="removeFlag" value="APPROVE"> 

                <!-- Deletes the review - i.e. the revie violated rules -->
                <input class="button" type="submit" name="deleteReview" id="deleteFlag" value="DELETE">
                <input type="hidden" name="gameTitle" value="<?=$gameTitle?>">
                <input type="hidden" name="UID" value="<?=$UID?>">
            </form>
        </div>
        <?php
            //This review hasn't been flagged; show error message
            } else if ($thisReview->getFlag() == 0) {
        ?>
        <p class="errorMessage">This review hasn't been flagged!</p>
        <?php
            }
        ?>

    </div>
</body>
<script type="text/javascript" src="JavaScript/reviewFlagEventListeners.js"></script>
</html>
<?php
}
?>