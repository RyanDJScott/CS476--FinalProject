<?php
    //Include class definitions for login check, form submission
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/userProfileScripts.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Set the error message to be blank
    $errorMessage = $successMessage = "";

    //Check to see if they are logged in; redirect if not
    if (!isset($_SESSION["UID"]) && !is_object($_SESSION["userObj"]))
        header("Location: login.php");

    //If the form was submitted, execute the signup process
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["editSubmit"]) && $_POST["editSubmit"] === "EDIT") {
            $editProfileObject = new userEditProfile($_SESSION["userObj"]);
            $editProfileObject->submitForm();
        } else if (isset($_POST["deleteProfile"]) && $_POST["deleteProfile"] === "DELETE") {
            $_SESSION["userObj"]->deleteAccount();
        }
    }

    //If the user was sent here with the GET method for errors, set the error
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        //Profile successfully updated
        if (isset($_GET["error"]) && $_GET["error"] === "success")
            $successMessage = "Your profile was successfully updated!";

        //Insertion error
        if (isset($_GET["error"]) && $_GET["error"] === "db_error")
            $errorMessage = "There was an issue creating your account. Please contact the site administrators, or try again!";
        
        //Validation error
        if (isset($_GET["error"]) && $_GET["error"] === "val_error")
            $errorMessage = "There is a problem with one of the fields below. Please enable JavaScript for help with the signup form!";
    }
?>
<!DOCTYPE html>
<HTML>

<head>
    <title> View Tabletop Game - Queen City's Gambit </title>
    <meta charset="UTF=8">
    <!--=============================Stylesheets=======================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/signup.css">
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

    <!-- Main header image -->
    <div class="mainPageHeader">
        <img src="dependencies/boardGameHeaderImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!" />
    </div>

    <!-- 
        User can change everything (anything on signup)
    -->
<!-- Edit Profile Form Container -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <div class="alignmentContainer">
        <div class="signupContainer">
            <p><?php echo htmlspecialchars($successMessage); ?></p>
            <p class="errorMessage"><?php echo htmlspecialchars($errorMessage); ?></p>
            <!-- outer container for flexbox design-->
    
            <!-- First Name and Error -->
            <div class="rowContainer">
                <label for="editFName">First Name:</label>
                <div class="itemContainer">
                    <input type="text" id="editFName" name="editFName" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getFirstName()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editFNameError"></div>
                    </div>
                </div>
            </div>

            <!-- Last Name and Error -->
            <div class="rowContainer">
                <label for="editLName">Last Name:</label>
                <div class="itemContainer">
                    <input type="text" id="editLName" name="editLName" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getLastName()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editLNameError"></div>
                    </div>
                </div>
            </div>
    
            <!-- Email -->
            <div class="rowContainer">
                <label for="editEmail">Email:</label>
                <div class="itemContainer">
                    <input type="email" id="editEmail" name="editEmail" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getEmail()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editEmailError"></div>
                    </div>
                </div>
            </div>

            <!-- Screenname -->
            <div class="rowContainer">
                <label for="editScreenname">Screenname:</label>
                <div class="itemContainer">
                    <input type="text" id="editScreenname" name="editScreenname" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getScreenName()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editScreennameError"></div>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="rowContainer">
                <label for="editPassword">Password:</label>
                <div class="itemContainer">
                    <input type="password" id="editPassword" name="editPassword" placeholder="Enter a new password">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editPasswordError"></div>
                    </div>
                </div>
            </div>

            <!-- Password Confirm -->
            <div class="rowContainer">
                <label for="editPasswordConfirm">Confirm Password:</label>
                <div class="itemContainer">
                    <input type="password" id="editPasswordConfirm" name="editPasswordConfirm" placeholder="Confirm new password">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editPasswordConfirmError"></div>
                    </div>
                </div>
            </div>

            <!-- Birthday -->
            <div class="rowContainer">
                <label for="editBirthday">Birthday:</label>
                <div class="itemContainer">
                    <input type="date" id="editBirthday" name="editBirthday" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getBirthday()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editBirthdayError"></div>
                    </div>
                </div>
            </div>

            <!-- Favourite Boardgame -->
            <div class="rowContainer">
                <label for="editFavGame">Favourite Game:</label>
                <div class="itemContainer">
                    <input type="text" id="editFavGame" name="editFavGame" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getFavGame()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editFavGameError"></div>
                    </div>
                </div>
            </div>

            <!-- Favourite Boargame Type -->
            <div class="rowContainer">
                <label for="editFavGameType">Favourite Type:</label>
                <div class="itemContainer">
                    <select id="editFavGameType" name="editFavGameType">
                        <option value="DEFAULT" selected disabled hidden><?php echo htmlspecialchars($_SESSION["userObj"]->getGameType()); ?></option>
                        <option value="Board Game">Board Game</option>
                        <option value="Card Game">Card Game</option>
                        <option value="Dice Game">Dice Game</option>
                        <option value="Paper and Pencil Game">Paper and Pencil Game</option>
                        <option value="Role-Playing Game">Role-Playing Game</option>
                        <option value="Strategy Game">Strategy Game</option>
                        <option value="Tile-Based Game">Tile-Based Game</option>
                    </select>
                    <div class="errorContainer">
                        <div class="errorMessage" id="editFavGameTypeError"></div>
                    </div>
                </div>
            </div>

            <!-- Time Playing Tabletop Games -->
            <div class="rowContainer">
                <label for="editGameTime">Time Playing Games:</label>
                <div class="itemContainer">
                    <select id="editGameTime" name="editGameTime">
                        <option value="DEFAULT" selected disabled hidden><?php echo htmlspecialchars($_SESSION["userObj"]->getPlayTime()); ?></option>
                        <option value="0-1 years">0-1 years</option>
                        <option value="1-3 years">1-3 years</option>
                        <option value="3-6 years">3-6 years</option>
                        <option value="6+ years">6+ years</option>
                    </select>
                    <div class="errorContainer">
                        <div class="errorMessage" id="editGameTimeError"></div>
                    </div>
                </div>
            </div>

            <!-- Biography -->
            <div class="rowContainer">
                <label for="editBiography">Biography:</label>
                    <input class="bioBoxBig" type="text" id="editBiography" name="editBiography" value="<?php echo htmlspecialchars($_SESSION["userObj"]->getBiography()); ?>">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editBiographyError"></div>
                    </div>
            </div>

            <!-- Image -->
            <div class="rowContainer">
                <label for="editPic">Picture:</label>
                <div class="itemContainer">
                    <input type="file" id="editPic" name="uploadPic">
                    <div class="errorContainer">
                        <div class="errorMessage" id="editPicError"></div>
                    </div>
                </div>
            </div>

            <div class="rowContainer">
                <input type="submit" id="editSubmit" name="editSubmit" class="submitButton" value="EDIT">
                <input type="submit" id="deleteProfile" name="deleteProfile" class="submitButton" value="DELETE">
            </div>
            
        </div>
    </div>
</form>

</body>

</HTML>

<!-- Signup Element Template
<div class="rowContainer">                  this div contains the row, as to stack the elements
    <label for=""></label>                      this is the label for the form element
    <div class="itemContainer">                    this div arranges the input and error to be together
        <input>                             this holds the input type/info 
        <div class="errorContainer">                    this div is used for maintaining the error
            <div class="errorMessage" id=""></div>      this div is just for the error message itself
        </div>                                      exit error maint. div
    </div>                                      exit item container
</div>                                      exit row container
-->