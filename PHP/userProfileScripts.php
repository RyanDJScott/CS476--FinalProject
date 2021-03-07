<?php
//Include database definitions
include_once(__DIR__ . '/database.php');
include_once(__DIR__ . '/userFactory.php');

abstract class userProfileSubmission {
    //Member variables
    protected $firstName = NULL;
    protected $lastName = NULL;
    protected $email = NULL;
    protected $birthday = NULL;
    protected $password = NULL;
    protected $confirmPassword = NULL;
    protected $screenName = NULL;
    protected $avatarURL = NULL;
    protected $biography = NULL;
    protected $favGame = NULL;
    protected $gameType = NULL;
    protected $playTime = NULL;

    //Database variables
    protected $db = NULL;
    protected $dbConnect = NULL;

    //Member functions: validation functions for both classes

    // Function Name: valFirstName
    // Purpose: To validate the information contained in $firstName
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the name passes validation
    //   <2> FALSE: If the name doesn't pass validation
    // Side Effects: None
    protected function valFirstName() {
        if (strlen($this->firstName) >= 1 && strlen($this->firstName) <= 25)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: valLastName
    // Purpose: To validate the information contained in $lastName
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the name passes validation
    //   <2> FALSE: If the name doesn't pass validation
    // Side Effects: None
    protected function valLastName() {
        if (strlen($this->lastName) >= 1 && strlen($this->lastName) <= 25)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: valEmail
    // Purpose: To validate the information contained in $email
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the email passes validation
    //   <2> FALSE: If the email doesn't pass validation
    // Side Effects: None
    protected function valEmail() {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->email) >= 1 && strlen($this->email) <= 320)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: valScreenName
    // Purpose: To validate the information contained in $screenName
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the screenname passes validation
    //   <2> FALSE: If the screenname doesn't pass validation
    // Side Effects: None
    protected function valScreenName() {
        if (strlen($this->screenName) >= 1 && strlen($this->screenName) <= 50)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: valPassword
    // Purpose: To validate the information contained in $password and see if it matches $confirmPassword
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the password passes validation and matches the confirm password
    //   <2> FALSE: If the password doesn't pass validation or doesn't match the confirm password
    // Side Effects: None
    protected function valPassword() {
        if (strlen($this->password) >= 8 && strlen($this->password) <= 25 && preg_match("/[A-Z]+/", $this->password) && preg_match("/\W+/", $this->password) && $this->password === $this->confirmPassword)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: valBirthday
    // Purpose: To validate the information contained in $birthday
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the birthday passes validation
    //   <2> FALSE: If the birthday doesn't pass validation
    // Side Effects: 
    //   <1> The $birthday variable is converted to a MySQL date format
    protected function valBirthday() {
        if (strlen($this->birthday) > 0) {
            //Convert the birthday to a corret MySQL date format
            $this->birthday = date("Y-m-d", strtotime($this->birthday));
            
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Function Name: valFavGame
    // Purpose: To validate the information contained in $favGame
    // Parameters: None
    // Returns:
    //   <1> TRUE: If favGame passes validation
    //   <2> FALSE: If favGame doesn't pass validation
    // Side Effects: None
    protected function valFavGame() {
        if (strlen($this->favGame) >= 0 && strlen($this->favGame) <= 60)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: favGameType
    // Purpose: To validate the information contained in $gameType
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $gameType passes validation
    //   <2> FALSE: If $gameType doesn't pass validation
    // Side Effects: None
    protected function valGameType() {
        if ($this->gameType === "N_C" || (strlen($this->gameType) <= 30 && ($this->gameType === "Board Game" || $this->gameType === "Card Game" || $this->gameType === "Dice Game" || $this->gameType === "Paper and Pencil Game" ||
            $this->gameType === "Role-Playing Game" || $this->gameType === "Strategy Game" || $this->gameType === "Tile-Based Game" || $this->gameType === "")))
            return TRUE; 
        else 
            return FALSE;
    }

    // Function Name: favPlayTime
    // Purpose: To validate the information contained in $playTime
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $playTime passes validation
    //   <2> FALSE: If $playTime doesn't pass validation
    // Side Effects: None
    protected function valPlayTime() {
        if ($this->playTime === "N_C" || (strlen($this->playTime) <= 9 && ($this->playTime === "0-1 years" || $this->playTime === "1-3 years" || $this->playTime === "3-6 years" || $this->playTime === "6+ years"))) 
            return TRUE; 
        else
            return FALSE;
    }

    // Function Name: favBiography
    // Purpose: To validate the information contained in $biography
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $biography passes validation
    //   <2> FALSE: If $biography doesn't pass validation
    // Side Effects: None
    protected function valBiography() {
        if (strlen($this->biography) >= 0 && strlen($this->biography) <= 500)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: uploadImage
    // Purpose: To attempt to upload an image to the server
    // Parameters: None
    // Returns: 
    //   <1> TRUE: The image was uploaded and moved to the uploads/userPictures folder
    //   <2> FALSE: The image was not uploaded to the server
    // Side Effects:
    //   <1> An image is uploaded to the server
    protected function uploadImage() {
        //If there is no file, add the default picture URL
        if (!isset($_FILES['uploadPic']['error'])) {
            error_log("Empty File, First Check", 0);
            $this->avatarURL = "/uploads/userPictures/defaultPic.png";
            return TRUE;
        }
        
        //If the user is trying to sneak multiple files, return false
        if (is_array($_FILES['uploadPic']['error'])) {
            error_log("User trying to insert multiple files.", 0);
            return FALSE;
        }

        //If there was an upload error, return false.
        //If the error was no file, and wasn't caught earlier, return true w/ defautPic.png
        switch ($_FILES['uploadPic']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                error_log("Empty pic, second check", 0);
                $this->avatarURL = "/uploads/userPictures/defaultPic.png";
                return TRUE;
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                error_log("Size issue, first check", 0);
                return FALSE;
                break;
            default:
                return FALSE;
        }

        //If the file size is greater than 2 MB
        if ($_FILES['uploadPic']['size'] > 2097152) {
            error_log("Size issue, second check", 0);
            return FALSE;
        }

        //Check to see if it's an actual image by checking the file info object
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if (false === $ext = array_search(
            $finfo->file($_FILES['uploadPic']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),true)) {
                error_log("NOT a picture file!", 0);
                return FALSE;
            } 

        //Prepare the URL incase the file upload works
        $filePath = "/uploads/userPics/" . sha1_file($_FILES["uploadPic"]["tmp_name"]) . "." . $ext . "";

        //Try to move the file to the uploads folder
        if (!move_uploaded_file($_FILES['uploadPic']['tmp_name'],
            sprintf(
                __DIR__ . '/../uploads/userPictures/%s.%s',
                sha1_file($_FILES['uploadPic']['tmp_name']),
                $ext
            )
        )) {
            error_log("Move failed.", 0);
            return FALSE;
        } else {
            $this->avatarURL = $filePath;
            error_log("Move worked.", 0);
            return TRUE;
        }
    }

    //Abstract functions to be defined in child classes
    abstract public function submitForm();
}

class userSignup extends userProfileSubmission {
    // Function Name: Constructor
    // Purpose: To intialize all class variables
    // Parameters: None
    // Returns: None
    // Side Effects:
    //   <1> The database member variables are initialized with a database connection
    //   <2> All member variables are initialized with the input to the fields
    public function __construct() {
        //Initialize the db connection
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Initialize the member variables with the post method
        $this->firstName = trim($_POST["signupFName"]);
        $this->lastName = trim($_POST["signupLName"]);
        $this->email = trim($_POST["signupEmail"]);
        $this->screenName = trim($_POST["signupScreenname"]);
        $this->password = trim($_POST["signupPassword"]);
        $this->confirmPassword = trim($_POST["signupPasswordConfirm"]);
        $this->birthday = trim($_POST["signupBirthday"]);
        $this->favGame = trim($_POST["signupFavGame"]);
        $this->gameType = trim($_POST["signupFavGameType"]);
        $this->playTime = trim($_POST["signupGameTime"]);
        $this->biography = trim($_POST["signupBiography"]);
    }

    //Implementation of abstract methods
    public function submitForm () {
        if ($this->valFirstName() && $this->valLastName() && $this->valEmail() && $this->valScreenName() && $this->valPassword() && $this->valBirthday() 
            && $this->valFavGame() && $this->valGameType() && $this->valPlayTime() && $this->valBiography() && $this->uploadImage()) {
                //Create insert query
                $signupQuery = "INSERT INTO Users (userType, firstName, lastName, email, screenName, password, birthday, favGame, gameType, playTime, biography, avatarURL, lastLogin)
                VALUES (0, '" . $this->dbConnect->real_escape_string($this->firstName) . "', '" . $this->dbConnect->real_escape_string($this->lastName) . "', '" . $this->dbConnect->real_escape_string($this->email) . "'
                , '" . $this->dbConnect->real_escape_string($this->screenName) . "', '" . $this->dbConnect->real_escape_string($this->password) . "', '" . $this->dbConnect->real_escape_string($this->birthday) . "'
                , '" . $this->dbConnect->real_escape_string($this->favGame) . "', '" . $this->dbConnect->real_escape_string($this->gameType) . "', '" . $this->dbConnect->real_escape_string($this->playTime) . "'
                , '" . $this->dbConnect->real_escape_string($this->biography) . "', '" . $this->dbConnect->real_escape_string($this->avatarURL) . "', '0000-00-00')";

                //Execute query
                $signupResults = $this->dbConnect->query($signupQuery);

                //Check if the insert worked
                if ($signupResults == TRUE)
                    header("Location: ../login.php");
                else 
                    header("Location: ../signup.php?error=db_error");
            } else {
                header("Location: ../signup.php?error=val_error");
            }
    }

}

class userEditProfile extends userProfileSubmission {
    //Extra member variable for user object
    private $user = NULL;

    // Function Name: Constructor
    // Purpose: To intialize all class variables
    // Parameters: None
    // Returns: None
    // Side Effects:
    //   <1> The database member variables are initialized with a database connection
    //   <2> All member variables are initialized with the input to the fields
    //   <3> The new $user member variable is initialized to $userObj
    public function __construct($userObj) {
        //Initialize the db connection
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Initialize the user member variable to the passed user
        $this->user = $userObj;

        //Initialize the member variables with the post method
        $this->firstName = trim($_POST["editFName"]);
        $this->lastName = trim($_POST["editLName"]);
        $this->email = trim($_POST["editEmail"]);
        $this->screenName = trim($_POST["editScreenname"]);
        $this->password = trim($_POST["editPassword"]);
        $this->confirmPassword = trim($_POST["editPasswordConfirm"]);
        $this->birthday = trim($_POST["editBirthday"]);
        $this->favGame = trim($_POST["editFavGame"]);
        $this->biography = trim($_POST["editBiography"]);

        //Some values may be unset, check before setting
        if (isset($_POST["editFavGameType"]))
            $this->gameType = trim($_POST["editFavGameType"]);
        else 
            $this->gameType = "N_C";
        
        if (isset($_POST["editGameTime"]))
            $this->playTime = trim($_POST["editGameTime"]);
        else   
            $this->playTime = "N_C";

        //Debugging
        error_log("FirstName: " . $this->firstName . ", LastName: " . $this->lastName . ", Email: " . $this->email . ", Screenname: " . $this->screenName . 
            ", Password: " . $this->password . ", Confirm: " . $this->confirmPassword . ", birthday: " . $this->birthday . ", favGame: " . $this->favGame . ", gameType: " . $this->gameType . 
            ", playTime: " . $this->playTime . ", Bio: " . $this->biography . "", 0);
    }

    //Implementation of abstract methods
    public function submitForm() {
        error_log("FirstName: " . $this->valFirstName() . ", LastName: " . $this->valLastName() . ", Email: " . $this->valEmail() . ", Screenname: " . $this->valScreenName() . 
        ", Password: " . $this->password . ", Confirm: " . $this->confirmPassword . ", birthday: " . $this->valBirthday() . ", favGame: " . $this->valFavGame() . ", gameType: " . $this->valGameType() . 
        ", playTime: " . $this->valPlayTime() . ", Bio: " . $this->valBiography() . "", 0);

        //See if all fields pass validation
        if ($this->valFirstName() && $this->valLastName() && $this->valEmail() && $this->valScreenName() && $this->valBirthday() && $this->valFavGame() && $this->valGameType() && $this->valPlayTime() && $this->valBiography()) {
            //Set edit flags all to true
            $editFirstName = $editLastName = $editEmail = $editScreenName = $editPassword = $editBirthday = $editFavGame = $editGameType = $editPlayTime = $editBiography = $editAvatarURL = TRUE;

            //Check each field. If it was updated, set that field in the user object
            if ($this->firstName != $this->user->getFirstName())
                $editFirstName = $this->user->setFirstName($this->firstName);

            if ($this->lastName != $this->user->getLastName())
                $editLastName = $this->user->setLastName($this->lastName);

            if ($this->email != $this->user->getEmail() )
                $editEmail = $this->user->setEmail($this->email);

            if ($this->screenName != $this->user->getScreenName() )
                $editScreenName = $this->user->setScreenName($this->screenName);

            if ($this->birthday != $this->user->getBirthday() )
                $editBirthday = $this->user->setBirthday($this->birthday);

            if ($this->favGame != $this->user->getFavGame() )
                $editFavGame = $this->user->setFavGame($this->favGame);

            if ($this->gameType != "N_C" && $this->gameType != $this->user->getGameType() )
                $editGameType = $this->user->setGameType($this->gameType);
            
            if ($this->playTime != "N_C" && $this->playTime != $this->user->getPlayTime())
                $editPlayTime = $this->user->setPlayTime($this->playTime);
            
            if ($this->biography != $this->user->getBiography())
                $editBiography = $this->user->setBiography($this->biography);

            //Perform password update manually; no access to password through object
            if ($this->password != "" && $this->confirmPassword != "" && $this->valPassword()) {
                //Build an update query
                $updatePassword = "UPDATE Users SET password = '" . $this->dbConnect->real_escape_string($this->password) . "' WHERE UID = '" . $this->dbConnect->real_escape_string($this->user->getUID()) . "'";

                //Execute query
                $editPassword = $this->dbConnect->query($updatePassword);
            }

            $imageUploaded = $this->uploadImage();

            //Check image separately, if it's default do nothing
            if ($imageUploaded == TRUE && !($this->avatarURL == "/uploads/userPictures/defaultPic.png"))
                $editAvatarURL = $this->user->setAvatarURL($this->avatarURL);
            else if ($imageUploaded == FALSE)
                $editAvatarURL = FALSE;

            //Check to see if the variables are set, and if they are all true. If so, redirect to dashboard. Otherwise, re-send to editprofile
            if ($editFirstName && $editLastName && $editEmail && $editScreenName && $editPassword && $editBirthday && $editFavGame && $editGameType && $editPlayTime && $editBiography && $editAvatarURL)
                header("Location: ../editProfile.php?error=success");
            else
                header("Location: ../editProfile.php?error=db_error");

        } else {
            header("Location: ../editProfile.php?error=val_error");
        }
    }
}

?>