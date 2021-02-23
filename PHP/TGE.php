<?php
include 'dbCred.php';
include 'reviewClass.php';

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

    //Function Name: Constructor
    //Purpose: To construct the member variables
    //Parameters:
    //   <1> $gameTitle: The title of the game being constructed
    //Returns: N/A
    //Side Effects:
    //   <1> $entryInfo is initialized as an array with all game information
    //   <2> $images is initialized as an array with all picture URLs in it
    //   <3> $gameReviews is initialized as an array of review objects
    public function __construct($objGameTitle) {
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
            WHERE GameDescriptions.gameTitle = " . $this->dbConnect->real_escape_string($objGameTitle) . "";

        //Query the database
        $queryResult = $this->dbConnect->query($gameQuery);

        //If the game doesn't exist, set the variable to FALSE
        if (mysqli_num_rows($queryResult) > 0) {
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
        $imagesQuery = "SELECT pictureURL FROM DescriptionPics WHERE gameTitle = " . $this->dbConnect->real_escape_string($objGameTitle) . "";

        //Query the database
        $queryResult = $this->dbConnect->query($imagesQuery);

        //If the database doesn't yield any results, set this variable to false
        if (mysqli_num_rows($queryResult) > 0) {
            //Initialize $images as an array
            $this->images = array();

            //While there is a row to fetch from the result object
            while ($resultRows = $queryResult->fetch_assoc()) {
                $this->images[] = $resultRows["pictureURL"];
            }
        }

        //---------------fill reviews array-------------------------//
        //Query the database to fill the reviews array
        $reviewQuery = "SELECT gameTitle, UID FROM Reviews WHERE gameTitle = " . $this->dbConnect->real_escape_string($objGameTitle) . "";

        //Query the database
        $queryResult = $this->dbConnect->query($reviewQuery);

        //If the database doesn't yield any results, set this variable to false
        if (mysqli_num_rows($queryResult) > 0) {
            //Initialize $gameReviews to an array
            $this->gameReviews = array();

            //For each review, create a new review object and place into the array
            while ($resultRows = $queryResult->fetch_assoc()) {
                $this->gameReviews[] = new Review($resultRows["gameTitle"], $resultRows["UID"]);
            }
        }

        //------------set overall rating-----------------------------//
        //Query the database to get the avg rating for this game
        $ratingQuery = "SELECT AVG(rating) AS overallRating FROM Reviews WHERE gameTitle = " . $this->dbConnect->real_escape_string($objGameTitle) . "";

        //Execute the query
        $queryResult = $this->dbConnect->query($ratingQuery);

        //If the database doesn't yield any results, set this variable to false
        if (mysqli_num_rows($queryResult) > 0) {
            $resultRows = $queryResult->fetch_assoc();

            //Set the overallRating variable to the calculation done in the DB
            $this->overallRating = $resultRows["overallRating"];
        }
    }

    //Function Name: setGameTitle
    //Purpose: To set $gameTitle with the information given
    //Parameters: 
    //   <1> $title: The new title of the tabletop game
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $gameTitle is set to the new information contained in $title
    //   and updated in the database
    public function setGameTitle($title) {
        //Check to see if title is empty, return false if it is empty
        if (empty($title)) {
            return false;
        } else {
            //Perform the update query
            $setGameTitle = "UPDATE GameDescription SET gameTitle = " . $this->dbConnect->real_escape_string($title) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setGameTitle);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->gameTitle = $title;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getGameTitle
    //Purpose: To get the game title of this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->gameTitle 
    //Side Effects: N/A
    public function getGameTitle() {
        return $this->gameTitle;
    }

    //Function Name: setDateSubmitted
    //Purpose: To set $dateSubmitted with the information given
    //Parameters: 
    //   <1> $date: The new submission date of the tabletop game
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $dateSubmitted is set to the new information contained in $date
    //   and updated in the database
    public function setDateSubmitted($date) {
        //Check to see if title is empty, return false if it is empty
        if (empty($date)) {
            return false;
        } else {
            //Perform the update query
            $setDateSubmitted = "UPDATE GameDescription SET dateSubmitted = " . $this->dbConnect->real_escape_string($date) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setDateSubmitted);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->dateSubmitted = $date;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getDateSubmitted
    //Purpose: To get the submission date for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->dateSubmitted
    //Side Effects: N/A
    public function getDateSubmitted() {
        return $this->dateSubmitted;
    }

    //Function Name: setNumPlayers
    //Purpose: To set $numPlayers with the information given
    //Parameters: 
    //   <1> $number: The number of players for this tabletop game entry
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $numPlayers is set to the new information contained in $number
    //   and updated in the database
    public function setNumPlayers($number) {
        //Check to see if title is empty, return false if it is empty
        if (empty($number)) {
            return false;
        } else {
            //Perform the update query
            $setNumPlayers = "UPDATE GameDescription SET numPlayers = " . $this->dbConnect->real_escape_string($number) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setNumPlayers);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->numPlayers = $number;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getNumPlayers
    //Purpose: To get the number of players for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->numPlayers
    //Side Effects: N/A
    public function getNumPlayers() {
        return $this->numPlayers;
    }

    //Function Name: setAgeRating
    //Purpose: To set $ageRating with the information given
    //Parameters: 
    //   <1> $age: The new age rating of the tabletop game entry
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $ageRating is set to the new information contained in $age
    //   and updated in the database
    public function setAgeRating($age) {
        //Check to see if title is empty, return false if it is empty
        if (empty($age)) {
            return false;
        } else {
            //Perform the update query
            $setAgeRating = "UPDATE GameDescription SET ageRating = " . $this->dbConnect->real_escape_string($age) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setAgeRating);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->ageRating = $age;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getAgeRating
    //Purpose: To get the age rating for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->ageRating
    //Side Effects: N/A
    public function getAgeRating() {
        return $this->ageRating;
    }

    //Function Name: setPlayTime
    //Purpose: To set $playTime with the information given
    //Parameters: 
    //   <1> $time: The new play time of this tabletop game entry
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $playTime is set to the new information contained in $time
    //   and updated in the database
    public function setPlayTime($time) {
        //Check to see if title is empty, return false if it is empty
        if (empty($time)) {
            return false;
        } else {
            //Perform the update query
            $setPlayTime = "UPDATE GameDescription SET playTime = " . $this->dbConnect->real_escape_string($time) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setPlayTime);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->ageRating = $time;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getPlayTime
    //Purpose: To get the play time for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->playTime
    //Side Effects: N/A
    public function getPlayTime() {
        return $this->playTime;
    }

    //Function Name: setDescription
    //Purpose: To set $description with the information given
    //Parameters: 
    //   <1> $newDescription: The new description of this tabletop game entry
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $description is set to the new information contained in $newDescription
    //   and updated in the database
    public function setDescription ($newDescription) {
        //Check to see if title is empty, return false if it is empty
        if (empty($newDescription)) {
            return false;
        } else {
            //Perform the update query
            $setDescription = "UPDATE GameDescription SET description = " . $this->dbConnect->real_escape_string($newDescription) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setDescription);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->ageRating = $newDescription;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getDescription
    //Purpose: To get the description for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->description
    //Side Effects: N/A
    public function getDescription () {
        return $this->description;
    }

    //Function Name: setCompany
    //Purpose: To set $company with the information given
    //Parameters: 
    //   <1> $newCompany: The new company that produced this tabletop game entry
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $company is set to the new information contained in $newCompany
    //   and updated in the database
    public function setCompany ($newCompany) {
        //Check to see if title is empty, return false if it is empty
        if (empty($newCompany)) {
            return false;
        } else {
            //Perform the update query
            $setCompany = "UPDATE GameDescription SET ageRating = " . $this->dbConnect->real_escape_string($newCompany) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setCompany);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->ageRating = $newCompany;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getCompany
    //Purpose: To get the producing company for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->company
    //Side Effects: N/A
    public function getCompany () {
        return $this->company;
    }

    //Function Name: setExpansions
    //Purpose: To set $expansions with the information given
    //Parameters: 
    //   <1> $numExpans: The number of expansions for this tabletop game entry
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $expansions is set to the new information contained in $numExpans
    //   and updated in the database
    public function setExpansions ($numExpans) {
        //Check to see if title is empty, return false if it is empty
        if (empty($numExpans)) {
            return false;
        } else {
            //Perform the update query
            $setExpansions = "UPDATE GameDescription SET expansions = " . $this->dbConnect->real_escape_string($numExpans) . 
                "WHERE gameTitle = " . $this->dbConnect->real_escape_string($this->gameTitle) . "";

            //Execute the query
            $queryResult = $this->dbConnect->query($setExpansions);

            //See if the update worked
            if ($queryResult === TRUE) {
                //Update the object information
                $this->ageRating = $numExpans;

                //Exit the function
                return true;
            } else if ($queryResult === FALSE) {
                return false;
            }
        }
    }

    //Function Name: getExpansions
    //Purpose: To get the number of expansions for this tabletop game entry
    //Parameters: N/A
    //Returns: 
    //   <1> $this->expansions
    //Side Effects: N/A
    public function getExpansions () {
        return $this->expansions;
    }

    //Function Name: setImages
    //Purpose: To set the $images array with image URLs
    //Parameters:
    //   <1> $imageURLs: An array containing all of the imageURLs to be set
    //Returns:
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $images is set to the new information contained in $imageURLs
    //   and updated in the database
    public function setImages($imageURLs) {}

    //Function Name: getImages
    //Purpose: To get the image URLs for this tabletop game
    //Parameters: N/A
    //Returns:
    //   <1> $this->images: an array containing all image URLs for this tabletop game entry
    //Side Effects: N/A
    public function getImages() {
        return $this->images;
    }
    
    //Function Name: setStatusInfo
    //Purpose: To set the $statusInfo array to the information contained in $status and $reason
    //Parameters:
    //   <1> $status: the status of the tabletop game entry
    //   <2> $reason: the reason why the entry was accepted/rejected
    //Returns:
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $statusInfo is set to the new information contained in $status and $reason
    //   and updated in the database
    public function setStatusInfo ($status, $reason) {}

    //Function Name: getStatusInfo
    //Purpose: To get the status information for this tabletop game entry
    //Parameters: N/A
    //Returns:
    //   <1> $this->statusInfo: an array containing the status of this entry and reason for acceptance/rejection
    //Side Effects: N/A
    public function getStatusInfo () {
        return $this->statusInfo;
    }

    //Function Name: setOverallRating
    //Purpose: To recalculate the overall rating of this tabletop game enttry
    //Parameters: None
    //Returns:
    //   <1> True: The information was retrieved from the DB
    //   <2> False: The information was retrieved from the DB
    //Side Effects: $overallRating is set to the new information obtained from the database
    public function setOverallRating () {}

    //Function Name: getOverallRating
    //Purpose: To get the overall rating of this tabletop game entry
    //Parameters: N/A
    //Returns:
    //   <1> $this->overallRating
    //Side Effects: N/A
    public function getOverallRating () {
        return $this->overallRating;
    }

    //Function Name: displayTGE
    //Purpose: To display the contents of a tabletop game description on the viewTGE.php page
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description on the viewTGE.php page
    public function displayTGE() {}

    //Function Name: displayTGECard
    //Purpose: To display the contents of a tabletop game description as a mini-card
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description as a mini-card
    public function displayTGECard() {}

    //Function Name: displayTGEFeatureGameBox
    //Purpose: To display the contents of a tabletop game description as a feature game box
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description as a feature game box
    public function displayTGEFeatureGameBox() {}

}
?>