<?php
//Include database class for connection
include_once(__DIR__ . '/database.php');

class submitTGE {
    //Member variables
    private $UID = NULL;
    private $gameTitle = NULL;
    private $numPlayers = NULL;
    private $ageRating = NULL;
    private $playTime = NULL;
    private $description = NULL;
    private $company = NULL;
    private $expansions = NULL;
    private $images = NULL;

    //Database connection variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Member functions

    // Function Name: Constructor
    // Purpose: To intialize all class variables
    // Parameters: 
    //   <1> $userID: The UID of the user submitting this TGE
    // Returns: None
    // Side Effects:
    //   <1> The database member variables are initialized with a database connection
    //   <2> All member variables are initialized with the input to the fields
    public function __construct(int $userID) {
        //Initialize DB variables
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Initialize member variables 
        $this->UID = $userID;
        $this->gameTitle = trim($_POST["submitTGEName"]);
        $this->numPlayers = trim($_POST["submitTGEPlayers"]);
        $this->ageRating = trim($_POST["submitTGEAge"]);
        $this->playTime = (float)trim($_POST["submitTGEPlaytime"]);
        $this->description = trim($_POST["description"]);
        $this->company = trim($_POST["submitTGECompanyName"]);
        $this->expansions = trim($_POST["submitTGEExpansions"]);
    }

    private function valGameTitle () {
        if (is_string($this->gameTitle) && strlen($this->gameTitle) > 0 && strlen($this->gameTitle) <= 60)
            return TRUE;
        else
            return FALSE;
    }

    private function valNumPlayers () {
        if (is_int($this->numPlayers) && $this->numPlayers > 0 && $this->numPlayers < 20)
            return TRUE;
        else 
            return FALSE;
    }

    private function valAgeRating () {
        if (is_int($this->ageRating) && $this->ageRating > 0 && $this->ageRating < 19)
            return TRUE;
        else
            return FALSE;
    }

    private function valPlayTime () {
        if (is_float($this->playTime) && $this->playTime > 0)
            return TRUE;
        else
            return FALSE;
    }

    private function valDescription () {
        if (is_string($this->description) && strlen($this->description) > 0)
            return TRUE;
        else
            return FALSE;
    }

    private function valCompany () {
        if (is_string($this->company) && strlen($this->company) > 0 && strlen($this->company) <= 100)
            return TRUE;
        else
            return FALSE;
    }

    private function valExpansions () {
        if (is_int($this->expansions) && $this->expansions >= 0 && $this->expansions <= 30)
            return TRUE;
        else
            return FALSE;
    }

    private function uploadImages () {}

    public function submitForm() {}
}

?>