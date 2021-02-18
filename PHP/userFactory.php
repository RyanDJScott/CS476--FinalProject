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
?>