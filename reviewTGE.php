<?php
include_once(__DIR__ . '/PHP/userFactory.php');
include_once(__DIR__ . '/PHP/TGE.php');

//Check to see if they are logged in AND an administrator; redirect if not
if (!isset($_SESSION["UID"]) && !is_object($_SESSION["userObj"]) && !(is_a($_SESSION["userObj"], 'adminUser')))
    header("Location: login.php");

//Get the game title from the GET method, instantiate new TGE
if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0) {
    $gameTitle = $_GET["gameTitle"];
    $thisGame = new TGE($gameTitle);
    $display = new Display();
    
    //Execute admin functions depending on what was pressed
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["approveTGE"]) && $_POST["approveTGE"] === "APPROVE")
            $updateResult = $_SESSION["userObj"]->setTGEStatus($thisGame, 1, $_POST["gameFeedback"]);
        else if (isset($_POST["rejectTGE"]) && $_POST["rejectTGE"] === "REJECT")
            $updateResult = $_SESSION["userObj"]->setTGEStatus($thisGame, 0, $_POST["gameFeedback"]);
    }

    if ($updateResult)
        header("Location: dashboard.php");
    else
        header("Location: reviewTGE.php?error=st_error");
}

//Error checking
if (isset($_GET["error"]) && $_GET["error"] === "st_error")
    $errorMessage = "There was an error updating the status of this game. Please try again.";
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
    <link rel="stylesheet" href="stylesheets/reviewTGE.css">
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
    </div>

    <!-- 
        Page includes:
            Game components
                -> should be the same as view game
            Images of the game below
                -> same as reviewFlag
            Space for feedback
            Buttons to accept or reject
    -->
    <div class="pageAllignment">
    <p class="errorMessage"><?php echo $errorMessage; ?></p>
        <?php $display->displayTGE($thisGame); ?>
        <form name="approvalForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- leave feedback -->
            <div class="textBoxBottom">
                <div class="nameFeedback">
                    Leave Feedback
                </div>

                <div class="textArea">
                    <!-- input box -->
                    <textarea name="gameFeedback" id="gameFeedback" rows="10" cols="50"></textarea>
                </div>
            </div>

            <!-- buttons -->
            <div class="buttonContainer">

                <!-- Approves the TGE -->
                <input class="button" type="submit" name="approveTGE" value="APPROVE">

                <!-- Rejects the TGE -->
                <input class="button" type="submit" name="rejectTGE" value="REJECT">

            </div>
        </form>
    </div>

</body>

</html>