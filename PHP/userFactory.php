<?php

abstract class userFactory {
    abstract function makeUser($userID);
}

class communityUserFactory extends userFactory {
    private $context = "Community User";

    public function makeUser($userID) {
        return new communityUser($userID);
    }
}

class adminUserFactory extends userFactory {
    private $context = "Administrator";

    public function makeUser($userID) {
        return new adminUser($userID);
    }
}

abstract class user {
    //Base user functionalities here
    //Both users implement these functions
    abstract public function setInfo($info);
    abstract public function getInfo();
    abstract public function setUID($userID);
    abstract public function getUID();
    abstract public function displayDashboard();
    abstract public function displayDashboardTitle();
    abstract protected function showProfileDashboard();
    abstract protected function showTGEBoxDashboard();
    abstract public function displayEditProfile();
    abstract public function editProfile($newInfo);
    abstract protected function deleteAccount();
    abstract public function addTGE($TG);
    abstract public function leaveReview($review);
    abstract public function flagReview($revInfo);

    //Admin functionalities here
    //Admin: implements these functions
    //Comm. Users: Block the user from using these functions
    abstract protected function showFlaggedReviewsDashboard();
    abstract protected function showPendingTGEDashboard();
    abstract protected function deleteUser($userID);
    abstract protected function reviewFlag();
    abstract protected function removeFlag($reviewInfo);
    abstract protected function deleteReview($reviewInfo);
    abstract public function displayReviewTGE($TGE);
    abstract protected function setTGEStatus($TGE);
    abstract protected function promoteUser($userID);
}

class communityUser extends user {
    //Member variables
    private $userInfo = NULL;
    private $UID = NULL;

    // Function Name: Constructor
    // Purpose: Set the private member variables for the class
    // Parameters: 
    //   <1> $UserID: UID from DB that is primary key of user row
    // Returns: N/A
    // Side Effects: 
    //   <1> $userInfo array initialized with DB values for userID
    //   <2> $userDashboard is initialized with a dashboard object
    //   <3> $UID is set to the primary key of the user
    public function __construct($userID) {
        $UID = $userID;
    }

    // Function Name: setInfo
    // Purpose: Setter for the $userInfo array
    // Parameters:
    //   <1> $info: an array of information to set the $userInfo array
    // Returns: N/A
    // Side Effects: $userInfo is set with the information contained in $info
    public function setInfo($info) {}

    // Function Name: getInfo
    // Purpose: Getter for the $userInfo array
    // Parameters: N/A
    // Returns: 
    //   <1> The information in the $userInfo array
    // Side Effects: None
    public function getInfo() {}

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
    
    // Function Name: displayDashboard
    // Purpose: To display the community users dashboard on the dashboard page
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: Displays the community users dashboard (profile, submit button, pending entries)
    //    to the dashboard page
    public function displayDashboard() {}

    // Function Name: displayDashboardTitle
    // Purpose: To display the title block on the dashboard header image
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the user name, # reviews, # entries, last login on the page 
    //       if DB fetch is successful
    //   <2> Displays error if DB fetch unsuccessful
    public function displayDashboardTitle() {}

    // Function Name: showProfileDashboard
    // Purpose: To fetch DB info and display the profile box on the dashboard
    // Parameters:
    //   <1> $userID: The UID of the user who owns the dashboard
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the profile box of the user if DB fetch was successful
    //   <2> Displays an error if the DB fetch is unsuccessful
    protected function showProfileDashboard() {}

    // Function Name: showTGEBoxDashboard
    // Purpose: To fetch DB info and display the submit TGE button and pending TGE box
    // Parameters: 
    //   <1> $userID: The UID of the user who owns the dashboard
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays all of the TGE's that have a pending flag status if DB fetch successful
    //   <2> Displays error message if DB fetch unsuccessful
    protected function showTGEBoxDashboard() {}

    // Function Name: displayEditProfile
    // Purpose: To display the displayEditProfile page with the DB info inside the fields
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the edit profile input fields on the edit profile page
    public function displayEditProfile() {}

    // Function Name: editProfile($newInfo)
    // Purpose: To insert the newly retrieved information from the edit profile page into the DB
    // Parameters:
    //   <1> $newInfo: an array containing all the new field information
    // Returns:
    //   <1> True: If update was successful
    //   <2> False: If update was unsuccessful
    // Side Effects: Updates the DB with the newly updated information
    public function editProfile($newInfo) {}

    // Function Name: deleteAccount
    // Purpose: To delete this users account if they choose
    // Parameters: N/A
    // Returns:
    //   <1> True: If the user account was successfully deleted
    //   <2> False: If the user account was not successfully deleted
    // Side Effects: The user information is deleted from the DB
    protected function deleteAccount() {}

    // Function Name: addTGE
    // Purpose: To add the tabletop game entry to the DB
    // Parameters: 
    //   <1> $TG: An array that contains all the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The tabletop game description is inserted into the DB
    public function addTGE($TG) {}

    // Function Name: leaveReview
    // Purpose: To add a review to a tabletop game description on the site
    // Parameters:
    //   <1> $review: An array that contains all of the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The review is inserted into the DB
    public function leaveReview($review) {}

    // Function Name: flagReview
    // Purpose: To flag an innappropriate review for moderation
    // Parameters:
    //   <1> $revInfo: An array that contains the UID/GameTitle for the review to be found
    // Returns: N/A
    // Side Effects:
    //   <1> If update is successful, shows a confirmation box about the flag being set
    //   <2> If update is unsuccessful, shows a confirmation box about flag not being set
    public function flagReview($revInfo) {}


    // Function Name: showFlaggedReviewsDashboard()
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    protected function showFlaggedReviewsDashboard() {}

    // Function Name: showPendingTGEDashboard
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: none
    protected function showPendingTGEDashboard() {}

    // Function Name: deleteUser
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    protected function deleteUser($userID) {}

    // Function Name: reviewFlag
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function reviewFlag() {}

    // Function Name: removeFlag
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    protected function removeFlag($reviewInfo) {}

    // Function Name: deleteReview
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    protected function deleteReview($reviewInfo) {}

    // Function Name: displayReviewTGE
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    public function displayReviewTGE($TGE) {}

    // Function Name: setTGEStatus
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    protected function setTGEStatus($TGE) {}

    // Function Name: promoteUser
    // Purpose: None; used to overwrite abstract method
    // Parameters: None
    // Returns: None
    // Side Effects: None
    protected function promoteUser($userID) {}
}

class adminUser extends user {
    //Member variables
    private $userInfo = NULL;
    private $UID = NULL;

    // Function Name: Constructor
    // Purpose: Set the private member variables for the class
    // Parameters: 
    //   <1> $UserID: UID from DB that is primary key of user row
    // Returns: N/A
    // Side Effects: 
    //   <1> $userInfo array initialized with DB values for userID
    //   <2> $userDashboard is initialized with a dashboard object
    //   <3> $UID is set to the primary key of the user
    public function __construct($userID) {
        $UID = $userID;
    }

    // Function Name: setInfo
    // Purpose: Setter for the $userInfo array
    // Parameters:
    //   <1> $info: an array of information to set the $userInfo array
    // Returns: N/A
    // Side Effects: $userInfo is set with the information contained in $info
    public function setInfo($info) {}

    // Function Name: getInfo
    // Purpose: Getter for the $userInfo array
    // Parameters: N/A
    // Returns: 
    //   <1> The information in the $userInfo array
    // Side Effects: None
    public function getInfo() {}

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
    
    // Function Name: displayDashboard
    // Purpose: To display the community users dashboard on the dashboard page
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: Displays the community users dashboard (profile, submit button, pending entries)
    //    to the dashboard page
    public function displayDashboard() {}

    // Function Name: displayDashboardTitle
    // Purpose: To display the title block on the dashboard header image
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the user name, # reviews, # entries, last login on the page if DB fetch 
    //      is successful
    //   <2> Displauys error message if DB fetch unsuccessful
    public function displayDashboardTitle() {}

    // Function Name: showProfileDashboard
    // Purpose: To fetch DB info and display the profile box on the dashboard
    // Parameters:
    //   <1> $userID: The UID of the user who owns the dashboard
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the profile box of the user if DB fetch was successful
    //   <2> Displays an error if the DB fetch is unsuccessful
    protected function showProfileDashboard() {}

    // Function Name: showTGEBoxDashboard
    // Purpose: To fetch DB info and display the submit TGE button and pending TGE box
    // Parameters: 
    //   <1> $userID: The UID of the user who owns the dashboard
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the submit button and pending TGE box if DB fetch was successful 
    //   <2> Displays an error if DB fetch unsuccessful
    protected function showTGEBoxDashboard() {}

    // Function Name: displayEditProfile
    // Purpose: To display the displayEditProfile page with the DB info inside the fields
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the edit profile input fields on the edit profile page
    public function displayEditProfile() {}

    // Function Name: editProfile($newInfo)
    // Purpose: To insert the newly retrieved information from the edit profile page into the DB
    // Parameters:
    //   <1> $newInfo: an array containing all the new field information
    // Returns:
    //   <1> True: If update was successful
    //   <2> False: If update was unsuccessful
    // Side Effects: Updates the DB with the newly updated information
    public function editProfile($newInfo) {}

    // Function Name: deleteAccount
    // Purpose: To delete this users account if they choose
    // Parameters: N/A
    // Returns:
    //   <1> True: If the user account was successfully deleted
    //   <2> False: If the user account was not successfully deleted
    // Side Effects: The user information is deleted from the DB
    protected function deleteAccount() {}

    // Function Name: addTGE
    // Purpose: To add the tabletop game entry to the DB
    // Parameters: 
    //   <1> $TG: An array that contains all the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The tabletop game description is inserted into the DB
    public function addTGE($TG) {}

    // Function Name: leaveReview
    // Purpose: To add a review to a tabletop game description on the site
    // Parameters:
    //   <1> $review: An array that contains all of the information for the DB
    // Returns:
    //   <1> True: If the insert into the DB is successful
    //   <2> False: If the insert into the DB is unsuccessful
    // Side Effects: The review is inserted into the DB
    public function leaveReview($review) {}

    // Function Name: flagReview
    // Purpose: To flag an innappropriate review for moderation
    // Parameters:
    //   <1> $revInfo: An array that contains the UID/GameTitle for the review to be found
    // Returns: N/A
    // Side Effects:
    //   <1> If update is successful, shows a confirmation box about the flag being set
    //   <2> If update is unsuccessful, shows a confirmation box about flag not being set
    public function flagReview($revInfo) {}


    // Function Name: showFlaggedReviewsDashboard()
    // Purpose: Fetches and displays all of the flagged reviews needing moderation 
    //  on the admin dashboard
    // Parameters: None
    // Returns: N/A
    // Side Effects:
    //   <1> Displays all of the reviews that have been flagged for moderation if DB fetch 
    //       successful
    //   <2> Displays error message if DB fetch unsuccessful
    protected function showFlaggedReviewsDashboard() {}

    // Function Name: showPendingTGEDashboard
    // Purpose: Fetches and displays all of the pending TGE's needing moderation
    // Parameters: None
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays all of the TGE's that have a pending flag status if DB fetch successful
    //   <2> Displays error message if DB fetch unsuccessful
    protected function showPendingTGEDashboard() {}

    // Function Name: deleteUser
    // Purpose: To delete a user from the database/site
    // Parameters: 
    //   <1> $userID: the UID of the user being deleted
    // Returns:
    //   <1> True: If the user was successfully deleted
    //   <2> False: If the user was unsuccessfully deleted
    // Side Effects: The user with UID of $userID is deleted from the DB
    protected function deleteUser($userID) {}

    // Function Name: reviewFlag
    // Purpose: To display the information necessary to review a flagged review
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: Displays two buttons to accept/reject a flag
    public function reviewFlag() {}

    // Function Name: removeFlag
    // Purpose: To remove the flag off a review
    // Parameters: 
    //   <1> $reviewInfo: UID/gameTitle information to find the review
    // Returns: 
    //   <1> True: The flag was successfully removed
    //   <2> False: The flag was unsuccessfully removed
    // Side Effects: The flag is removed from the review
    protected function removeFlag($reviewInfo) {}

    // Function Name: deleteReview
    // Purpose: To delete a review from the DB
    // Parameters: 
    //   <1> $reviewInfo: UID/gameTitle information to find the review
    // Returns: 
    //   <1> True: The review was successfully deleted
    //   <2> False: The review was unsuccessfully deleted
    // Side Effects: The review is deleted from the site
    protected function deleteReview($reviewInfo) {}

    // Function Name: reviewTGE
    // Purpose: To display the contents of a pending TGE with review box and buttons
    // Parameters:
    //   <1> $TGE: The gameTitle of the game that needs review
    // Returns: N/A
    // Side Effects: The game information is displayed on the page
    public function displayReviewTGE($TGE) {}

    // Function Name: setTGEStatus
    // Purpose: To set the status information of a pending TGE
    // Parameters:
    //   <1> $TGE: The gameTitle of the game that needs review
    // Returns:
    //   <1> True: If the update was successful
    //   <2> False: If the update was unsuccessful
    // Side Effects: The status variable in the DB for the game is updated
    protected function setTGEStatus ($TGE) {}

    // Function Name: promoteUser
    // Purpose: To promote a community user to an administrator
    // Parameters:
    //   <1> $userID: The UID of the user being promoted
    // Returns: 
    //   <1> True: If the user was successfully updated
    //   <2> False: If the user was unsuccessfully updated
    // <side effects>
    protected function promoteUser($userID) {}
}
?>