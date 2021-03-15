<?php
    include_once(__DIR__ . '/database.php');

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

        // Function Name: Constructor
        // Purpose: To construct a review object
        // Parameters:
        //   <1> $gameTitle: The title of the game being reviewed
        //   <2> $userID: The UID of the user who left the review
        // Returns: N/A
        // Side Effects:
        //   <1> $reviewInformation: initialized to an array containing all review info
        //   <2> $flagStatus: initialized to 0 or 1
        public function __construct(string $objGameTitle, int $reviewerUID) {
            //Create new database object
            $this->db = new database();
            $this->dbConnect = $this->db->getDBConnection();

            //Query DB for this specific review
            $reviewQuery = "SELECT submittedBy, submitDate, rating, review, recommend, avgAge, avgPlayTime, difficulty, numPlays, flag
                FROM Reviews WHERE gameTitle = '" . $this->dbConnect->real_escape_string($objGameTitle) . "'
                AND UID = '" . $this->dbConnect->real_escape_string($reviewerUID) . "'";
            
            //Execute query
            $reviewResults = $this->dbConnect->query($reviewQuery);

            //If the object exists, set the information for this object
            if ($reviewResults->num_rows > 0) {
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
                $this->gameTitle = $objGameTitle;
                $this->UID = $reviewerUID;
            } 
        }

        // Function Name: getGameTitle
        // Purpose: To get the value of $gameTitle
        // Parameters: N/A
        // Returns: 
        //   <1> $this->gameTitle
        // Side Effects: N/A
        public function getGameTitle () {
            return $this->gameTitle;
        }

        // Function Name: getUID
        // Purpose: To get the value of $UID
        // Parameters: N/A
        // Returns: 
        //   <1> $this->UID
        // Side Effects: N/A
        public function getUID () {
            return $this->UID;
        }

        // Function Name: getSubmittedDBy
        // Purpose: To get the value of $submittedBy
        // Parameters: N/A
        // Returns: 
        //   <1> $this->submittedBy
        // Side Effects: N/A
        // Note: 
        //   <1> No setter, should not be manipulated by this class
        public function getSubmittedBy () {
            return $this->submittedBy;
        }

        // Function Name: setSubmitDate
        // Purpose: To set the value of $submitDate
        // Parameters: 
        //   <1> $date: The new value of $submitDate
        // Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        // Side Effects: $submitDate is set to the value of $date
        public function setSubmitDate (object $date) {
            //Check to see if date is set
            if (!isset($date)) {
                return FALSE;
            } else {
                //Write an update query
                $submitDateQuery = "UPDATE Reviews SET submitDate = '" . $this->dbConnect->real_escape_string($date) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($submitDateQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->submitDate = $date;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getSubmitDate
        // Purpose: To get the value of $submitDate
        // Parameters: N/A
        // Returns: 
        //   <1> $this->submitDate
        // Side Effects: N/A
        public function getSubmitDate () {
            return $this->submitDate;
        }

        // Function Name: setRating
        // Purpose: To set the value of $rating
        // Parameters: 
        //   <1> $newRating: The new value of $rating
        // Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        // Side Effects: $rating is set to the value of $newRating
        public function setRating (float $newRating) {
            //Check to see if date is set
            if (!isset($newRating)) {
                return FALSE;
            } else {
                //Write an update query
                $ratingQuery = "UPDATE Reviews SET rating = '" . $this->dbConnect->real_escape_string($newRating) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($ratingQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->rating = $newRating;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getRating
        // Purpose: To get the value of $rating
        // Parameters: N/A
        // Returns: 
        //   <1> $this->rating
        // Side Effects: N/A
        public function getRating () {
            return $this->rating;
        }
        
        // Function Name: setReview
        // Purpose: To set the value of $review
        // Parameters: 
        //   <1> $newReview: The new value of $review
        // Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        // Side Effects: $review is set to the value of $newReview
        public function setReview (string $newReview) {
            //Check to see if date is set
            if (!isset($newReview)) {
                return FALSE;
            } else {
                //Write an update query
                $reviewQuery = "UPDATE Reviews SET review = '" . $this->dbConnect->real_escape_string($newReview) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($reviewQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->review = $newReview;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getReview
        // Purpose: To get the value of $review
        // Parameters: N/A
        // Returns: 
        //   <1> $this->review
        // Side Effects: N/A
        public function getReview () {
            return $this->review;
        }

        // Function Name: setRecommend
        // Purpose: To set the value of $recommend
        // Parameters: 
        //   <1> $newRecommend: The new value of $recommend
        // Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        // Side Effects: $recommend is set to the value of $newRecommend
        public function setRecommend (bool $newRecommend) {
            //Check to see if date is set
            if (!isset($newRecommend)) {
                return FALSE;
            } else {
                //Write an update query
                $recommendQuery = "UPDATE Reviews SET recommend = '" . $this->dbConnect->real_escape_string($newRecommend) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($recommendQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->recommend = $newRecommend;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getRecommend
        // Purpose: To get the value of $recommend
        // Parameters: N/A
        // Returns: 
        //   <1> $this->recommend
        // Side Effects: N/A
        public function getRecommend () {
            return $this->recommend;
        }
        
        // Function Name: setAvgAge
        // Purpose: To set the value of $avgAge
        // Parameters: 
        //   <1> $age: The new value of $avgAge
        // Returns:
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was not updated in the DB
        // Side Effects: $avgAge is set to the value of $age
        public function setAvgAge (int $age) {
            //Check to see if date is set
            if (!isset($age)) {
                return FALSE;
            } else {
                //Write an update query
                $ageQuery = "UPDATE Reviews SET avgAge = '" . $this->dbConnect->real_escape_string($age) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($ageQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->avgAge = $age;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getAvgAge
        // Purpose: To get the value of $avgAge
        // Parameters: N/A
        // Returns: 
        //   <1> $this->avgAge
        // Side Effects: N/A
        public function getAvgAge () {
            return $this->avgAge;
        }
        
        // Function Name: setAvgPlayTime
        // Purpose: To set the value of $avgPlayTime
        // Parameters: 
        //   <1> $playTime: The new value of $avgPlayTime
        // Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        // Side Effects: $avgPlayTime is set to the value of $playTime
        public function setAvgPlayTime (float $playTime) {
            //Check to see if date is set
            if (!isset($playTime)) {
                return FALSE;
            } else {
                //Write an update query
                $playTimeQuery = "UPDATE Reviews SET avgPlayTime = '" . $this->dbConnect->real_escape_string($playTime) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($playTimeQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->avgPlayTime = $playTime;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getAvgPlayTime
        // Purpose: To get the value of $avgPlayTime
        // Parameters: N/A
        // Returns: 
        //   <1> $this->avgPlayTime
        // Side Effects: N/A
        public function getAvgPlayTime () {
            return $this->avgPlayTime;
        }

        // Function Name: setDifficulty
        // Purpose: To set the value of $difficulty
        // Parameters: 
        //   <1> $newDifficulty: The new value of $difficulty
        // Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        // Side Effects: $difficulty is set to the value of $newDifficulty
        public function setDifficulty (string $newDifficulty) {
            //Check to see if date is set
            if (!isset($newDifficulty)) {
                return FALSE;
            } else {
                //Write an update query
                $difficultyQuery = "UPDATE Reviews SET difficulty = '" . $this->dbConnect->real_escape_string($newDifficulty) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($difficultyQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->difficulty = $newDifficulty;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getDifficulty
        // Purpose: To get the value of $difficulty
        // Parameters: N/A
        // Returns: 
        //   <1> $this->difficulty
        // Side Effects: N/A
        public function getDifficulty () {
            return $this->difficulty;
        }

        // Function Name: setNumPlays
        // Purpose: To set the value of $numPlays
        // Parameters: 
        //   <1> $numberPlays: The new value of $numPlays
        // Returns:
        //   <1> True: If the information was updated in the DB
        //   <2> False: If the information was not updated in the DB
        // Side Effects: $numPlays is set to the value of $numberPlays
        public function setNumPlays (int $numberPlays) {
            //Check to see if date is set
            if (!isset($numberPlays)) {
                return FALSE;
            } else {
                //Write an update query
                $numPlaysQuery = "UPDATE Reviews SET numPlays = '" . $this->dbConnect->real_escape_string($numberPlays) . "
                    ' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "' AND UID = '" . $this->dbConnect->real_escape_string($this->UID) . "'";
                
                //Execute query
                $queryResults = $this->dbConnect->query($numPlaysQuery);

                //See if the update worked
                if ($queryResults === TRUE) {
                    //Update the object variable
                    $this->numPlays = $numberPlays;

                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        // Function Name: getNumPlays
        // Purpose: To get the value of $numPlays
        // Parameters: N/A
        // Returns: 
        //   <1> $this->numPlays
        // Side Effects: N/A
        public function getNumPlays () {
            return $this->numPlays;
        }

        // Function Name: getFlag
        // Purpose: To get the value of $flagStatus
        // Parameters: N/A
        // Returns: 
        //   <1> $this->flag
        // Side Effects: N/A
        //Note: 
        //   <1> No setter; only logged in users can set a flag
        public function getFlag() {
            return $this->flag;
        }      
    }
?>
