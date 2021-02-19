<?php
    //Include the database credentials
    include('dbCred.php');
    include('userFactory.php');

    //Connect to the database
    $dbConnect = new mysqli($host, $userName, $userPW, $dbName);

    //Check the connection
    if ($dbConnect->connect_error) {
        echo ("<p>There was an error connecting to the DB");
    } else {
        echo ("<p>You have successfully connected to your database WOOOO YEAH!");
    }

    //If the user presses the submit button
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userName = $_POST["loginEmail"];
        $userPassword = $_POST["loginPassword"];

    //Send the credentials to the DB for authentication
    $loginQuery = "SELECT UID, userType FROM Users WHERE email = ".$dbConnect->real_escape_string($userName).
        " AND password = ".$dbConnect->real_escape_string($userPassword)."";
    
    //Get the return value from the DB
    $loginResult = $dbConnect->query($loginQuery);    

    //Close the DB connection
    $dbConnect->close();
    //Check if the user existed in the DB
    if ($loginResult->num_rows > 0) {
        //User existed. Get the information contained in $loginResult
        $userInfo = $loginResult->fetch_assoc();

        //Start a new session
        session_start();

        //Set the UID session variable
        $_SESSION["UID"] = $userInfo["UID"];

        //Determine what type of user they are and instantiate that object
        if ($userInfo["userType"] === 0) {}
            $_SESSION["userObj"] = new communityUserFactory->makeUser($userInfo["UID"]);
        } else if ($userInfo["userType"] === 1) {
            $_SESSION["userObj"] = new adminUserFactory->makeUser($userInfo["UID"]);
        }

        //Send them to their dashboard page
        header("Location: ../dashboard.php");
    } else {
        //User does not exist, send them back with error message
        header("Location: ../signup.php?login=FAIL");
    }
?>