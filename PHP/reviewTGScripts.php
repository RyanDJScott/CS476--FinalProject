<?php
include_once(__DIR__ . 'database.php');

class submitReview {
    //Member variables
    private $gameTitle = NULL;
    private $UID = NULL;
    private $submittedBy = NULL;
    private $rating = NULL;
    private $review = NULL;
    private $recommend = NULL;
    private $avgAge = NULL;
    private $avgPlayTime = NULL;
    private $difficulty = NULL;
    private $numPlays = NULL;

    //Database variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Member functions

    public function __construct($game, $userID) {
        //Initialize the gameTitle and UID from passed params
        $this->gameTitle = $game;
        $this->UID = $userID;

        //Initialize the other variables via the POST method
        $this->rating = $_POST["reviewRating"];
        $this->numPlays = $_POST["reviewPlayers"];
        $this->avgAge = $_POST["reviewAge"];
        $this->avgPlayTime = $_POST["reviewPlaytime"];
        $this->numPlays = $_POST["reviewPlayedQuantity"];
        $this->difficulty = $_POST["reviewDifficulty"];
        $this->review = $_POST["reviewText"];

        //Initialize recommend to BOOL value
        if ($_POST["reviewRecommended"] === "YES")
            $this->recommend = TRUE;
        else if ($_POST["reviewRecommended"] === "NO")
            $this->recommend = FALSE;
        
        //Initialize db connection 
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Get the screenname of this user
        $screenNameQuery = "SELECT screenName FROM Users WHERE UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";

        //Execute query
        $screenNameResult = $this->dbConnect->query($screenNameQuery);

        if ($screenNameResult->num_rows > 0) {
            $resultRow = $screenNameResult->fetch_assoc();

            $this->submittedBy = $resultRow["UID"];
        } 
    }


    private function valSubmittedBy () {
        if (isset($this->submittedBy) && strlen($this->submittedBy) > 0)
            return TRUE;
        else
            return FALSE;
    }

    private function valRating () {
        if (isset($this->rating) && $this->rating >= 0 && $this->rating <= 10)
            return TRUE;
        else
            return FALSE;
    }

    private function valReview () {
        if (isset($this->review) && strlen($this->review) > 0)
            return TRUE;
        else
            return FALSE;
    }

    private function valRecommend () {
        if (isset($this->recommend))
            return TRUE;
        else
            return FALSE;
    }

    private function valAvgAge() {
        if (isset($this->avgAge) && $this->avgAge > 0 && $this->avgAge <= 100)
            return TRUE;
        else
            return FALSE;
    }

    private function valAvgPlayTime() {
        if (isset($this->avgPlayTime) && $this->avgPlayTime > 0)
            return TRUE;
        else
            return FALSE;
    }

    private function valDifficulty() {
        if (isset($this->difficulty) && ($this->difficulty === "Easy" || $this->difficulty === "Moderate" || $this->difficulty === "Difficult"))
            return TRUE;
        else
            return FALSE;
    }
    
    private function valNumPlays() {
        if (isset($this->numPlays) && $this->numPlays > 0)
            return TRUE;
        else
            return FALSE;
    }
}
?>