<?php
    //Include class definitions for login check, form submission
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/userProfileScripts.php');

    //Include functions for displaying
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //Check to see if they are already logged in; redirect if so
    if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0 && is_object($_SESSION["userObj"]))
        header("Location: dashboard.php");
    else {
        //Set the error message to be blank
        $errorMessage = "";
        //If the form was submitted, execute the signup process
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $signUpObject = new userSignup;
            $signUpObject->submitForm();
        }

        //If the user was sent here with the GET method for errors, set the error
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            //Insertion error
            if (isset($_GET["error"]) && $_GET["error"] === "db_error")
                $errorMessage = "There was an issue creating your account. Please contact the site administrators, or try again!";
            
            //Validation error
            if (isset($_GET["error"]) && $_GET["error"] === "val_error")
                $errorMessage = "There is a problem with one of the fields below. Please enable JavaScript for help with the signup form!";
        }
?>
<!DOCTYPE html>
<HTML lang="en">

<head>
    <title>Signup - Queen City's Gambit</title>
    <meta charset="UTF-8">
    <!--==========================Stylsheets=================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/signup.css">
</head>

<body>
    <!-- The navigation bar -->
    <nav> 
        <a href="index.php"><img src="dependencies/miniLogo.png" alt="Mini Logo Home Button" class="miniLogo" /></a>
        <?php
            //This page can only be accessed by logged out users
            loggedOutNavBar();   
        ?>
    </nav>

    <!-- Signup header image -->
    <div class="mainPageHeader">
        <img src="dependencies/signupHeaderImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!" />
    </div>

    <!-- Signup Form Container -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="alignmentContainer">
            <div class="signupContainer">
                <p class="errorMessage"><?php echo htmlspecialchars($errorMessage) ?></p>
                <!-- outer container for flexbox design-->
        
                <!-- First Name and Error -->
                <div class="rowContainer">
                    <label for="signupFName">First Name:</label>
                    <div class="itemContainer">
                        <input type="text" id="signupFName" name="signupFName" placeholder="first name here">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupFNameError"></div>
                        </div>
                    </div>
                </div>

                <!-- Last Name and Error -->
                <div class="rowContainer">
                    <label for="signupLName">Last Name:</label>
                    <div class="itemContainer">
                        <input type="text" id="signupLName" name="signupLName" placeholder="last name here">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupLNameError"></div>
                        </div>
                    </div>
                </div>
        
                <!-- Email -->
                <div class="rowContainer">
                    <label for="signupEmail">Email:</label>
                    <div class="itemContainer">
                        <input type="email" id="signupEmail" name="signupEmail" placeholder="enter email here">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupEmailError"></div>
                        </div>
                    </div>
                </div>

                <!-- Screenname -->
                <div class="rowContainer">
                    <label for="signupScreenname">Screenname:</label>
                    <div class="itemContainer">
                        <input type="text" id="signupScreenname" name="signupScreenname" placeholder="enter screenname here">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupScreennameError"></div>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="rowContainer">
                    <label for="signupPassword">Password:</label>
                    <div class="itemContainer">
                        <input type="password" id="signupPassword" name="signupPassword" placeholder="provide a password">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupPasswordError"></div>
                        </div>
                    </div>
                </div>

                <!-- Password Confirm -->
                <div class="rowContainer">
                    <label for="signupPasswordConfirm">Confirm Password:</label>
                    <div class="itemContainer">
                        <input type="password" id="signupPasswordConfirm" name="signupPasswordConfirm" placeholder="confirm password">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupPasswordConfirmError"></div>
                        </div>
                    </div>
                </div>

                <!-- Birthday -->
                <div class="rowContainer">
                    <label for="signupBirthday">Birthday:</label>
                    <div class="itemContainer">
                        <input type="date" id="signupBirthday" name="signupBirthday">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupBirthdayError"></div>
                        </div>
                    </div>
                </div>

                <!-- Favourite Boardgame -->
                <div class="rowContainer">
                    <label for="signupFavGame">Favourite Game:</label>
                    <div class="itemContainer">
                        <input type="text" id="signupFavGame" name="signupFavGame" placeholder="favourite game here">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupFavGameError"></div>
                        </div>
                    </div>
                </div>

                <!-- Favourite Boargame Type -->
                <div class="rowContainer">
                    <label for="signupFavGameType">Favourite Type:</label>
                    <div class="itemContainer">
                        <select id="signupFavGameType" name="signupFavGameType">
                            <option value="Board Game">Board Game</option>
                            <option value="Card Game">Card Game</option>
                            <option value="Dice Game">Dice Game</option>
                            <option value="Paper and Pencil Game">Paper and Pencil Game</option>
                            <option value="Role-Playing Game">Role-Playing Game</option>
                            <option value="Strategy Game">Strategy Game</option>
                            <option value="Tile-Based Game">Tile-Based Game</option>
                        </select>
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupFavGameTypeError"></div>
                        </div>
                    </div>
                </div>

                <!-- Time Playing Tabletop Games -->
                <div class="rowContainer">
                    <label for="signupGameTime">Time Playing Games:</label>
                    <div class="itemContainer">
                        <select id="signupGameTime" name="signupGameTime">
                            <option value="0-1 years">0-1 years</option>
                            <option value="1-3 years">1-3 years</option>
                            <option value="3-6 years">3-6 years</option>
                            <option value="6+ years">6+ years</option>
                        </select>
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupGameTimeError"></div>
                        </div>
                    </div>
                </div>

                <!-- Biography -->
                <div class="rowContainer">
                    <label for="signupBiography">Biography:</label>
                    <div class="itemContainer">
                        <textarea id="signupBiography" name="signupBiography" rows="10" placeholder="tell us a bit about yourself..."></textarea>
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupBiographyError"></div>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="rowContainer">
                    <label for="signupPic">Picture:</label>
                    <div class="itemContainer">
                        <input type="file" id="signupPic" name="uploadPic">
                        <div class="errorContainer">
                            <div class="errorMessage" id="signupPicError"></div>
                        </div>
                    </div>
                </div>

                <div class="rowContainer">
                    <input type="submit" class="navButton">
                </div>
                
            </div>
        </div>
    </form>
</body>

</HTML>
<?php } ?>
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