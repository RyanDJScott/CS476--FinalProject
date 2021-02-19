<?php
    //Continue the session
    session_start();

    //Unset all of the session variables
    $_SESSION = array();

    //Destroy the session
    session_destroy();

    //Redirect back to the home page
    header("Location: ../index.php");

    //Exit from the script
    exit();
?>