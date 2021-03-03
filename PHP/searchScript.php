<?php
//Include the searchStrategy class
include_once(__DIR__.'/searchStrategy.php');

//Function Name: getSearchOjbect()
//Purpose: To return a Search object based on the parameters given in the POST method
//Parameters: None
//Returns:
//   <1> A search object
//Side Effects: None
function getSearchObject() {
    //Sent by the post method, get the parameters
    $query = $_POST["searchInput"];
    $searchOption = "";

    

    //Figure out what kind of search
    if (isset($_POST["user"]) && $_POST["user"] == "USER") {
        if (isset($_POST["game"]) && $_POST["game"] == "GAME")
            $searchOption = "BOTH";
        else 
            $searchOption = "USER";
    } else if (isset($_POST["game"]) && $_POST["game"] == "GAME") {
        $searchOption = "GAME";
    }

    //If you have the required information, create the object
    return new Search($searchOption, $query);
}
?>