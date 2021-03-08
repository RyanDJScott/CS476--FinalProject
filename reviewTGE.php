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

    //Execute admin functions depending on what was pressed
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["approveTGE"]) && $_POST["approveTGE"] === "APPROVE")
            $_SESSION["userObj"]->setTGEStatus($thisGame, 1, $_POST["gameFeedback"]);
        else if (isset($_POST["rejectTGE"]) && $_POST["rejectTGE"] === "REJECT")
            $_SESSION["userObj"]->setTGEStatus($thisGame, 0, $_POST["gameFeedback"]);
    }
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

        <!-- Displays game information -->
        <div class="textBox">

            <!-- left side of the information-->
            <div class="innerContainer">
                <div class="name">Gamename</div>
                Submitted by screenname<br>
                Company: ________ <br>
                Play Time: ________ <br>
                Age Rating: ________ <br>
                Number of Players: ________ <br>
                Expenses: ________ <br>
            </div>

            <!-- right side (description)-->
            <div class="innerContainer">
                <p><br>
                    This is a game and here is the description.
                    This is a game and here is the description.
                    This is a game and here is the description.
                    This is a game and here is the description.
                    This is a game and here is the description.
                </p>
            </div>
        </div>

        <!-- Container for images of the tabletop game-->
        <div class="imageContainer">
            <!-- Images of the boardgame, ideally should appear
             as four in a row-->
            <img class="image" src="dependencies/placeholder.png" alt="tabletop game image" />
            <img class="image" src="dependencies/placeholder.png" alt="tabletop game image" />
            <img class="image" src="dependencies/placeholder.png" alt="tabletop game image" />
            <img class="image" src="dependencies/placeholder.png" alt="tabletop game image" />
        </div>

        <form name="approvalForm" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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

                <!-- Removes the Flag - i.e. the review is fine -->
                <input class="button" type="submit" name="approveTGE" value="APPROVE">

                <!-- Deletes the review - i.e. the revie violated rules -->
                <input class="button" type="submit" name="rejectTGE" value="REJECT">

            </div>
        </form>
    </div>

</body>

</html>