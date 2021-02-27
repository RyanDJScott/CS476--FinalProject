<?php

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

    //Common functions to both user types

    public function __construct($UID) {}
    // Function Name: setUID
    // Purpose: Setter for the $UID
    // Parameters: 
    //   <1> $userID - UID from DB that is primanry key of user row
    // Returns: N/A
    // Side Effects: $UID is set to the value of $userID
    public function setUID($userID) {}

    // Function Name: getUID
    // Purpose: Getter for the $UID
    // Parameters: N/A
    // Returns: 
    //   <1> $UID
    // Side Effects: None
    public function getUID() {}


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
    // Purpose: To delete this users account if they choose
    // Parameters: N/A
    // Returns:
    //   <1> True: If the user account was successfully deleted
    //   <2> False: If the user account was not successfully deleted
    // Side Effects: The user information is deleted from the DB
    public function deleteAccount() {}

    // Function Name: addTGE
    // Purpose: To add the tabletop game entry to the DB
    // Parameters: 
    //   <1> $TG: An array that contains all the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The tabletop game description is inserted into the DB
    public function addTGE() {}

    // Function Name: leaveReview
    // Purpose: To add a review to a tabletop game description on the site
    // Parameters:
    //   <1> $review: An array that contains all of the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The review is inserted into the DB
    public function leaveReview() {}

    // Function Name: flagReview
    // Purpose: To flag an innappropriate review for moderation
    // Parameters:
    //   <1> $revInfo: An array that contains the UID/GameTitle for the review to be found
    // Returns: N/A
    // Side Effects:
    //   <1> If update is successful, shows a confirmation box about the flag being set
    //   <2> If update is unsuccessful, shows a confirmation box about flag not being set
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
    // Purpose: To delete this users account if they choose
    // Parameters: N/A
    // Returns:
    //   <1> True: If the user account was successfully deleted
    //   <2> False: If the user account was not successfully deleted
    // Side Effects: The user information is deleted from the DB
    public function deleteAccount() {}

    // Function Name: addTGE
    // Purpose: To add the tabletop game entry to the DB
    // Parameters: 
    //   <1> $TG: An array that contains all the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The tabletop game description is inserted into the DB
    public function addTGE() {}

    // Function Name: leaveReview
    // Purpose: To add a review to a tabletop game description on the site
    // Parameters:
    //   <1> $review: An array that contains all of the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The review is inserted into the DB
    public function leaveReview() {}

    // Function Name: flagReview
    // Purpose: To flag an innappropriate review for moderation
    // Parameters:
    //   <1> $revInfo: An array that contains the UID/GameTitle for the review to be found
    // Returns: N/A
    // Side Effects:
    //   <1> If update is successful, shows a confirmation box about the flag being set
    //   <2> If update is unsuccessful, shows a confirmation box about flag not being set
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
?>