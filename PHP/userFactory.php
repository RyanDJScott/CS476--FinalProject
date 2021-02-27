<?php
include './database.php';

abstract class userFactory {
    abstract function makeUser($userID);
}

class communityUserFactory extends userFactory {
    public function makeUser($userID) {
        return new communityUser($userID);
    }
}

class adminUserFactory extends userFactory {
    public function makeUser($userID) {
        return new adminUser($userID);
    }
}

abstract class user { 
    //Member variables common to all users
    private $UID = NULL;
    private $userType = NULL;

    //User profile variables
    private $firstName = NULL;
    private $lastName = NULL;
    private $birthday = NULL;
    private $email = NULL;
    private $screenName = NULL;
    private $avatarURL = NULL;
    private $biography = NULL;
    private $favGame = NULL;
    private $gameType = NULL;
    private $playTime = NULL;
    private $lastLogin = NULL;

    //DB variables
    private $db = NULL;
    private $dbConnect = NULL;

    //Common functions to both user types

    //Function Name: Constructor
    //Purpose: To construct a user object
    //Parameters:
    //   <1> $objUID: The UID of the user being constructed
    //Returns: N/A
    //Side Effects:
    //   <1> The DB variables are set for the object
    //   <2> All profile variables are set to their DB variables
    //   <3> $UID and $userType are set for the user object
    public function __construct($objUID) {
        //Create a new database object
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();

        //Query the DB for this user ID
        $userQuery = "SELECT userType, firstName, lastName, birthday, email, screenName, avatarURL, biography, favGame, gameType, playTime, lastLogin
            FROM Users WHERE UID = '" . $this->dbConnect->real_escape_string($objUID) . "'";

        //Execute query
        $queryResult = $this->dbConnect->query($userQuery);

        //If there is a result, instantiate all variables
        if (mysqli_num_rows($queryResult) > 0) {
            //Fetch the information
            $resultRows = $queryResult->fetch_assoc();

            //Set all information in the member variables
            $this->userType = $resultRows["userType"];
            $this->firstName = $resultRows["firstName"];
            $this->lastName = $resultRows["lastName"];
            $this->birthday = $resultRows["birthday"];
            $this->email = $resultRows["email"];
            $this->screenName = $resultRows["screenName"];
            $this->avatarURL = $resultRows["avatarURL"];
            $this->biography = $resultRows["biography"];
            $this->favGame = $resultRows["favGame"];
            $this->gameType = $resultRows["gameType"];
            $this->playTime = $resultRows["playTime"];
            $this->lastLogin = $resultRows["lastLogin"];

            //Set the UID for this object
            $this->UID = $objUID;
        }
    }
    
    //Note: No setter; set in the constructor
    //Function Name: getUID
    //Purpose: To get the UID of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->UID
    //Side Effects: N/A
    public function getUID() {
        return $this->UID;
    }

    //Note: No setter; only administrators have this right
    //Function Name: getUserType
    //Purpose: To get the userType of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->userType
    //Side Effects: N/A
    public function getUserType () {
        return $this->userType;
    }

    //Function Name: setFirstName
    //Purpose: To set the value of $firstName
    //Parameters:
    //   <1> $newFirstName: The new value of $firstName
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $firstName is set to the value of $newFirstName
    public function setFirstName($newFirstName) {}

    //Function Name: getFirstName
    //Purpose: To get the firstName of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->firstName
    //Side Effects: N/A
    public function getFirstName() {
        return $this->firstName;
    }

    //Function Name: setLastName
    //Purpose: To set the value of $lastName
    //Parameters:
    //   <1> $newFirstName: The new value of $lastName
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $lastName is set to the value of $newLastName
    public function setLastName($newLastName) {}

    //Function Name: getLastName
    //Purpose: To get the lastName of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->lastName
    //Side Effects: N/A
    public function getLastName() {
        return $this->lastName;
    }

    //Function Name: setBirthday
    //Purpose: To set the value of $birthday
    //Parameters:
    //   <1> $newBday: The new value of $birthday
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $birthday is set to the value of $newBday
    public function setBirthday($newBday) {}

    //Function Name: getBirthday
    //Purpose: To get the birthday of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->birthday
    //Side Effects: N/A
    public function getBirthday() {
        return $this->birthday;
    }

    //Function Name: setEmail
    //Purpose: To set the value of $email
    //Parameters:
    //   <1> $newEmail The new value of $email
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $email is set to the value of $newEmail
    public function setEmail($newEmail) {}

    //Function Name: getEmail
    //Purpose: To get the email of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->email
    //Side Effects: N/A
    public function getEmail() {
        return $this->email;
    }

    //Function Name: setScreenName
    //Purpose: To set the value of $screenName
    //Parameters:
    //   <1> $newSN: The new value of $screenName
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $screenName is set to the value of $newSN
    public function setScreenName($newSN) {}

    //Function Name: getScreenName
    //Purpose: To get the screenName of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->screenName
    //Side Effects: N/A
    public function getScreenName() {
        return $this->screenName;
    }

    //Function Name: setAvatarURL
    //Purpose: To set the value of $avatarURL
    //Parameters:
    //   <1> $newAvatar: The new value of $avatarURL
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $avatarURL is set to the value of $newAvatar
    public function setAvatarURL($newAvatar) {}

    //Function Name: getAvatarURL
    //Purpose: To get the avatarURL of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->avatarURL
    //Side Effects: N/A
    public function getAvatarURL() {
        return $this->avatarURL;
    }

    //Function Name: setBiography
    //Purpose: To set the value of $biography
    //Parameters:
    //   <1> $newBio The new value of $biography
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $biography is set to the value of $newBio
    public function setBiography($newBio) {}

    //Function Name: getBiography
    //Purpose: To get the biography of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->biography
    //Side Effects: N/A
    public function getBiography() {
        return $this->biography;
    }

    //Function Name: setFavGame
    //Purpose: To set the value of $favGame
    //Parameters:
    //   <1> $newFavGame: The new value of $favGame
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $favGame is set to the value of $newFavGame
    public function setFavGame($newFavGame) {}

    //Function Name: getFavGame
    //Purpose: To get the favGame of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->favGame
    //Side Effects: N/A
    public function getFavGame() {
        return $this->favGame;
    }

    //Function Name: setGameType
    //Purpose: To set the value of $gameType
    //Parameters:
    //   <1> $newGameType: The new value of $gameType
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $gameType is set to the value of $newGameType
    public function setGameType($newGameType) {}

    //Function Name: getGameType
    //Purpose: To get the gameType of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->gameType
    //Side Effects: N/A
    public function getGameType() {
        return $this->gameType;
    }

    //Function Name: setPlayTime
    //Purpose: To set the value of $playTime
    //Parameters:
    //   <1> $newPlayTime: The new value of $playTime
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $playTime is set to the value of $newPlayTime
    public function setPlayTIme($newPlayTime) {}

    //Function Name: getPlayTime
    //Purpose: To get the playTime of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->playTime
    //Side Effects: N/A
    public function getPlayTime() {
        return $this->playTime;
    }

    //Function Name: setLastLogin
    //Purpose: To set the value of $lastLogin
    //Parameters:
    //   <1> $newLogin: The new value of $lastLogin
    //Returns: 
    //   <1> TRUE: The information was updated in the DB
    //   <2> FALSE: THe information was not updated in the DB
    //Side Effects:
    //   <1> $lastLogin is set to the value of $newLogin
    public function setLastLogin($newLogin) {}

    //Function Name: getLastLogin
    //Purpose: To get the lastLogin of this object
    //Parameters: None
    //Returns: 
    //   <1> $this->lastLogin
    //Side Effects: N/A
    public function getLastLogin() {
        return $this->lastLogin;
    }
    
    //Base user functionalities here
    //Both users implement these functions
    abstract public function deleteAccount();
    abstract public function addTGE();
    abstract public function leaveReview();
    abstract public function flagReview($review);

    //Admin functionalities here
    //Admin: implements these functions
    //Comm. Users: Block the user from using these functions
    abstract public function deleteUser($userID);
    abstract public function removeFlag($review);
    abstract public function deleteReview($review);
    abstract public function setTGEStatus($TGE);
    abstract public function promoteUser($user);
}

class communityUser extends user {
    // Function Name: deleteAccount
    // Purpose: To delete this objects user account
    // Parameters: N/A
    // Returns:
    //   <1> TRUE: If the user account was successfully deleted
    //   <2> FALSE: If the user account was not successfully deleted
    // Side Effects: The user information is deleted from the DB, and the user is logged out of the system
    public function deleteAccount() {}

    // Function Name: addTGE
    // Purpose: To add the tabletop game entry to the DB
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the insert into the DB is successful
    //   <2> FALSE: If the insert into the DB is unsuccessful
    // Side Effects: A tabletop game description is inserted into the DB
    public function addTGE() {}

    // Function Name: leaveReview
    // Purpose: To add a review to a tabletop game description on the site
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the insert into the DB is successful
    //   <2> FALSE: If the insert into the DB is unsuccessful
    // Side Effects: The review is inserted into the DB
    public function leaveReview() {}

    // Function Name: flagReview
    // Purpose: Flag an innappropriate review for moderation
    // Parameters:
    //   <1> $review: A review object
    // Returns:
    //   <1> TRUE: The flag was successfully set in the DB
    //   <2> FALSE: The flag was unsuccessfully set in the DB
    // Side Effects:
    //   <1> The review objects flag is set to 1
    public function flagReview($review) {}


    // Function Name: deleteUser
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function deleteUser($user) {}

    // Function Name: removeFlag
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function removeFlag($review) {}

    // Function Name: deleteReview
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function deleteReview($review) {}

    // Function Name: setTGEStatus
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function setTGEStatus($TGE) {}

    // Function Name: promoteUser
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function promoteUser($userID) {}
}

class adminUser extends user {
    // Function Name: deleteAccount
    // Purpose: To delete this objects user account
    // Parameters: N/A
    // Returns:
    //   <1> TRUE: If the user account was successfully deleted
    //   <2> FALSE: If the user account was not successfully deleted
    // Side Effects: The user information is deleted from the DB, and the user is logged out of the system
    public function deleteAccount() {}

    // Function Name: addTGE
    // Purpose: To add the tabletop game entry to the DB
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the insert into the DB is successful
    //   <2> FALSE: If the insert into the DB is unsuccessful
    // Side Effects: A tabletop game description is inserted into the DB
    public function addTGE() {}

    // Function Name: leaveReview
    // Purpose: To add a review to a tabletop game description on the site
    // Parameters: None
    // Returns:
    //   <1> TRUE: If the insert into the DB is successful
    //   <2> FALSE: If the insert into the DB is unsuccessful
    // Side Effects: The review is inserted into the DB
    public function leaveReview() {}

    // Function Name: flagReview
    // Purpose: Flag an innappropriate review for moderation
    // Parameters:
    //   <1> $review: A review object
    // Returns:
    //   <1> TRUE: The flag was successfully set in the DB
    //   <2> FALSE: The flag was unsuccessfully set in the DB
    // Side Effects:
    //   <1> The review objects flag is set to 1
    public function flagReview($review) {}

    // Function Name: deleteUser
    // Purpose: To delete a user from the database
    // Parameters: 
    //   <1> $user: a user object that the admin wishes to delete
    // Returns:
    //   <1> TRUE: The user was successfully deleted from the DB
    //   <2> FALSE: The user was unsuccessfully deleted from the DB
    // Side Effects:
    //   <1> The user is removed from the DB
    public function deleteUser($user) {}

    // Function Name: removeFlag
    // Purpose: To remove the flag from the given review
    // Parameters: 
    //   <1> $review: The review that has it's flag set
    // Returns: 
    //   <1> TRUE: The review had the flag set back to 0
    //   <2> FALSE: The review did not have the flag set back to 0
    // Side Effects: 
    //   <1> The review has it's flag set back to 0
    public function removeFlag($review) {}

    // Function Name: deleteReview
    // Purpose: To delete the review from the database
    // Parameters: 
    //   <1> $review: The review that needs to be deleted
    // Returns:
    //   <1> TRUE: The review was successfully deleted from the database
    //   <2> FALSE: The review was not successfully deleted from the database
    // Side Effects:
    //   <1> The review is deleted from the database
    public function deleteReview($review) {}

    // Function Name: setTGEStatus
    // Purpose: To set the status information of a TGE
    // Parameters: 
    //   <1> $TGE: A tabletop game entry object
    // Returns:
    //   <1> TRUE: The status information was successfully set in the database
    //   <2> FALSE: The status information was not successfully set in the database
    // Side Effects:
    //   <1> The TGE has it's status information updated
    public function setTGEStatus($TGE) {}

    // Function Name: promoteUser
    // Purpose: To promote a user to an administrator
    // Parameters:
    //   <1> $user: The user who is being promoted
    // Returns:
    //   <1> TRUE: The user was successfully promoted to administrator
    //   <2> FALSE: The user was not successfully promoted to administrator
    // Side Effects:
    //   <1> The user is promoted to an administrator
    public function promoteUser($user) {}
}
?>