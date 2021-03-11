<?php
    //Include user class
    include_once(__DIR__ . '/userFactory.php');

    //Continue the session
    session_start();

    //Set the last login field for the user
    $currDate = date("Y-m-d", time());
    $_SESSION["userObj"]->setLastLogin($currDate);

    //Unset all of the session variables
    $_SESSION = array();

    //Destroy the session
    session_destroy();

    //Redirect back to the home page
    header("Location: ../index.php");

    //Exit from the script
    exit();
?>