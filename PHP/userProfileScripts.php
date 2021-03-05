<?php
//Include database definitions
include_once(__DIR__ . '/database.php');

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
        else {
            error_log("firstName error triggered", 0);
            return FALSE;
        }
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
        else {
            error_log("lastName error triggered", 0);
            return FALSE;
        }
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
        else {
            error_log("email error triggered", 0);
            return FALSE;
        }
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
        else {
            error_log("screenName error triggered", 0);
            return FALSE;
        }
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
        else {
            error_log("password error triggered", 0);
            return FALSE;
        }
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
            
            $dateTest = getdate($this->birthday);

            if ($dateTest["year"] > 0 && $dateTest["mon"] > 0 && $dateTest["mday"] > 0)
                return TRUE;
            else {
                error_log("birthday error triggered", 0);
                return FALSE;
            }
        } else {
            error_log("birthday error triggered", 0);
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
        else {
            error_log("favGame error triggered", 0);
            return FALSE;
        }
    }

    // Function Name: favGameType
    // Purpose: To validate the information contained in $gameType
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $gameType passes validation
    //   <2> FALSE: If $gameType doesn't pass validation
    // Side Effects: None
    protected function valGameType() {
        if (strlen($this->gameType) <= 30 && ($this->gameType === "Board Game" ||
            $this->gameType === "Card Game" ||
            $this->gameType === "Dice Game" ||
            $this->gameType === "Paper and Pencil Game" ||
            $this->gameType === "Role-Playing Game" ||
            $this->gameType === "Strategy Game" ||
            $this->gameType === "Tile-Based Game" ||
            $this->gameType === "")) {

            error_log("" . $this->gameType . " entered.", 0);

            return TRUE; }
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
        if (strlen($this->playTime) <= 9 && ($this->playTime === "0-1 years" ||
            $this->playTime === "1-3 years" ||
            $this->playTime === "3-6 years" ||
            $this->playTime === "6+ years")) {
            error_log("" . $this->playTime . " entered.", 0);
            return TRUE; }
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
        else {
            error_log("Biography error triggered.", 0);
            return FALSE;
        }
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
        if (!isset($_FILES['signupPic']['error'])) {
            $this->avatarURL = "/uploads/userPictures/defaultPic.png";
            error_log("No file uploaded, default inserted", 0);
            return TRUE;
        }
        
        //If the user is trying to sneak multiple files, return false
        if (is_array($_FILES['signupPic']['error'])) {
            error_log("User trying to insert multiple files.", 0);
            return FALSE;
        }

        //If there was an upload error, return false
        switch ($_FILES['signupPic']['error']) {
            case UPLOAD_ERR_OK:
                error_log("No errors during upload", 0);
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->avatarURL = "/uploads/userPictures/defaultPic.png";
                error_log("No file uploaded, default inserted", 0);
                return TRUE;
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                error_log("Error: Size too big", 0);
                return FALSE;
                break;
            default:
                error_log("Unknown error", 0);
                return FALSE;
        }

        //If the file size is greater than 10 MB
        if ($_FILES['signupPic']['size'] > 10485760) {
            error_log("File larger than 10 MB", 0);
            return FALSE;
        }

        //Check to see if it's an actual image by checking the file info object
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if (false === $ext = array_search(
            $finfo->file($_FILES['signupPic']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),true)) {
                error_log("File is not an image", 0);
                return FALSE;
            } 

        //Prepare the URL incase the file upload works
        $filePath = "/uploads/userPics/" . sha1_file($_FILES["signupPic"]["tmp_name"]) . "." . $ext . "";

        //Try to move the file to the uploads folder
        if (!move_uploaded_file($_FILES['signupPic']['tmp_name'],
            sprintf(
                __DIR__ . '/../uploads/userPictures/%s.%s',
                sha1_file($_FILES['signupPic']['tmp_name']),
                $ext
            )
        )) {
            error_log("File wasn't moved to the correct folder", 0);
            return FALSE;
        } else {
            $this->avatarURL = $filePath;
            error_log("avatarURL = " . $this->avatarURL . "", 0);
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
    public function submitForm() {

    }
}

?>