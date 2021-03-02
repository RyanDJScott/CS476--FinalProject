<?php
include './database.php';

class Search {
    //Member variables
    private $query = NULL;
    private $searchStrategy = NULL;
    
    //Database variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Function Name: Constructor
    //Purpose: Construct the member variables and choose the search strategy
    //   to implement
    //Parameters:
    //   <1> $searchOption: the option the user pressed for searching (USER, GAME, or BOTH)
    //   <2> $searchQuery: the query string to be submitted to the DB
    //Returns: N/A
    //Side Effects: assigns values to $query, connects to the DB, and instantiates an object to $searchStrategy
    public function __construct (string $searchOption, string $searchQuery) {
        //Construct member variables
        $this->query = $searchQuery;

        //Construct DB variables
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Choose a search strategy
        switch (strtoupper($searchOption))
        {
            case "USER":
                $this->searchStrategy = new userSearch();
                break;
            case "GAME":
                $this->searchStrategy = new gameSearch();
                break;
            case "BOTH":
                $this->searchStrategy = new searchBoth();
        }
    }

    //Function Name: publishResults
    //Purpose: To publish the results of the string to the search page
    //Parameters: 
    //   <1> getResults(dbConnect, query): array of results returned from the database
    //Returns: N/A
    //Side Effects: 
    //   <1> Publishes the results of the query to the search page. Diplay depends on search strategy
    public function publishResults () {
        return $this->searchStrategy->displayResults($this->searchStrategy->getResults($this->dbConnect, $this->query));
    }
}

interface searchStrategy {
    //Member functions to be overridden by implementing classes
    public function getResults(mysqli $dbConnect, string $query);
    public function displayResults(array $dbReturn);
}

class userSearch implements searchStrategy {
    //Function Name: getResults
    //Purpose: To collect the results of a user query from the DB
    //Parameters:
    //   <1> $dbConnect: the database connection mysqli object
    //   <2> $query: the query string to be submitted to the DB
    //Returns: 
    //   <1> $dbReturn: An array that contains all of the retrieved information
    //Side Effects: N/A
    public function getResults(mysqli $dbConnect, string $query) {
        //Create search query
        $userSearchQuery = "SELECT UID, screenName, avatarURL FROM Users WHERE MATCH (firstName, lastName, screenName, favGame) AGAINST ('" . $dbConnect->real_escape_string($query) . "')";

        //Execute query
        $userResults = $dbConnect->query($userSearchQuery);

        //Create a new array
        $dbReturn = array();

        //If there are results, return them
        if (mysqli_num_rows($userResults) > 0) {
            //Put each row into the new array
            while ($resultRows = mysqli_fetch_assoc($userResults)) {
                $dbReturn[] = $resultRows;
            }
        }

        //Return the search results array
        return $dbReturn; 
    }

    //Function Name: displayResults
    //Purpose: To display all of the users that were retrieved from the DB
    //Parameters:
    //   <1> $dbReturn: an array that contains all of the information retrieved from the DB
    //Returns: N/A
    //Side Effects: All of the DB information will be displayed on the website
    public function displayResults(array $dbReturn) {}
}

class gameSearch implements searchStrategy {
    //Function Name: getResults
    //Purpose: To collect the results of a game query from the DB
    //Parameters:
    //   <1> $dbConnect: the database connection mysqli object
    //   <2> $query: the query string to be submitted to the DB
    //Returns: 
    //   <1> $dbReturn: An array that contains all of the retrieved information
    //Side Effects: N/A
    public function getResults(mysqli $dbConnect, string $query) {
        //Create search query
        $gameSearchQuery = "SELECT gameTitle FROM GameDescriptions WHERE MATCH (gameTitle, description, company) AGAINST ('" . $dbConnect->real_escape_string($query) . "')";

        //Execute query
        $gameResults = $dbConnect->query($gameSearchQuery);

        //Create a new array
        $dbReturn = array();

        //If there are results, return them
        if (mysqli_num_rows($gameResults) > 0) {
            //Get an image for this game
            while ($resultRows1 = mysqli_fetch_assoc($gameResults)) {
                //Execute another query to get a single image for this game
                $gameObjQuery = "SELECT GameDescriptions.gameTitle, DescriptionPics.pictureURL FROM GameDescriptions INNER JOIN DescriptionPics ON (GameDescriptions.gameTitle = DescriptionPics.gameTitle) INNER JOIN GameDescriptionStatus ON (GameDescriptions.gameTitle = GameDescriptionStatus.gameTitle) WHERE GameDescriptions.gameTitle = '" . $dbConnect->real_escape_string($resultRows1["gameTitle"]) . "' AND GameDescriptionStatus.status = 1 LIMIT 1";

                //Execute query
                $gameObjResults = $dbConnect->query($gameObjQuery);

                //If there are results, put the game title and one image in the array
                if (mysqli_num_rows($gameObjResults) > 0) {
                    while ($resultRows2 = mysqli_fetch_assoc($gameObjResults)) {
                        $dbReturn[] = $resultRows2;
                    }
                }
            }
        }

        //Return the search results array
        return $dbReturn;
    }

    //Function Name: displayResults
    //Purpose: To display all of the games that were retrieved from the DB
    //Parameters:
    //   <1> $dbReturn: an object that contains all of the information retrieved from the DB
    //Returns: N/A
    //Side Effects: All of the DB information will be displayed on the website
    public function displayResults(array $dbReturn) {}
}

 class searchBoth implements searchStrategy {
     //Function Name: getResults
    //Purpose: To collect the results of a user+game query from the DB
    //Parameters:
    //   <1> $dbConnect: the database connection mysqli object
    //   <2> $query: the query string to be submitted to the DB
    //Returns: 
    //   <1> $dbReturn: An array that contains all of the retrieved information
    //Side Effects: N/A
    public function getResults(mysqli $dbConnect, string $query) {
        //Create the array that will hold the results
        $dbReturn = array("users" => array(), "games" => array());

        //Execute the user search
        $userSearchQuery = "SELECT UID, screenName, avatarURL FROM Users WHERE MATCH (firstName, lastName, screenName, favGame) AGAINST ('" . $dbConnect->real_escape_string($query) . "')";

        //Execute query
        $userResults = $dbConnect->query($userSearchQuery);

        //If there are results, return them
        if (mysqli_num_rows($userResults) > 0) {
            //Put each row into the new array
            while ($resultRows = mysqli_fetch_assoc($userResults)) {
                $dbReturn["users"][] = $resultRows;
            }
        }

        //Execute game search
        $gameSearchQuery = "SELECT gameTitle FROM GameDescriptions WHERE MATCH (gameTitle, description, company) AGAINST ('" . $dbConnect->real_escape_string($query) . "')";

        //Execute query
        $gameResults = $dbConnect->query($gameSearchQuery);

        //If there are results, return them
        if (mysqli_num_rows($gameResults) > 0) {
            //Get an image for this game
            while ($resultRows1 = mysqli_fetch_assoc($gameResults)) {
                //Execute another query to get a single image for this game
                $gameObjQuery = "SELECT GameDescriptions.gameTitle, DescriptionPics.pictureURL FROM GameDescriptions INNER JOIN DescriptionPics ON (GameDescriptions.gameTitle = DescriptionPics.gameTitle) INNER JOIN GameDescriptionStatus ON (GameDescriptions.gameTitle = GameDescriptionStatus.gameTitle) WHERE GameDescriptions.gameTitle = '" . $dbConnect->real_escape_string($resultRows1["gameTitle"]) . "' AND GameDescriptionStatus.status = 1 LIMIT 1";

                //Execute query
                $gameObjResults = $dbConnect->query($gameObjQuery);

                //If there are results, put the game title and one image in the array
                if (mysqli_num_rows($gameObjResults) > 0) {
                    while ($resultRows2 = mysqli_fetch_assoc($gameObjResults)) {
                        $dbReturn["games"][] = $resultRows2;
                    }
                }
            }
        }

        //Return the object
        return $dbReturn;
    }

    //Function Name: displayResults
    //Purpose: To display all of the user+game that were retrieved from the DB
    //Parameters:
    //   <1> $dbReturn: an object that contains all of the information retrieved from the DB
    //Returns: N/A
    //Side Effects: All of the DB information will be displayed on the website
    public function displayResults(array $dbReturn) {}
 }

?>