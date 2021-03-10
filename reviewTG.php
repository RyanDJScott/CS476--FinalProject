<?php
    //Include class definitions for login check, form submission
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/reviewTGScripts.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Set the error message to be blank
    $errorMessage = "";

    //Check to see if they are logged in; redirect if not
    if (!isset($_SESSION["UID"]) && !is_object($_SESSION["userObj"]))
        header("Location: login.php");

    //Get the game title from the GET method
    if (isset($_GET["gameTitle"]) && strlen($_GET["gameTitle"]) > 0)
        $gameTitle = $_GET["gameTitle"];

    //If the post method was used, create an object and submit the form
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $submitReview = new submitReview();
        $submitReview->submitForm();
    }
?>
<!DOCTYPE html>
<HTML lang="en">

<head>
    <title>Review a Game - Queen City's Gambit</title>
    <meta charset="UTF-8">
    <!--==========================Stylsheets=================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/reviewTG.css">
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

    <!-- Signup header image -->
    <div class="mainPageHeader">
        <img src="dependencies/boardGameHeaderImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!" />
        <div class="headerImageMessage">
            Leave a review for <?php echo $gameTitle; ?>
        </div>
    </div>

    <!-- Alignment Container -->
    <div class="alignmentContainer">

        <!-- Form container -->
        <div class="formContainer">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <table class="reviewTableForm">

                    <!-- Rating -->
                    <tr>
                        <td><label for="reviewRating">Rating:</label></td>
                        <td><input type="number" id="reviewRating" name="reviewRating">&nbsp;/10</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="errorMessage" id="reviewRatingError"></div>
                        </td>
                    </tr>

                    <!-- Recommended? -->
                    <tr>
                        <td><label for="reviewRecommended">Would you recommend?</label></td>
                        <td><input type="radio" id="yes" name="reviewRecommended" value="YES">Yes &nbsp;
                            <input type="radio" id="no" name="reviewRecommended" value="NO">No
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="errorMessage" id="reviewRecommendedError"></div>
                        </td>
                    </tr>

                    <!-- Average Age of Players -->
                    <tr>
                        <td><label for="reviewAge">Average age of players:</label></td>
                        <td><input type="number" id="reviewAge" name="reviewAge">&nbsp;years</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="errorMessage" id=""></div>
                        </td>
                    </tr>

                    <!-- Playtime for one round -->
                    <tr>
                        <td><label for="reviewPlaytime">Time for one round:</label></td>
                        <td><input type="number" id="reviewPlaytime" name="reviewPlaytime">&nbsp;hour(s)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="errorMessage" id="reviewPlaytimeError"></div>
                        </td>
                    </tr>

                    <!-- Number of Times Player -->
                    <tr>
                        <td><label for="reviewPlayedQuantity">Number of times played:</label></td>
                        <td><input type="number" id="reviewPlayedQuantity" name="reviewPlayedQuantity"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="errorMessage" id="reviewPlayedQuantityError"></div>
                        </td>
                    </tr>

                    <!-- Percieved difficulty -->
                    <tr>
                        <td><label for="reviewDifficulty">Percieved Difficulty</label></td>
                        <td>
                            <select id="reviewDifficulty" name="reviewDifficulty">
                                <option value="Easy">Easy</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Difficult">Difficulty</option>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="errorMessage" id="reviewDifficultyError"></div>
                        </td>
                    </tr>

                </table>

                <!-- Review section itself -->

                <div class="reviewSection">
                    Please tell us about your experience with this game:<br>
                    <textarea rows="15" cols="75" name="reviewText">Leave your review here...</textarea>
                    <div class="errorMessage" id="reviewTextError"></div>
                </div>


                <!-- submit button-->
                <input class="reviewSubmitButton" type="submit">
            </form>
        </div>
    </div>

</body>

</HTML>