<?php

class TGE {
    //Member Variables
    private $entryInfo = NULL;
    private $images = NULL;
    private $gameReviews = NULL;
    private $statusInfo = NULL;
    private $overallRating = NULL;

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
    public function __construct($gameTitle) {
        //Include DB credentials
        include 'dbCred.php';
        include 'reviewClass.php';

        //Connect to the database
        $dbConnect = new mysqli($host, $userName, $userPW, $dbName);

        //----------------fill entryInfo variable--------------------//
        //Query the database to fill the entryInfo array
        $gameQuery = "SELECT GameDescriptions.gameTitle, Users.screenName, GameDescriptions.dateSubmitted, GameDescriptions.numPlayers, 
            GameDescriptions.ageRating, GameDescriptions.playTime, GameDescriptions.description, GameDescriptions.company, GameDescriptions.expansions, 
            GameDescriptionStatus.status, GameDescriptionStatus.reason
            FROM GameDescriptions INNER JOIN Users ON (GameDescriptions.UID = Users.UID)
            INNER JOIN GameDescriptionStatus ON (GameDescriptions.gameTitle = GameDescriptionStatus.gameTitle)
            WHERE GameDescriptions.gameTitle = " . $dbConnect->real_escape_string($gameTitle) . "";

        //Query the database
        $queryResult = $dbConnect->query($gameQuery);

        //If the game doesn't exist, set the variable to FALSE
        if ($queryResult === FALSE) {
            $entryInfo = FALSE;
        } else if (mysqli_num_rows($queryResult) > 0) {
            //Fetch the information from the DB object
            $resultRows = $queryResult->fetch_assoc();

            //Put this information into the entryInfo variable
            $entryInfo = array(
                "gameTitle" => $resultRows["gameTitle"],
                "screenName" => $resultRows["screenName"],
                "dateSubmitted" => $resultRows["dateSubmitted"],
                "numPlayers" => $resultRows["numPlayers"],
                "ageRating" => $resultRows["ageRating"],
                "playTime" => $resultRows["playTime"],
                "description" => $resultRows["description"],
                "company" => $resultRows["company"],
                "expanions" => $resultRows["expansions"]
            );

            //Put this information into the statusInfo variable
            $statusInfo = array(
                "status" => $resultRows["status"],
                "reason" => $resultRows["reason"]
            );
        }

        //---------------fill images variable-----------------------//
        //Query the database to fill the images array
        $imagesQuery = "SELECT pictureURL FROM DescriptionPics WHERE gameTitle = " . $dbConnect->real_escape_string($gameTitle) . "";

        //Query the database
        $queryResult = $dbConnect->query($imagesQuery);

        //If the database doesn't yield any results, set this variable to false
        if ($queryResult === FALSE) {
            $images = FALSE;
        } else if (mysqli_num_rows($queryResult) > 0) {
            //Initialize $images as an array
            $images = array();

            //While there is a row to fetch from the result object
            while ($resultRows = $queryResult->fetch_assoc()) {
                $images[] = $resultRows["pictureURL"];
            }
        }

        //---------------fill reviews array-------------------------//
        //Query the database to fill the reviews array
        $reviewQuery = "SELECT gameTitle, UID FROM Reviews WHERE gameTitle = " . $dbConnect->real_escape_string($gameTitle) . "";

        //Query the database
        $queryResult = $dbConnect->query($reviewQuery);

        //If the database doesn't yield any results, set this variable to false
        if ($queryResult === FALSE || mysqli_num_rows($queryResult) == 0) {
            $gameReviews = FALSE;
        } else if (mysqli_num_rows($queryResult) > 0) {
            //Initialize $gameReviews to an array
            $gameReviews = array();

            //For each review, create a new review object and place into the array
            while ($resultRows = $queryResult->fetch_assoc()) {
                $gameReviews[] = new Review($resultRows["gameTitle"], $resultRows["UID"]);
            }
        }

        //------------set overall rating-----------------------------//
    }

    //Function Name: setEntryInfo
    //Purpose: To set $entryInfo with the information given
    //Parameters: 
    //   <1> $gameInfo: An array containing the new information to be set
    //Returns: 
    //   <1> True: The information was updated in the DB
    //   <2> False: The information was not updated in the DB
    //Side Effects: $entryInfo is set to the new information contained in $gameInfo
    //   and updated in the database
    public function setEntryInfo($gameInfo) {}

    //Function Name: getEntryInfo
    //Purpose: To get the information for this tabletop game
    //Parameters: N/A
    //Returns: Returns $entryInfo as an array of all game information
    //Side Effects: N/A
    public function getEntryInfo() {}

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
    //   <1> $images: An array containing all image URLs
    //Side Effects: N/A
    public function getImages() {}

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