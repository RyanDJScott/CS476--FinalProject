<?php
//Include database definitions
include_once(__DIR__ . '/database.php');

class userSignup {
    //Member variables
    private $firstName = NULL;
    private $lastName = NULL;
    private $email = NULL;
    private $birthday = NULL;
    private $password = NULL;
    private $confirmPassword = NULL;
    private $screenName = NULL;
    private $avatarURL = NULL;
    private $biography = NULL;
    private $favGame = NULL;
    private $gameType = NULL;
    private $playTime = NULL;

    //Database variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Member functions

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

    // Function Name: submitSignupForm
    // Purpose: To insert this user into the database, provided all validation passes
    // Parameters: None
    // Returns: N/A
    // Side Effects:
    //   <1> If the validation passes, the information is inserted into the database.
    //       The user is directed to the login page if successful
    //   <2> If the validation failes, the user is redirected to the same page with an error message
    public function submitSignupForm() {
        if ($this->valFirstName() &&
            $this->valLastName() &&
            $this->valEmail() &&
            $this->valScreenName() && 
            $this->valPassword() && 
            $this->valBirthday() && 
            $this->valFavGame() &&
            $this->valGameType() &&
            $this->valBiography())
    }

    // Function Name: valFirstName
    // Purpose: To validate the information contained in $firstName
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the name passes validation
    //   <2> FALSE: If the name doesn't pass validation
    // Side Effects: None
    private function valFirstName() {
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
    private function valLastName() {
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
    private function valEmail() {
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
    private function valScreenName() {
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
    private function valPassword() {
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
    private function valBirthday() {
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
    private function valFavGame() {
        if (strlen($this->favGame) >= 0 && strlen($this->favGame) <= 60)
            return TRUE;
        else
            return FALSE;
    }

    // Functioan Name: favGameType
    // Purpose: To validate the information contained in $gameType
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $gameType passes validation
    //   <2> FALSE: If $gameType doesn't pass validation
    // Side Effects: None
    private function valGameType() {
        if (strlen($this->gameType) <= 30 && ($this->gameType === "Board Game" ||
            $this->gameType === "Card Game" ||
            $this->gameType === "Dice Game" ||
            $this->gameType === "Paper and Pencil Game" ||
            $this->gameType === "Role-Playing Game" ||
            $this->gameType === "Strategy Game" ||
            $this->gameType === "Tile-Based Game" ||
            $this->gameType === ""))

            return TRUE;
        else
            return FALSE;
    }

    // Functioan Name: favPlayTime
    // Purpose: To validate the information contained in $playTime
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $playTime passes validation
    //   <2> FALSE: If $playTime doesn't pass validation
    // Side Effects: None
    private function valPlayTime() {
        if (strlen($this->playTime) <= 9 && ($this->playTime === "0-1 years" ||
            $this->playTime === "1-3 years" ||
            $this->playTime === "3-6 years" ||
            $this->playTime === "6+ years"))

            return TRUE;
        else
            return FALSE;
    }

    // Functioan Name: favBiography
    // Purpose: To validate the information contained in $biography
    // Parameters: None
    // Returns:
    //   <1> TRUE: If $biography passes validation
    //   <2> FALSE: If $biography doesn't pass validation
    // Side Effects: None
    private function valBiography() {
        if (strlen($this->biography) >= 0 && strlen($this->biography) <= 500)
            return TRUE;
        else
            return FALSE;
    }

    //Image uploading functions
    private function setAvatarURL() {}

    
}

?>