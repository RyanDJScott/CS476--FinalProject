<?php
//Include database class for connection
include_once(__DIR__ . '/database.php');

class submitTGE {
    //Member variables
    private $UID = NULL;
    private $gameTitle = NULL;
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

    public function __construct(int $userID) {
        //Initialize DB variables
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Initialize member variables 
        $this->UID = $userID;
        $this->gameTitle = $_POST["submitTGEName"];
        $this->numPlayers = $_POST["submitTGEPlayers"];
        $this->ageRating = $_POST["submitTGEAge"];
        $this->playTime = $_POST["submitTGEPlaytime"];
        $this->description = $_POST["description"];
        $this->company = $_POST["submitTGECompanyName"];
        $this->expansions = $_POST["submitTGEExpansions"];
    }

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