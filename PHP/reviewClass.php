<?php
    include 'database.php';

    class Review {
        //Member variables
        //Defining variables; not editable through this class
        private $gameTitle = NULL;
        private $UID = NULL;

        //Variables that define the review; editable through this class
        private $submittedBy = NULL;
        private $submitDate = NULL;
        private $rating = NULL;
        private $review = NULL;
        private $recommend = NULL;
        private $avgAge = NULL;
        private $avgPlayTime = NULL;
        private $difficulty = NULL;
        private $numPlays = NULL;
        private $flag = NULL;

        //Database variables
        private $db = NULL;
        private $dbConnect = NULL;

        //Member functions

        //Function Name: Constructor
        //Purpose: To construct a review object
        //Parameters:
        //   <1> $gameTitle: The title of the game being reviewed
        //   <2> $userID: The UID of the user who left the review
        //Returns: N/A
        //Side Effects:
        //   <1> $reviewInformation: initialized to an array containing all review info
        //   <2> $flagStatus: initialized to 0 or 1
        public function __construct($gameTitle, $UID) {
            //Create new database object
            $this->db = new database();
            $this->dbConnect = $this->db->getDBConnection();

            //Query DB for this specific review
            $reviewQuery = "SELECT submittedBy, submitDate, rating, review, recommend, avgAge, avgPlayTime, difficulty, numPlays, flag
                FROM Reviews WHERE gameTitle = '" . $this->dbConnect->real_escape_string($gameTitle) . "' 
                AND UID = '" . $this->dbConnect->real_escape_string($UID) . "'";
            
            //Execute query
            $reviewResults = $this->dbConnect->query($reviewQuery);

            //If the object exists, set the information for this object
            if (mysqli_num_rows($reviewResults) > 0) {
                //Fetch the information
                $resultRows = $reviewResults->fetch_assoc();

                //Set all the member variables to this information
                $this->submittedBy = $resultRows["submittedBy"];
                $this->submitDate = $resultRows["submitDate"];
                $this->rating = $resultRows["rating"];
                $this->review = $resultRows["review"];
                $this->recommend = $resultRows["recommend"];
                $this->avgAge = $resultRows["avgAge"];
                $this->avgPlayTime = $resultRows["avgPlayTime"];
                $this->difficulty = $resultRows["difficulty"];
                $this->numPlays = $resultRows["numPlays"];
                $this->flag = $resultRows["flag"];

                //Set the game title and UID for this review
                $this->gameTitle = $gameTitle;
                $this->UID = $UID;
            }
        }

        //Function Name: getGameTitle
        //Purpose: To get the value of $gameTitle
        //Parameters: N/A
        //Returns: 
        //   <1> $this->gameTitle
        //Side Effects: N/A
        public function getGameTitle () {}

        //Function Name: getUID
        //Purpose: To get the value of $UID
        //Parameters: N/A
        //Returns: 
        //   <1> $this->UID
        //Side Effects: N/A
        public function getUID () {}

        //Function Name: setSubmittedDate
        //Purpose: To set the value of $submittedDate
        //Parameters: 
        //   <1> $date: The new value of $submitDate
        //Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        //Side Effects: $submittedDate is set to the value of $date
        public function setSubmittedDate ($date) {}

        //Function Name: getSubmittedDate
        //Purpose: To get the value of $submittedDate
        //Parameters: N/A
        //Returns: 
        //   <1> $this->submittedDate
        //Side Effects: N/A
        public function getSubmittedDate () {}

        //Function Name: setSubmitDate
        //Purpose: To set the value of $submitDate
        //Parameters: 
        //   <1> $date: The new value of $submitDate
        //Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        //Side Effects: $submitDate is set to the value of $date
        public function setSubmitDate ($date) {}

        //Function Name: getSubmitDate
        //Purpose: To get the value of $submitDate
        //Parameters: N/A
        //Returns: 
        //   <1> $this->submitDate
        //Side Effects: N/A
        public function getSubmitDate () {}

        //Function Name: setRating
        //Purpose: To set the value of $rating
        //Parameters: 
        //   <1> $newRating: The new value of $rating
        //Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        //Side Effects: $rating is set to the value of $newRating
        public function setRating ($newRating) {}

        //Function Name: getRating
        //Purpose: To get the value of $rating
        //Parameters: N/A
        //Returns: 
        //   <1> $this->rating
        //Side Effects: N/A
        public function getRating () {}
        
        //Function Name: setReview
        //Purpose: To set the value of $review
        //Parameters: 
        //   <1> $newReview: The new value of $review
        //Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        //Side Effects: $review is set to the value of $newReview
        public function setReview ($newReview) {}

        //Function Name: getReview
        //Purpose: To get the value of $review
        //Parameters: N/A
        //Returns: 
        //   <1> $this->review
        //Side Effects: N/A
        public function getReview () {}

        //Function Name: setRecommend
        //Purpose: To set the value of $recommend
        //Parameters: 
        //   <1> $newRecommend: The new value of $recommend
        //Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        //Side Effects: $recommend is set to the value of $newRecommend
        public function setRecommend ($newRecommend) {}

        //Function Name: getRecommend
        //Purpose: To get the value of $recommend
        //Parameters: N/A
        //Returns: 
        //   <1> $this->recommend
        //Side Effects: N/A
        public function getRecommend () {}
        
        //Function Name: setAvgAge
        //Purpose: To set the value of $avgAge
        //Parameters: 
        //   <1> $age: The new value of $avgAge
        //Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        //Side Effects: $avgAge is set to the value of $age
        public function setAvgAge ($age) {}

        //Function Name: getAvgAge
        //Purpose: To get the value of $avgAge
        //Parameters: N/A
        //Returns: 
        //   <1> $this->avgAge
        //Side Effects: N/A
        public function getAvgAge () {}
        
        //Function Name: setAvgPlayTime
        //Purpose: To set the value of $avgPlayTime
        //Parameters: 
        //   <1> $playTime: The new value of $avgPlayTime
        //Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        //Side Effects: $avgPlayTime is set to the value of $playTime
        public function setAvgPlayTime ($playTime) {}

        //Function Name: getAvgPlayTime
        //Purpose: To get the value of $avgPlayTime
        //Parameters: N/A
        //Returns: 
        //   <1> $this->avgPlayTime
        //Side Effects: N/A
        public function getAvgPlayTime () {}

        //Function Name: setDifficulty
        //Purpose: To set the value of $difficulty
        //Parameters: 
        //   <1> $newDifficulty: The new value of $difficulty
        //Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        //Side Effects: $difficulty is set to the value of $newDifficulty
        public function setDifficulty ($newDifficulty) {}

        //Function Name: getDifficulty
        //Purpose: To get the value of $difficulty
        //Parameters: N/A
        //Returns: 
        //   <1> $this->difficulty
        //Side Effects: N/A
        public function getDifficulty () {}

        //Function Name: setNumPlays
        //Purpose: To set the value of $numPlays
        //Parameters: 
        //   <1> $numberPlays: The new value of $numPlays
        //Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        //Side Effects: $numPlays is set to the value of $numberPlays
        public function setNumPlays ($numberPlays) {}

        //Function Name: getNumPlays
        //Purpose: To get the value of $numPlays
        //Parameters: N/A
        //Returns: 
        //   <1> $this->numPlays
        //Side Effects: N/A
        public function getNumPlays () {}

        //Function Name: setFlag
        //Purpose: To set the value of $flagStatus
        //Parameters: 
        //   <1> $flagVal: The new value of $flag (0 or 1)
        //Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        //Side Effects: $flag is set to the value of $flagVal
        public function setFlag($flagVal) {}

        //Function Name: getFlag
        //Purpose: To get the value of $flagStatus
        //Parameters: N/A
        //Returns: 
        //   <1> $this->flag
        //Side Effects: N/A
        public function getFlag() {}      
    }
?>
