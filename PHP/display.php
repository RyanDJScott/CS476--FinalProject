<?
//Include all class dependencies
include 'TGE.php';
include 'review.php';
include 'userFactory.php';

//Implement display class
class display {
    //Utility Member Functions
    
    //Function Name: limitChars
    //Purpose: To truncate the text to a specific length and append '...' to the end of the string
    //Parameters: 
    //   <1> $text: the text you wish to truncate
    //   <2> $length: how much of $text you would like to display
    //Returns:
    //   <1> $text if the length of the string is <= $length
    //   <2> $newText, the truncated version of $text with '...' appended to the end
    //Side Effects: N/A
    private function limitChars($text, $length) {
        if(strlen($text) <= $length) {
            return $text;
        } else {
            $newText = substr($text, 0, $length) . '...';
            return $newText;
        }
    }

    //Function Name: displayTGE
    //Purpose: To display the contents of a tabletop game description on the viewTGE.php page
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description on the viewTGE.php page
    public function displayTGE($TGE) {

    }

    //Function Name: displayTGECard
    //Purpose: To display the contents of a tabletop game description as a mini-card
    //Parameters: 
    //   <1> $TGE: a tabletop game entry object
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description as a mini-card
    public function displayTGECard($TGE) {
        echo '<div class="smallGameBox">
                <p>' . htmlspecialchars($TGE->getGameTitle()) . '</p>
                <p>Rating: ' . htmlspecialchars($TGE->getOverallRating()) . '/10</p>
                <p>' . htmlspecialchars(limitChars($TGE->getDescription())) . '</p>
                <a href="viewTG.php?gameTitle=' . htmlspecialchars($TGE->getGameTitle()) . '" class="navButton">View Game Description</a>
            </div>';
    }

    //Function Name: displayTGEFeatureGameBox
    //Purpose: To display the contents of a tabletop game description as a feature game box
    //Parameters: N/A
    //Returns: N/A
    //Side Effects: Displays the contents of a tabletop game description as a feature game box
    public function displayTGEFeatureGameBox($TGE) {
        //Get images array for output
        $images = $TGE->getImages();

        echo '<!-- left div for header + information -->
        <div class="featuredItemLeft">
            <h2>' . htmlspecialchars($TGE->getGameTitle()) . '</h2>
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

        <!-- Right div for YouTube video-->
        <div class="featuredItemRight">
            <img src="' . htmlspecialchars($images[0]) . '" alt="Featured Game Image" />
        </div>';
    }



    
}