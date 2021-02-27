<?
//Include all class dependencies
include 'TGE.php';
include 'review.php';
include 'userFactory.php';

//Implement display class
class display {
    //Database variables
    private $db = NULL;
    private $dbConnect = NULL;
 
    //Utility Member Functions


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
}