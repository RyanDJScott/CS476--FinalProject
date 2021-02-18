<?php

abstract class userFactory {
    abstract function makeUser();
}

class communityUserFactory extends userFactory {
    private $context = "Community User";

    public function makeUser() {
        return new communityUser;
    }
}

class adminUserFactory extends userFactory {
    private $context = "Administrator";

    public function makeUser() {
        return new adminUser;
    }
}

abstract class user {
    //Base user functionalities here
    //Both users implement these functions
    abstract function setInfo($info);
    abstract function getInfo();
    abstract function setUID($UID);
    abstract function getUID();
    abstract function displayProfile();
    abstract function editProfile($newInfo);
    abstract function deleteAccount();
    abstract function displayDashboard();
    abstract function addTGE($TG);
    abstract function leaveReview($review);
    abstract function flagReview($revNum);

    //Admin functionalities here
    //Admin: implements these functions
    //Comm. Users: Block the user from using these functions
    abstract function deleteUser($UID);
    abstract function reviewFlag($review);
    abstract function reviewTGE($TGE);
    abstract function promoteUser($UID);
}

class communityUser extends user {
    //Member variables
    private $userInfo;
    private $userDashboard;
    private $UID;

    //Member functions
    abstract function setInfo($info) {}

    abstract function getInfo() {}

    abstract function setUID($UID) {}

    abstract function getUID() {}

    abstract function displayProfile() {}

    abstract function editProfile($newInfo) {}

    abstract function deleteAccount() {}

    abstract function displayDashboard() {}

    abstract function addTGE($TG) {}

    abstract function leaveReview($review) {}

    abstract function flagReview($revNum) {}


    abstract function deleteUser($UID) {}

    abstract function reviewFlag($review) {}

    abstract function reviewTGE($TGE) {}

    abstract function promoteUser($UID) {}
}

class adminUser extends user {
    //Member variables
    private $userInfo;
    private $userDashboard;
    private $UID;

    //Member functions
    abstract function setInfo($info) {}

    abstract function getInfo() {}

    abstract function setUID($UID) {}

    abstract function getUID() {}

    abstract function displayProfile() {}

    abstract function editProfile($newInfo) {}

    abstract function deleteAccount() {}

    abstract function displayDashboard() {}

    abstract function addTGE($TG) {}

    abstract function leaveReview($review) {}

    abstract function flagReview($revNum) {}


    abstract function deleteUser($UID) {}

    abstract function reviewFlag($review) {}

    abstract function reviewTGE($TGE) {}

    abstract function promoteUser($UID) {}
}
?>