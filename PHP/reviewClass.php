<?php
    class Review {
        //Member variables
        private $reviewInformation = NULL;
        private $flagStatus = NULL;

        //Member functions

        //Function Name: Constructor
        //Purpose: To construct a review object
        //Parameters:
        //   <1> $gameTitle: The title of the game being reviewed
        //   <2> $userID: The UID of the user who left the review
        //Returns: N/A
        //Side Effects:
        //   <1> $reviewInformation: initialized to an array containing all review info
        //   <2> $flagStatus: initialized to 0 or 1
        public function __construct($gameTitle, $userID) {}

        //Function Name: setRevInfo
        //Purpose: Set the review information array to what is provided and update the DB
        //Parameters:
        //   <1> $newReviewInfo: An array containing all of the new review information
        //Returns: 
        //   <1> True: The information was updated in the DB
        //   <2> False: The information was NOT updated in the DB
        //Side Effects:
        //   <1> $reviewInformation: set to what is contained in $newReviewInfo
        //   <2> The database will be updated to reflect the information in $newReviewInfo
        public function setRevInfo($newReviewInfo) {}

        //Function Name: getRevInfo
        //Purpose: To get the information contained in $reviewInformation
        //Parameters: N/A
        //Returns: 
        //   <1> $reviewInformation: an array containing all of the review information
        //Side Effects: N/A
        public function getRevInfo() {}

        //Function Name: setFlag
        //Purpose: To set the value of $flagStatus
        //Parameters: 
        //   <1> $flagVal: 0 or 1
        //Returns:
        //   <1> True: If the flag value was updated in the DB
        //   <2> False: If the flag value was NOT updated in the DB
        //Side Effects: $flagStatus updated to the value of $flagVal
        public function setFlag($flagVal) {}

        //Function Name: getFlag
        //Purpose: To get the value of getFlag
        //Parameters: N/A
        //Returns: 
        //   <1> $flagStatus: 0 or 1
        //Side Effects: N/A
        public function getFlag() {}

        //Function Name: displayReview
        //Purpose: To display the contents of this review 
        //Parameters: N/A
        //Returns: N/A
        //Side Effects: The contents of this review are displayed on a webpage
        public function displayReview() {}
    }
?>
