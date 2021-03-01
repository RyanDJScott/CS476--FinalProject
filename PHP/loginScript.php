<?php
//Include the database credentials
include './database.php';
include './userFactory.php';

//Create a database object
$db = new database();
$dbConnect = $db->getDBConnection();

//If the user presses the submit button
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Trim the spaces off the inputs and store in variables
    $userName = trim($_POST["loginEmail"]);
    $userPassword = trim($_POST["loginPassword"]);

    //Send the credentials to the DB for authentication
    $loginQuery = "SELECT UID, userType FROM Users WHERE email = '" . $dbConnect->real_escape_string($userName) .
        "' AND password = '" . $dbConnect->real_escape_string($userPassword) . "'";

    //Get the return value from the DB
    $loginResult = $dbConnect->query($loginQuery);

    //Check if the user existed in the DB
    if ($loginResult->num_rows > 0) {
        //User existed. Get the information contained in $loginResult
        $userInfo = $loginResult->fetch_assoc();

        //Start a new session
        session_start();

        //Set the UID session variable
        $_SESSION["UID"] = $userInfo["UID"];

        //Determine what type of user they are and instantiate that object
        if ($userInfo["userType"] == 0) {
            $commUser = new communityUserFactory;
            $_SESSION["userObj"] = $commUser->makeUser($userInfo["UID"]);
        } else if ($userInfo["userType"] == 1) {
            $adminUser = new adminUserFactory;
            $_SESSION["userObj"] = $adminUser->makeUser($userInfo["UID"]);
        }

        //Send them to their dashboard page
        header("Location: ../dashboard.php");
    } else {
        //User does not exist, send them back with error message
        header("Location: ../login.php?login=FAIL");
    }
}
?>