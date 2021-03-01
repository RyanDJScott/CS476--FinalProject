<?php

class Search {
    private $searchType = NULL;
    private $query = NULL;
    private $searchStrategy = NULL;
    
    //Function Name: Constructor
    //Purpose: Construct the member variables and choose the search strategy
    //   to implement
    //Parameters:
    //   <1> $searchOption: the option the user pressed for searching (USER, GAME, or BOTH)
    //   <2> $searchQuery: the query string to be submitted to the DB
    //Returns: N/A
    //Side Effects: assigns values to $searchType, $query, and instantiates an object
    //   to $searchStrategy
    public function __construct ($searchOption, $searchQuery) {
        //Construct member variables
        $searchType = $searchOption;
        $query = $searchQuery;

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
    //   <1> $query: the query string to be submitted to the DB
    //Returns: N/A
    //Side Effects: publishes the results of the query to the search page
    public function publishResults ($query) {
        return $this->searchStrategy->displayResults($this->searchStrategy->getResults($query));
    }
}

interface searchStrategy {
    //Member functions to be overridden by implementing classes
    public function getResults($query);
    public function displayResults($dbReturn);
}

class userSearch implements searchStrategy {
    //Function Name: getResults
    //Purpose: To collect the results of a user query from the DB
    //Parameters:
    //   <1> $query: the query string to be submitted to the DB
    //Returns: 
    //   <1> $dbReturn: An object that contains all of the retrieved information
    //Side Effects: N/A
    public function getResults($query) {}

    //Function Name: displayResults
    //Purpose: To display all of the users that were retrieved from the DB
    //Parameters:
    //   <1> $dbReturn: an object that contains all of the information retrieved from the DB
    //Returns: N/A
    //Side Effects: All of the DB information will be displayed on the website
    public function displayResults($dbReturn) {}
}

class gameSearch implements searchStrategy {
    //Function Name: getResults
    //Purpose: To collect the results of a game query from the DB
    //Parameters:
    //   <1> $query: the query string to be submitted to the DB
    //Returns: 
    //   <1> $dbReturn: An object that contains all of the retrieved information
    //Side Effects: N/A
    public function getResults($query) {}

    //Function Name: displayResults
    //Purpose: To display all of the games that were retrieved from the DB
    //Parameters:
    //   <1> $dbReturn: an object that contains all of the information retrieved from the DB
    //Returns: N/A
    //Side Effects: All of the DB information will be displayed on the website
    public function displayResults($dbReturn) {}
}

 class searchBoth implements searchStrategy {
     //Function Name: getResults
    //Purpose: To collect the results of a user+game query from the DB
    //Parameters:
    //   <1> $query: the query string to be submitted to the DB
    //Returns: 
    //   <1> $dbReturn: An object that contains all of the retrieved information
    //Side Effects: N/A
    public function getResults($query) {}

    //Function Name: displayResults
    //Purpose: To display all of the user+game that were retrieved from the DB
    //Parameters:
    //   <1> $dbReturn: an object that contains all of the information retrieved from the DB
    //Returns: N/A
    //Side Effects: All of the DB information will be displayed on the website
    public function displayResults($dbReturn) {}
 }

?>