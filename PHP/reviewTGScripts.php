<?php
include_once(__DIR__ . '/database.php');

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

    // Function Name: constructor
    // Purpose: To instantiate all member variables for this class
    // Parameters:
    //   <1> $game: The title of the game being reviewed
    //   <2> $userID: The UID of the user leaving this review
    // Returns: N/A
    // Side Effects:
    //   <1> gameTitle/UID are set to the values of $game, $userID
    //   <2> Database member variables are initialized with a DB connection
    //   <3> All other member variables initialized with POST method inputs
    public function __construct($game, $userID) {
        //Initialize the gameTitle and UID from passed params
        $this->gameTitle = $game;
        $this->UID = $userID;

        //Initialize the other variables via the POST method
        $this->rating = $_POST["reviewRating"];
        $this->numPlays = $_POST["reviewPlayedQuantity"];
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

            $this->submittedBy = $resultRow["screenName"];
        } 
    }

    // Function Name: valSubmittedBy
    // Purpose: To validate the information in submittedBy
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valSubmittedBy () {
        if (isset($this->submittedBy) && !empty($this->submittedBy) && strlen($this->submittedBy) > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valRating
    // Purpose: To validate the information in rating
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valRating () {
        if (isset($this->rating) && !empty($this->rating) && $this->rating >= 0 && $this->rating <= 10)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valReview
    // Purpose: To validate the information in review
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valReview () {
        if (isset($this->review) && !empty($this->review) && strlen($this->review) > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valRecommend
    // Purpose: To validate the information in recommend
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valRecommend () {
        if (isset($this->recommend) && !empty($this->recommend))
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valAvgAge
    // Purpose: To validate the information in avgAge
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valAvgAge() {
        if (isset($this->avgAge) && !empty($this->avgAge) && $this->avgAge > 0 && $this->avgAge <= 100)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: avgPlayTime
    // Purpose: To validate the information in avgPlayTime
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valAvgPlayTime() {
        if (isset($this->avgPlayTime) && !empty($this->avgPlayTime) && $this->avgPlayTime > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valDifficulty
    // Purpose: To validate the information in difficulty
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valDifficulty() {
        if (isset($this->difficulty) && !empty($this->difficulty) && ($this->difficulty === "Easy" || $this->difficulty === "Moderate" || $this->difficulty === "Difficult"))
            return TRUE;
        else
            return FALSE;
    }
    
    // Function Name: valNumPlays
    // Purpose: To validate the information in numPlays
    // Parameters: None
    // Returns:
    //   <1> TRUE: The input value passes validation
    //   <2> FALSE: The input value doesn't pass validation
    // Side Effects: N/A
    private function valNumPlays() {
        if (isset($this->numPlays) && !empty($this->numPlays) && $this->numPlays > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: submitForm
    // Purpose: To submit the review information into the DB
    // Parameters: None
    // Returns: N/A
    // Side Effects:
    //   <1> If the input fields pass validation, the review is submitted into the database and the use is taken to the viewTG.php page
    //   <2> If there is a DB error, the user is returned to the reviewTG.php page with an error
    //   <3> If the input fields don't pass validation, the user is returned to the reviewTG.php page with an error
    public function submitForm() {
        //Check that all input information passes validation
        if ($this->valSubmittedBy() && $this->valRating() && $this->valReview() && $this->valRecommend() && $this->valAvgAge() && $this->valAvgPlayTime() && $this->valDifficulty() && $this->valNumPlays()) {
            //Build an insert query into the DB
            $reviewQuery = "INSERT INTO Reviews (gameTitle, UID, submittedBy, submitDate, rating, review, recommend, avgAge, avgPlayTime, difficulty, numPlays, flag) VALUES ('" . $this->dbConnect->real_escape_string($this->gameTitle) . "'
            , '" . $this->dbConnect->real_escape_string($this->UID) . "', '" . $this->dbConnect->real_escape_string($this->submittedBy) . "', CURRENT_DATE(), '" . $this->dbConnect->real_escape_string($this->rating) . "'
            , '" . $this->dbConnect->real_escape_string($this->review) . "', '" . $this->dbConnect->real_escape_string($this->recommend) . "', '" . $this->dbConnect->real_escape_string($this->avgAge) . "'
            , '" . $this->dbConnect->real_escape_string($this->avgPlayTime) . "', '" . $this->dbConnect->real_escape_string($this->difficulty) . "', '" . $this->dbConnect->real_escape_string($this->numPlays) . "'
            , 0)";

            //Execute query
            $reviewResults = $this->dbConnect->query($reviewQuery);

            //If it worked, redirect back to the viewTG.php page, otherwise return to current page with error
            if ($reviewResults)
                header("Location: viewTG.php?gameTitle=" . $this->gameTitle . "");
            else
                header("Location: reviewTG.php?gameTitle=" . $this->gameTitle . "&error=db_error");
        } else {
            //Forms did not pass validation, return with error
            header("Location: reviewTG.php?gameTitle=" . $this->gameTitle . "&error=val_error");
        }
    }
}
?>