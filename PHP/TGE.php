<?php
include_once(__DIR__ . '/database.php');
include_once(__DIR__ . '/review.php');

class TGE {
    //Member Variables
    //GameDescription variables pulled from the DB
    private $gameTitle = NULL;
    private $screenName = NULL;
    private $dateSubmitted = NULL;
    private $numPlayers = NULL;
    private $ageRating = NULL;
    private $playTime = NULL;
    private $description = NULL;
    private $company = NULL;
    private $expansions = NULL;
    
    //Overall rating (float) calculated from the DB
    private $overallRating = NULL;

    //Status information array pulled from the DB
    private $statusInfo = NULL;

    //Images array pulled from the DB
    private $images = NULL;

    //Array of reviews pulled from the DB
    private $gameReviews = NULL;

    //Database object for connection, mysqli object for the DB queries
    private $db = NULL;
    private $dbConnect = NULL;

    //Member Functions

    // Function Name: Constructor
    // Purpose: To construct the member variables
    // Parameters:
    //   <1> $gameTitle: The title of the game being constructed
    // Returns: N/A
    // Side Effects:
    //   <1> $entryInfo is initialized as an array with all game information
    //   <2> $images is initialized as an array with all picture URLs in it
    //   <3> $gameReviews is initialized as an array of review objects
    public function __construct(string $objGameTitle) {
        //Create new database object
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //----------------fill entryInfo variable--------------------//
        //Query the database to fill the entryInfo array
        $gameQuery = "SELECT GameDescriptions.gameTitle, Users.screenName, GameDescriptions.dateSubmitted, GameDescriptions.numPlayers, 
            GameDescriptions.ageRating, GameDescriptions.playTime, GameDescriptions.description, GameDescriptions.company, GameDescriptions.expansions, 
            GameDescriptionStatus.status, GameDescriptionStatus.reason
            FROM GameDescriptions INNER JOIN Users ON (GameDescriptions.UID = Users.UID)
            INNER JOIN GameDescriptionStatus ON (GameDescriptions.gameTitle = GameDescriptionStatus.gameTitle)
            WHERE GameDescriptions.gameTitle = '" . $this->dbConnect->real_escape_string($objGameTitle) . "'";

        //Query the database
        $queryResult = $this->dbConnect->query($gameQuery);

        //If the game exists, set the information for this object
        if ($queryResult->num_rows > 0) {
            //Fetch the information from the DB object
            $resultRows = $queryResult->fetch_assoc();

            //Put this information into the game description variables
            $this->gameTitle = $resultRows["gameTitle"];
            $this->screenName = $resultRows["screenName"];
            $this->dateSubmitted = $resultRows["dateSubmitted"];
            $this->numPlayers = $resultRows["numPlayers"];
            $this->ageRating = $resultRows["ageRating"];
            $this->playTime = $resultRows["playTime"];
            $this->description = $resultRows["description"];
            $this->company = $resultRows["company"];
            $this->expansions = $resultRows["expansions"];
        
            //Put the status information into the statusInfo variable
            $this->statusInfo = array(
                "status" => $resultRows["status"],
                "reason" => $resultRows["reason"]
            );
        }

        //---------------fill images variable-----------------------//
        //Query the database to fill the images array
        $imagesQuery = "SELECT pictureURL FROM DescriptionPics WHERE gameTitle = '" . $this->dbConnect->real_escape_string($objGameTitle) . "'";

        //Query the database
        $queryResult = $this->dbConnect->query($imagesQuery);

        //If the database doesn't yield any results, set this variable to FALSE
        if ($queryResult->num_rows > 0) {
            //Initialize $images as an array
            $this->images = array();

            //While there is a row to fetch from the result object
            while ($resultRows = $queryResult->fetch_assoc()) {
                $this->images[] = $resultRows["pictureURL"];
            }
        }

        //---------------fill reviews array-------------------------//
        //Query the database to fill the reviews array
        $reviewQuery = "SELECT gameTitle, UID FROM Reviews WHERE gameTitle = '" . $this->dbConnect->real_escape_string($objGameTitle) . "'";

        //Query the database
        $queryResult = $this->dbConnect->query($reviewQuery);

        //If the database doesn't yield any results, set this variable to FALSE
        if ($queryResult->num_rows > 0) {
            //Initialize $gameReviews to an array
            $this->gameReviews = array();

            //For each review, create a new review object and place into the array
            while ($resultRows = $queryResult->fetch_assoc()) {
                $this->gameReviews[] = new Review($resultRows["gameTitle"], $resultRows["UID"]);
            }
        }

        //------------set overall rating-----------------------------//
        //Query the database to get the avg rating for this game
        $ratingQuery = "SELECT AVG(rating) AS overallRating FROM Reviews WHERE gameTitle = '" . $this->dbConnect->real_escape_string($objGameTitle) . "'";

        //Execute the query
        $queryResult = $this->dbConnect->query($ratingQuery);

        //If the database doesn't yield any results, set this variable to FALSE
        if ($queryResult->num_rows > 0) {
            $resultRows = $queryResult->fetch_assoc();

            //Set the overallRating variable to the calculation done in the DB
            $this->overallRating = $resultRows["overallRating"];
        }
    }

    // Function Name: setGameTitle
    // Purpose: To set $gameTitle with the information given
    // Parameters: 
    //   <1> $title: The new title of the tabletop game
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $gameTitle is set to the new information contained in $title
    //   and updated in the database
    public function setGameTitle(string $title) {
        //Check to see if title is empty, return FALSE if it is empty
        if (!isset($title)) {
            return FALSE;
        } else {
            //Perform the update query
            $setGameTitle = "UPDATE GameDescriptions SET gameTitle = '" . $this->dbConnect->real_escape_string($title) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setGameTitle);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->gameTitle = $title;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getGameTitle
    // Purpose: To get the game title of this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->gameTitle 
    // Side Effects: N/A
    public function getGameTitle() {
        return $this->gameTitle;
    }

    // Function Name: getScreenName
    // Purpose: To get the screenname of the person who wrote this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->screenName 
    // Side Effects: N/A
    // Note: 
    //   <1> No setter required; it is not a function of the GameDescription table but rather the user who wrote it
    public function getScreenName () {
        return $this->screenName;
    }

    // Function Name: setDateSubmitted
    // Purpose: To set $dateSubmitted with the information given
    // Parameters: 
    //   <1> $date: The new submission date of the tabletop game
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $dateSubmitted is set to the new information contained in $date
    //   and updated in the database
    public function setDateSubmitted(object $date) {
        //Check to see if date is empty, return FALSE if it is empty
        if (!isset($date)) {
            return FALSE;
        } else {
            //Perform the update query
            $setDateSubmitted = "UPDATE GameDescriptions SET dateSubmitted = '" . $this->dbConnect->real_escape_string($date) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setDateSubmitted);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->dateSubmitted = $date;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getDateSubmitted
    // Purpose: To get the submission date for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->dateSubmitted
    // Side Effects: N/A
    public function getDateSubmitted() {
        return $this->dateSubmitted;
    }

    // Function Name: setNumPlayers
    // Purpose: To set $numPlayers with the information given
    // Parameters: 
    //   <1> $number: The number of players for this tabletop game entry
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $numPlayers is set to the new information contained in $number
    //   and updated in the database
    public function setNumPlayers(int $number) {
        //Check to see if number is empty, return FALSE if it is empty
        if (!isset($number)) {
            return FALSE;
        } else {
            //Perform the update query
            $setNumPlayers = "UPDATE GameDescriptions SET numPlayers = '" . $this->dbConnect->real_escape_string($number) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setNumPlayers);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->numPlayers = $number;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getNumPlayers
    // Purpose: To get the number of players for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->numPlayers
    // Side Effects: N/A
    public function getNumPlayers() {
        return $this->numPlayers;
    }

    // Function Name: setAgeRating
    // Purpose: To set $ageRating with the information given
    // Parameters: 
    //   <1> $age: The new age rating of the tabletop game entry
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $ageRating is set to the new information contained in $age
    //   and updated in the database
    public function setAgeRating(int $age) {
        //Check to see if age is empty, return FALSE if it is empty
        if (!isset($age)) {
            return FALSE;
        } else {
            //Perform the update query
            $setAgeRating = "UPDATE GameDescriptions SET ageRating = '" . $this->dbConnect->real_escape_string($age) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setAgeRating);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->ageRating = $age;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getAgeRating
    // Purpose: To get the age rating for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->ageRating
    // Side Effects: N/A
    public function getAgeRating() {
        return $this->ageRating;
    }

    // Function Name: setPlayTime
    // Purpose: To set $playTime with the information given
    // Parameters: 
    //   <1> $time: The new play time of this tabletop game entry
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $playTime is set to the new information contained in $time
    //   and updated in the database
    public function setPlayTime(float $time) {
        //Check to see if time is empty, return FALSE if it is empty
        if (!isset($time)) {
            return FALSE;
        } else {
            //Perform the update query
            $setPlayTime = "UPDATE GameDescriptions SET playTime = '" . $this->dbConnect->real_escape_string($time) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setPlayTime);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->playTime = $time;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getPlayTime
    // Purpose: To get the play time for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->playTime
    // Side Effects: N/A
    public function getPlayTime() {
        return $this->playTime;
    }

    // Function Name: setDescription
    // Purpose: To set $description with the information given
    // Parameters: 
    //   <1> $newDescription: The new description of this tabletop game entry
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $description is set to the new information contained in $newDescription
    //   and updated in the database
    public function setDescription (string $newDescription) {
        //Check to see if newDescription is empty, return FALSE if it is empty
        if (!isset($newDescription)) {
            return FALSE;
        } else {
            //Perform the update query
            $setDescription = "UPDATE GameDescriptions SET description = '" . $this->dbConnect->real_escape_string($newDescription) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setDescription);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->description = $newDescription;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getDescription
    // Purpose: To get the description for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->description
    // Side Effects: N/A
    public function getDescription () {
        return $this->description;
    }

    // Function Name: setCompany
    // Purpose: To set $company with the information given
    // Parameters: 
    //   <1> $newCompany: The new company that produced this tabletop game entry
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $company is set to the new information contained in $newCompany
    //   and updated in the database
    public function setCompany (string $newCompany) {
        //Check to see if newCompany is empty, return FALSE if it is empty
        if (!isset($newCompany)) {
            return FALSE;
        } else {
            //Perform the update query
            $setCompany = "UPDATE GameDescriptions SET company = '" . $this->dbConnect->real_escape_string($newCompany) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setCompany);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->company = $newCompany;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getCompany
    // Purpose: To get the producing company for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->company
    // Side Effects: N/A
    public function getCompany () {
        return $this->company;
    }

    // Function Name: setExpansions
    // Purpose: To set $expansions with the information given
    // Parameters: 
    //   <1> $numExpans: The number of expansions for this tabletop game entry
    // Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $expansions is set to the new information contained in $numExpans
    //   and updated in the database
    public function setExpansions (int $numExpans) {
        //Check to see if numExpans is empty, return FALSE if it is empty
        if (!isset($numExpans)) {
            return FALSE;
        } else {
            //Perform the update query
            $setExpansions = "UPDATE GameDescriptions SET expansions = '" . $this->dbConnect->real_escape_string($numExpans) . 
                "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($setExpansions);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->expansions = $numExpans;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getExpansions
    // Purpose: To get the number of expansions for this tabletop game entry
    // Parameters: N/A
    // Returns: 
    //   <1> $this->expansions
    // Side Effects: N/A
    public function getExpansions () {
        return $this->expansions;
    }

    // Function Name: setImages
    // Purpose: To set the $images array with image URLs
    // Parameters:
    //   <1> $imageURLs: An array containing all of the imageURLs to be set
    // Returns:
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $images is set to the new information contained in $imageURLs
    //   and updated in the database
    public function setImages(array $imageURLs) {
        //Determine if the imageURLs array is empty, if so return FALSE
        if (sizeof($imageURLs) == 0) {
            return FALSE;
        } else {
            //Perform a delete query for the old image URLs
            $deleteImages = "DELETE FROM DescriptionPics WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute query
            $deleteResults = $this->dbConnect->query($deleteImages);

            //If the delete worked, insert the new images
            if ($deleteResults === TRUE) {
                //Create a new images array to store the new image URLs
                $newImages = array();

                foreach ($imageURLs as $image)
                {
                    //Perform an insert query to insert new image URLs into the DB
                    $insertQuery = "INSERT INTO DescriptionPics (pictureURL, gameTitle) VALUES ('" . $this->dbConnect->real_escape_string($image) . "', '"
                        . $this->dbConnect->real_escape_string($this->gameTitle) . "')";
                    
                    //Execute the query
                    $insertResult = $this->dbConnect->query($insertQuery);

                    //If the query succeeded, continue. Otherwise, return FALSE and break
                    if ($insertResult === TRUE) {
                        $newImages[] = $image;
                        continue;
                    } else {
                        return FALSE;
                    }
                }

                //If loop finished without returning, it was successful
                //Overwrite the images array with the new images
                $this->images = $newImages;

                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    // Function Name: getImages
    // Purpose: To get the image URLs for this tabletop game
    // Parameters: N/A
    // Returns:
    //   <1> $this->images: an array containing all image URLs for this tabletop game entry
    // Side Effects: N/A
    public function getImages() {
        return $this->images;
    }
    
    // Function Name: setStatusInfo
    // Purpose: To set the $statusInfo array to the information contained in $status and $reason
    // Parameters:
    //   <1> $status: the status of the tabletop game entry
    //   <2> $reason: the reason why the entry was accepted/rejected
    // Returns:
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: The information was not updated in the DB
    // Side Effects: $statusInfo is set to the new information contained in $status and $reason
    //   and updated in the database
    public function setStatusInfo (int $status, string $reason) {
        //Check to see if status is empty, return FALSE if it is empty
        //Reason may be empty, no need to check
        if (!isset($status)) {
            return FALSE;
        } else {
            //Perform the update query
            $statusInfoQuery = "UPDATE GameDescriptionStatus SET status = '" . $this->dbConnect->real_escape_string($status) . 
                "', reason  = '" . $this->dbConnect->real_escape_string($reason) . "' WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

            //Execute the query
            $queryResult = $this->dbConnect->query($statusInfoQuery);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->statusInfo["status"] = $status;
                $this->statusInfo["reason"] = $reason;

                //Exit the function
                return TRUE;
            } else if ($queryResult === FALSE) {
                return FALSE;
            }
        }
    }

    // Function Name: getStatusInfo
    // Purpose: To get the status information for this tabletop game entry
    // Parameters: N/A
    // Returns:
    //   <1> $this->statusInfo: an array containing the status of this entry and reason for acceptance/rejection
    // Side Effects: N/A
    public function getStatusInfo () {
        return $this->statusInfo;
    }

    // Function Name: setOverallRating
    // Purpose: To recalculate the overall rating of this tabletop game entry
    // Parameters: None
    // Returns:
    //   <1> TRUE: The information was retrieved from the DB
    //   <2> FALSE: The information was retrieved from the DB
    // Side Effects: $overallRating is set to the new information obtained from the database
    public function setOverallRating () {
        //Query the database to get the avg rating for this game
        $ratingQuery = "SELECT AVG(rating) AS overallRating FROM Reviews WHERE gameTitle = '" . $this->dbConnect->real_escape_string($this->gameTitle) . "'";

        //Execute the query
        $queryResult = $this->dbConnect->query($ratingQuery);

        //If the database doesn't yield any results, set this variable to FALSE
        if ($queryResult->num_rows > 0) {
            $resultRows = $queryResult->fetch_assoc();

            //Set the overallRating variable to the calculation done in the DB
            $this->overallRating = $resultRows["overallRating"];

            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Function Name: getOverallRating
    // Purpose: To get the overall rating of this tabletop game entry
    // Parameters: N/A
    // Returns:
    //   <1> $this->overallRating
    // Side Effects: N/A
    public function getOverallRating () {
        return $this->overallRating;
    }

    // Function Name: getReviews
    // Purpose: To get the reviews for this tabletop game entry
    // Parameters: N/A
    // Returns:
    //   <1> $this->gameReviews
    // Side Effects: N/A
    public function getReviews () {
        return $this->gameReviews;
    }
}
?>