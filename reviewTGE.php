<?php
//Include navBar functions and class definitions
include_once(__DIR__ . '/PHP/navBar.php');
include_once(__DIR__ . '/PHP/userFactory.php');
include_once(__DIR__ . '/PHP/TGE.php');
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
    //Get the game title from the GET method, instantiate new TGE/Display
    if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0) {
        //Get the game title, create a new TGE object from it, then create display object
        $gameTitle = $_GET["gameTitle"];
        $thisGame = new TGE($gameTitle);
        $display = new Display();
    }

    //Execute admin functions depending on what was pressed
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Retrieve the gameTitle and send it to the admin functions
        $gameTitle = $_POST["gameTitle"];

        //If accept was pressed, set 1/reason. If reject was pressed, set 0/reason. Reason field must be filled in
        if (isset($_POST["approveTGE"]) && $_POST["approveTGE"] === "APPROVE" && strlen($_POST["gameFeedback"]) != 0)
            $updateResult = $_SESSION["userObj"]->setTGEStatus($gameTitle, 1, $_POST["gameFeedback"]);
        else if (isset($_POST["rejectTGE"]) && $_POST["rejectTGE"] === "REJECT" && strlen($_POST["gameFeedback"]) != 0)
            $updateResult = $_SESSION["userObj"]->setTGEStatus($gameTitle, 0, $_POST["gameFeedback"]);

        //If the update worked, send the admin back to their dashboard. Otherwise post error
        if ($updateResult)
            header("Location: dashboard.php");
        else if ($updateResult == FALSE && strlen($_POST["gameFeedback"]) == 0)
            header("Location: reviewTGE.php?gameTitle=" . $gameTitle . "&error=fb_empty");
        else
            header("Location: reviewTGE.php?gameTitle=" . $gameTitle . "&error=st_error");
    }

    //Error checking through GET method
    $errorMessage = "";

    //Throw error depending on error variable
    if (isset($_GET["error"])) {
        //DB error of some sort
        if ($_GET["error"] === "st_error")
            $errorMessage = "There was an error updating the status of this game. Please try again.";
        
        //Validation error
        if($_GET["error"] === "fb_empty")
            $errorMessage = "You must provide a reason for your decision.";
    }
?>
<!DOCTYPE html>
<!-- very similar to review flagged review -->
<html>

<head>
    <title> Review Tabletop Game Entry - Queen City's Gambit </title>
    <meta charset="UTF-8">
    <!-- ================Stylesheets=================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/viewTg.css">

    <!-- ================Script Files================-->
    <script type="text/javascript" src="JavaScript/validationFunctions.js"></script>
    <script type="text/javascript" src="JavaScript/reviewTGEValidation.js"></script>
  
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

    <!-- review game header image -->
    <div class="mainPageHeader">
        <img src="dependencies/boardGameHeaderImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!" />
        <div class="headerImageMessage">
            Add <?php echo $gameTitle; ?> to the Site?
        </div>
    </div>

    <div class="overallContainer">
    <p class="errorMessage"><?php echo $errorMessage; ?></p>
        <?php 
            if (isset($display))
                $display->displayReviewTGE($thisGame); 
        ?>
        <form id="submitForm" name="approvalForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- leave feedback -->
            <div class="elementContainerBottom">
                <div class="innerContainerFeedback">
                <span class="name">Leave Feedback</span>

                <div class="textArea">
                    <!-- input box -->
                    <textarea class="gameFeedback" name="gameFeedback" id="gameFeedback" rows="10"></textarea>
                </div>
                <div>
                    <div class="errorMessage" id="reviewTGEDescError"></div>
                </div>
            </div>
            </div>

            <!-- buttons -->
            <div class="buttonContainer">

                <!-- Approves the TGE -->
                <input class="button" type="submit" name="approveTGE" value="APPROVE" id="approveTGE">

                <!-- Rejects the TGE -->
                <input class="button" type="submit" name="rejectTGE" value="REJECT" id="rejectTGE">
                
                <input type="hidden" name="gameTitle" value="<?php echo $gameTitle; ?>">

            </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="JavaScript/reviewTGEEventListeners.js"></script>
</html>
<?php 
}
?>