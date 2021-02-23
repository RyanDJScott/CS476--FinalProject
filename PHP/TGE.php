<?php

class TGE {
    //Member Variables
    private $entryInfo = NULL;
    private $images = NULL;
    private $gameReviews = NULL;

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
    public function __construct($gameTitle) {}

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