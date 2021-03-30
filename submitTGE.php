<?php
    //Include class definitions for login check, form submission
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/submitTGEScripts.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Set the error message to be blank
    $errorMessage = "";

    //Check to see if they are logged in; redirect if not
    if (!isset($_SESSION["UID"]) && !isset($_SESSION["userObj"]))
        header("Location: login.php");
    else {
    //If the form was submitted, execute the signup process
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $submitTGE = new submitTGE($_SESSION["UID"]);
            $submitTGE->submitForm();
        }

        //If the user was sent here with the GET method for errors, set the error
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            //Insertion error
            if (isset($_GET["error"]) && $_GET["error"] === "db_error")
                $errorMessage = "There was an issue creating your account. Please contact the site administrators, or try again!";
            
            //Validation error
            if (isset($_GET["error"]) && $_GET["error"] === "val_error")
                $errorMessage = "There is a problem with one of the fields below. Please enable JavaScript for help with the signup form!";

            //Validation error
            if (isset($_GET["error"]) && $_GET["error"] === "st_error")
                $errorMessage = "There was a problem setting the status of your tabletop game entry. Please contact the site administrators!";

            //Validation error
            if (isset($_GET["error"]) && $_GET["error"] === "img_error")
                $errorMessage = "Your images could not be uploaded to the site, you submitted too many (max of 4), or you haven't submitted any! Please try again!";

            //Validation error
            if (isset($_GET["error"]) && $_GET["error"] === "dbimg_error")
                $errorMessage = "Your images could not be saved in the database. Please contact the site administrators!";
        }
?>
<!DOCTYPE html>
<HTML lang="en">

<head>
    <title>Submit TGE - Queen City's Gambit</title>
    <meta charset="UTF=8">
    <!--==========================Stylsheets=================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/submitTGE.css">
    <!--==========================Script Files===============================-->
    <script type="text/javascript" src="JavaScript/validationFunctions.js"></script>
    <script type="text/javascript" src="JavaScript/submitTGEValidation.js"></script>
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

    <!-- Submit TGE header image -->
    <div class="dashboardHeader">
        <img src="dependencies/submitGameHeaderImage.png" class="headerImage" alt="Submit a Tabletop Game!" />
    </div>

    <div class="container">
        <!-- Container for Submission Form -->
        <div class="formContainer">
        <p class="errorMessage"><?php echo htmlspecialchars($errorMessage); ?></p>

            <!-- Game Name and Error -->
            <div class="submitTable">
                <form id="submitForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <table>

                        <!-- Submit TGE Name and Error-->
                        <tr>
                            <td><label for="submitTGEName" class="attributeHeader">Game Name:</label></td>
                            <td><input type="text" id="submitTGEName" name ="submitTGEName"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="errorMessage" id="submitTGENameError"></div>
                            </td>
                        </tr>

                        <!-- Name of TGE Company -->
                        <tr>
                            <td><label for="submitTGECompanyName" class="attributeHeader">Company Name:</label></td>
                            <td><input type="text" id="submitTGECompanyName" name="submitTGECompanyName"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="errorMessage" id="submitTGECompanyNameError"></div>
                            </td>
                        </tr>

                        <!-- Approximate Playtime -->
                        <tr>
                            <td><label for="submitTGEPlaytime" class="attributeHeader">Approximate Playtime:</label></td>
                            <td><input type="text" id="submitTGEPlaytime" name="submitTGEPlaytime">&nbsp;hours</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="errorMessage" id="submitTGEPlaytimeError"></div>
                            </td>
                        </tr>

                        <!-- Age Rating -->
                        <tr>
                            <td><label for="submitTGEAge" class="attributeHeader">Age Rating:</label></td>
                            <td><input type="text" id="submitTGEAge" name="submitTGEAge">&nbsp;+years</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="errorMessage" id="submitTGEAgeError"></div>
                            </td>
                        </tr>

                        <!-- Number of Players -->
                        <tr>
                            <td><label for="submitTGEPlayers" class="attributeHeader">Number of Players:</label></td>
                            <td><input type="text" id="submitTGEPlayers" name="submitTGEPlayers"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="errorMessage" id="submitTGEPlayersError"></div>
                            </td>
                        </tr>

                        <!-- Number of Expansions -->
                        <tr>
                            <td><label for="submitTGEExpansions" class="attributeHeader">Number of Expansions</label></td>
                            <td><input type="text" id="submitTGEExpansions" name="submitTGEExpansions"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="errorMessage" id="submitTGEExpansionsError"></div>
                            </td>
                        </tr>

                    </table>
            </div>
            <!-- Provides and area to leave the game description -->

            <div>
                <div class="attributeHeader">Describe the game:<br></div>
                <textarea class="gameDescription" rows="10" name="description"></textarea>

                <div class="errorMessage" id="descriptionError"></div>
            </div>

            <!-- Upload Button -->
            <div class="uploadImageFile">

                <label for="submitTGEUpload" class="attributeHeader">Upload a file:</label>
                <input type="file" id="submitTGEUpload" class="imageUploader" name="submitTGEUpload[]" multiple><br>
                Please note that you must select up to four images at the same time<br>
            </div>

            <!-- Submit button -->
            <div>
                <input type="submit" class="navButton" name="formSubmitButton">

            </div>
            </form>

            <div class="errorMessage" id="submitError"></div>
        </div>
    </div>
    </div>

</body>
<script type="text/javascript" src="JavaScript/submitTGEEventListeners.js"></script>
</html>
<?php } ?>