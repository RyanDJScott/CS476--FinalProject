<?php
//Include database class for connection
include_once(__DIR__ . '/database.php');

class submitTGE {
    //Member variables
    private $UID = NULL;
    private $dateSubmitted = NULL;
    private $numPlayers = NULL;
    private $ageRating = NULL;
    private $playTime = NULL;
    private $description = NULL;
    private $company = NULL;
    private $expansions = NULL;
    private $images = NULL;

    //Database connection variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Member functions

    public function __construct($userID) {}

    private function valDate () {}

    private function valNumPlayers () {}

    private function valAgeRating () {}

    private function valPlayTime () {}

    private function valDescription () {}

    private function valCompany () {}

    private function valExpansions () {}

    private function uploadImages () {}

    public function submitForm() {}
}

?>