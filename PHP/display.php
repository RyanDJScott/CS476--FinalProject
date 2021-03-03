<?php
//Include all class dependencies
include_once(__DIR__ . '/TGE.php');
include_once(__DIR__ . '/review.php');
include_once(__DIR__ . '/userFactory.php');
include_once(__DIR__ . '/database.php');

//Implement display class
class Display {
    //Database variables
    private $db = NULL;
    private $dbConnect = NULL;
 
    public function __construct() {
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();
    }
    
    //Utility Member Functions
    
    //Function Name: limitChars
    //Purpose: To truncate the text to a specific length and append '...' to the end of the string
    //Parameters: 
    //   <1> $text: the string to be appended
    //   <2> $length: the length of the string you want returned with "..." appended to it
    //Returns: 
    //   <1> $text: if the string's length is <= length
    //   <2> $newString: the substring of length $length with "..." appended to it
    //Side Effects: None
    private function limitChars ($text, $length) {
        //If the string is already short enough, return it
        if (strlen($text) <= $length) {
            return $text;
        } else {
            //Create a new string the size of $length, append "..."
            $newString = substr($text, 0, $length) . "...";

            //Return this new string
            return $newString;
        }
    }

    //-----------------index.php display functions--------------------//
    public function displayAllGames() {
        //Get all of the games from the DB
        $allGamesQuery = "SELECT gameTitle FROM GameDescriptionStatus WHERE status = 1 OR status = 2 OR status = 0";

        //Execute the query
        $allGamesResult = $this->dbConnect->query($allGamesQuery);

        //Create an array to hold all of the objects
        $newGame = array();

        //For each of the results, create an object and store it in the newGame array
        if (mysqli_num_rows($allGamesResult) > 0) {
            while ($resultRows = mysqli_fetch_assoc($allGamesResult)) {
                $newGame[] = new TGE($resultRows["gameTitle"]);
            }
        }

        //If the newGame array is not empty (i.e. there are no results)
        if (sizeof($newGame) != 0) {
            //While there are still games to display
            while (sizeof($newGame) != 0) {
                //Set a counter to enforce three per row
                $counter = 0;

                //Print a row container
                echo '<div class="rowContainer">';

                //While there is room for 1 more game box (3 max)
                //While there are still games to display
                while ($counter <= 3 && sizeof($newGame) != 0) {
                    //Display the card for this TGE
                    $this->displayTGECard($newGame[0]);

                    //Remove this TGE from the array
                    array_shift($newGame);

                    //Increment the counter
                    $counter++;
                }

                //Close the row div so we can start a new one after 3 are printed
                echo '</div>';
            }
        } else {
            //Echo an error statement
            echo '<div class="rowContainer"><p>There are no games on the site yet! Sign up and submit!</div>';
        }
    }

    //Function Name: displayTGECard
    //Purpose: To display the contents of a tabletop game description as a mini-card
    //Parameters: 
    //   <1> $TGE: a tabletop game entry object
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description as a mini-card

    public function displayTGECard(TGE $TGE) {
        echo '<div class="smallGameBox">
                <p>' . htmlspecialchars($TGE->getGameTitle()) . '</p>
                <p>Rating: ' . htmlspecialchars($TGE->getOverallRating()) . '/10</p>
                <p>' . htmlspecialchars($this->limitChars($TGE->getDescription(), 200)) . '</p>
                <a href="viewTG.php?gameTitle=' . htmlspecialchars($TGE->getGameTitle()) . '" class="navButton">View Game Description</a>
            </div>';
    }

    //Function Name: displayTGEFeatureGameBox
    //Purpose: To display the contents of a tabletop game description as a feature game box
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description as a feature game box
    public function displayTGEFeatureGameBox(string $featureGame) {
        //Create new TGE object from the game
        $TGE = new TGE($featureGame);
        
        //Get images array for output
        $images = $TGE->getImages();

        echo '<!-- left div for header + information -->
        <div class="featuredItemLeft">
            <a href="viewTG.php?gameTitle="' . htmlspecialchars($TGE->getGameTitle()) . '" <h2>' . htmlspecialchars($TGE->getGameTitle()) . '</h2></a>
            <p>Submitted by: ' . htmlspecialchars($TGE->getScreenName()) . '</p>
            <p>Rating: ' . htmlspecialchars($TGE->getOverallRating()) . '</p>
            <p>Number of Players: ' . htmlspecialchars($TGE->getNumPlayers()) . '</p>
            <p>Company: ' . htmlspecialchars($TGE->getCompany()) . '</p>
            <p>Game time: ' . htmlspecialchars($TGE->getPlayTime()) . ' hours </p>
            <p>Age Rating: ' . htmlspecialchars($TGE->getAgeRating()) . ' yrs</p>
            <p>Number of Expansions: ' . htmlspecialchars($TGE->getExpansions()) . '</p>
            <p>Description:</p>
            <p>' . htmlspecialchars($TGE->getDescription()) . '</p>
        </div>

        <!-- Right div for feature image-->
        <div class="featuredItemRight">
            <img src="' . htmlspecialchars($images[0]) . '" class="featureImage" alt="Featured Game Image" />
        </div>';
    }




    //--------------User Display Functions----------------//
    public function displayDashboard($user) {}

    private function displayDashboardTitle($user) {}

    private function displayDashboardProfile($user) {}

    private function displayDashboardTGEBox($user) {}

    private function displayDashboardFlaggedReviews() {}

    private function displayDashboardPendingTGE() {}

    public function displayReviewTGE($TGE) {}

    //-------------Review Display Functions----------------//
    //Function Name: displayReview
    //Purpose: To display the contents of this review 
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: The contents of this review are displayed on a webpage
    public function displayReview() {}

    //------------TGE Display Functions--------------------//
    //Function Name: displayTGE
    //Purpose: To display the contents of a tabletop game description on the viewTGE.php page
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description on the viewTGE.php page
    public function displayTGE($TGE) {

    }
}