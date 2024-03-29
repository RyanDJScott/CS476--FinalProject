<?php
    //Include search class
    include_once(__DIR__ . '/PHP/userFactory.php');
    include_once(__DIR__ . '/PHP/searchScript.php');
    include_once(__DIR__ . '/PHP/navBar.php');

    //Continue the session
    session_start();

    //If the user pressed the search button, create a search object
    if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["user"]) || isset($_POST["game"])))
        $thisSearch = getSearchObject();
?>

<!DOCTYPE html>
<HTML lang="en">

<head>
    <title>Search - Queen City's Gambit</title>
    <meta charset="UTF-8">
    <!--==========================Stylsheets=================================-->
    <link rel="stylesheet" href="stylesheets/siteStyles.css">
    <link rel="stylesheet" href="stylesheets/search.css">
</head>

<body>
    <!-- The navigation bar -->
    <nav> 
        <a href="index.php"><img src="dependencies/miniLogo.png" alt="Mini Logo Home Button" class="miniLogo" /></a>
        <?php
            //Check if the user is logged in
            if ((isset($_SESSION["UID"]) && $_SESSION["UID"] > 0) && is_object($_SESSION["userObj"])) 
                loggedInNavBar();
            else 
                loggedOutNavBar();          
        ?>
    </nav>

    <!-- search header image -->
    <div class="mainPageHeader">
        <img src="dependencies/searchHeaderImage.png" class="headerImage" alt="Welcome to Queen City's Gambit!" />
    </div>

    <!--
    search bar and buttons centred in middle 
    row of users clustered together.. image and screenname together in border
    row of games... imgae and name together
    each row needs a header as well
    -->

    <!-- Search bar and result-type selection -->
    <div class="pageAllignment">
        <div class="searchAlignment">
            <form id="search" name="search" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class="search" type="text" id="searchInput" name="searchInput" placeholder="Search...">
                <br>
                <div class="userGame">
                    <label for="user">USER</label>
                    <input type="checkbox" id="user" name="user" value="USER">
                    <label for="game">&nbsp GAME</label>
                    <input type="checkbox" id="game" name="game" value="GAME">
                </div>
                <div class = "userGame">
                    <input type="submit" class="navButton">
                </div>
            </form>
        </div>

        <div class="rowAlignment">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && (isset($_POST["user"]) || isset($_POST["game"])))
            $thisSearch->publishResults();
        ?>
        </div>

    </div>
</body>

</HTML>