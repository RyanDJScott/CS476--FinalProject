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
    private $images = array();

    //Database connection variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Member functions

    // Function Name: Constructor
    // Purpose: To intialize all class variables
    // Parameters: 
    //   <1> $userID: The UID of the user submitting this TGE
    // Returns: None
    // Side Effects:
    //   <1> The database member variables are initialized with a database connection
    //   <2> All member variables are initialized with the input to the fields
    public function __construct(int $userID) {
        //Initialize DB variables
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Initialize member variables 
        //Numbers are cast to ensure good DB insertions
        $this->UID = $userID;
        $this->gameTitle = trim($_POST["submitTGEName"]);
        $this->numPlayers = trim($_POST["submitTGEPlayers"]);
        $this->ageRating = trim($_POST["submitTGEAge"]);
        $this->playTime = trim($_POST["submitTGEPlaytime"]);
        $this->description = trim($_POST["description"]);
        $this->company = trim($_POST["submitTGECompanyName"]);
        $this->expansions = trim($_POST["submitTGEExpansions"]);
    }

    // Function Name: valGameTitle
    // Purpose: To validate the information contained in $gameTitle
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the game title passes validation
    //   <2> FALSE: If the game title doesn't pass validation
    // Side Effects: None
    private function valGameTitle () {
        if (strlen($this->gameTitle) > 0 && strlen($this->gameTitle) <= 60)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valNumPlayers
    // Purpose: To validate the information contained in $numPlayers
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the number of players passes validation
    //   <2> FALSE: If the number of players doesn't pass validation
    // Side Effects: None
    private function valNumPlayers () {
        if ($this->numPlayers > 0 && $this->numPlayers < 20)
            return TRUE;
        else 
            return FALSE;
    }

    // Function Name: valAgeRating
    // Purpose: To validate the information contained in $ageRating
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the screenname passes validation
    //   <2> FALSE: If the screenname doesn't pass validation
    // Side Effects: None
    private function valAgeRating () {
        if ($this->ageRating > 0 && $this->ageRating < 19)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valPlayTime
    // Purpose: To validate the information contained in $playTime
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the play time passes validation
    //   <2> FALSE: If the play time doesn't pass validation
    // Side Effects: None
    private function valPlayTime () {
        if ($this->playTime > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valDescription
    // Purpose: To validate the information contained in $description
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the description passes validation
    //   <2> FALSE: If the description doesn't pass validation
    // Side Effects: None
    private function valDescription () {
        if (strlen($this->description) > 0)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valCompany
    // Purpose: To validate the information contained in $company
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the company passes validation
    //   <2> FALSE: If the company doesn't pass validation
    // Side Effects: None
    private function valCompany () {
        if (strlen($this->company) > 0 && strlen($this->company) <= 100)
            return TRUE;
        else
            return FALSE;
    }

    // Function Name: valExpansions
    // Purpose: To validate the information contained in $expansions
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the expansions number passes validation
    //   <2> FALSE: If the expansions number doesn't pass validation
    // Side Effects: None
    private function valExpansions () {
        if ($this->expansions >= 0 && $this->expansions <= 30)
            return TRUE;
        else
            return FALSE;
    }

    private function uploadImages () {
        //Get the number of uploaded files
        $fileNumber = count($_FILES['submitTGEUpload']['name']);

        //Check to see if there are more than 4 files. If so, reject.
        if ($fileNumber > 4 || $fileNumber <= 0)
            return FALSE;

        //Cycle through each image, and perform a series of checks
        for ($i = 0; $i < $fileNumber; $i++) {
            //If there was an upload error on any of the images, return false
            switch ($_FILES['submitTGEUpload']['error'][$i]) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    return FALSE;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    return FALSE;
                default:
                    return FALSE;
            }

            //If the file size is greater than 2 MB
            if ($_FILES['submitTGEUpload']['size'][$i] > 2097152) 
                return FALSE;

            //Check to see if it's an actual image by checking the file info object
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            if (false === $ext = array_search(
                $finfo->file($_FILES['submitTGEUpload']['tmp_name'][$i]),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),true)) {
                    return FALSE;
            } 
        }


        //If you made it out of the loop, all images are ready to be uploaded
        for ($j = 0; $j < $fileNumber; $j++) {
            //Prepare the URL incase the file upload works
            $filePath = "/uploads/gamePictures/" . sha1_file($_FILES["submitTGEUpload"]["tmp_name"][$j]) . "." . $ext . "";

            //Try to move the file to the uploads folder
            if (!move_uploaded_file($_FILES['submitTGEUpload']['tmp_name'][$j],
                sprintf(
                    __DIR__ . '/../uploads/gamePictures/%s.%s',
                    sha1_file($_FILES['submitTGEUpload']['tmp_name'][$j]),
                    $ext
                )
            )) {
                return FALSE;
            } else {
                $this->images[] = $filePath;
            }
        }

        //If you made it out of the loop, all images were moved correctly
        return TRUE;
    }

    // Function Name: submitForm
    // Purpose: To submit all of the information in the input fields on submitTGE.php and to upload all images to the site
    // Parameters: None
    // Returns: None
    // Side Effects:
    //   <1> All game information is inserted into the GameDescriptions table
    //   <2> All of the status information is inserted into the GameDescriptionStatus table
    //   <3> All submitted images are uploaded to the website
    //   <4> All image URLs are inserted into the DescriptionPics table
    //   <5> If any of 1-4 fails, the user is directed back to the submitTGE page with errors
    //   <6> If 1-4 succeeds, the user is directed back to their dashboard
    public function submitForm() {
        //Check to see if all validation checks pass, if not redirect back to the page
        if ($this->valGameTitle() && $this->valNumPlayers() && $this->valAgeRating() && $this->valPlayTime() && $this->valDescription() && $this->valCompany() && $this->valExpansions()) {
            //Attempt to upload the images. If successful, start inserting into the DB
            if ($this->uploadImages()) {
                //Execute a query to insert this game into the DB
                $submitTGEQuery = "INSERT INTO GameDescriptions (gameTitle, UID, dateSubmitted, numPlayers, ageRating, playTime, description, company, expansions) VALUES ('" . $this->dbConnect->real_escape_string($this->gameTitle) . "'
                , '" . $this->dbConnect->real_escape_string($this->UID) . "', NOW(), '" . $this->dbConnect->real_escape_string($this->numPlayers) . "', '" . $this->dbConnect->real_escape_string($this->ageRating) . "'
                , '" . $this->dbConnect->real_escape_string($this->playTime) . "', '" . $this->dbConnect->real_escape_string($this->description) . "', '" . $this->dbConnect->real_escape_string($this->company) . "'
                , '" . $this->dbConnect->real_escape_string($this->expansions) . "')";

                $submitResult = $this->dbConnect->query($submitTGEQuery);

                //If the initial submit worked, set the status 
                if ($submitResult == TRUE) {
                    //Set default values into the status table
                    $statusQuery = "INSERT INTO GameDescriptionStatus (gameTitle, status, reason) VALUES ('" . $this->dbConnect->real_escape_string($this->gameTitle) . "', 2, 'This tabletop game entry has yet to be reviewed.')";

                    $statusResults = $this->dbConnect->query($statusQuery);

                    //If the status submit worked, set the images
                    if ($statusResults == TRUE) {
                        //Set a insert flag
                        $imageInsertFlag = TRUE;

                        //Go through the images array and insert these into the DB
                        for ($i = 0; $i < count($this->images); $i++) {
                            $imageInsert = "INSERT INTO DescriptionPics (gameTitle, pictureURL) VALUES ('" . $this->dbConnect->real_escape_string($this->gameTitle) . "', '" . $this->dbConnect->real_escape_string($this->images[$i]) . "')";

                            $imageResults = $this->dbConnect->query($imageInsert);

                            //Set the flag if this didn't work
                            if ($imageResults == TRUE)
                                continue;
                            else {
                                $imageInsertFlag = FALSE;
                                break;
                            }
                        }

                        //Check if the images worked, if so, send the user to their dashboard
                        if ($imageInsertFlag == TRUE)
                            header("Location: ../dashboard.php");
                        else 
                            header("Location: ../submitTGE.php?error=dbimg_error");
                    } else {
                        header("Location: ../submitTGE.php?error=st_error");
                    }
                } else {
                    header("Location: ../submitTGE.php?error=db_error");
                }
            } else {
                header("Location: ../submitTGE.php?error=img_error");
            }
        } else {
            header("Location: ../submitTGE.php?error=val_error");
        }
    }
}

?>