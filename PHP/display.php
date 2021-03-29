<?php
//Include all class dependencies
include_once(__DIR__ . '/TGE.php');
include_once(__DIR__ . '/review.php');
include_once(__DIR__ . '/userFactory.php');
include_once(__DIR__ . '/database.php');


class Display {
    //Database variables
    private $db = NULL;
    private $dbConnect = NULL;
 
    // Function Name: constructor
    // Purpose: To establish a DB connection for the display
    // Parameters: None
    // Returns: N/A
    // Side Effects:
    //   <1> db/dbConnect are initialized
    public function __construct() {
        $this->db = new database();
        $this->dbConnect = $this->db->getDBConnection();
    }
    
    //-----------Utility Member Functions------------//
    
    // Function Name: limitChars
    // Purpose: To truncate the text to a specific length and append '...' to the end of the string
    // Parameters: 
    //   <1> $text: the string to be appended
    //   <2> $length: the length of the string you want returned with "..." appended to it
    // Returns: 
    //   <1> $text: if the string's length is <= length
    //   <2> $newString: the substring of length $length with "..." appended to it
    // Side Effects: None
    private function limitChars ($text, $length) {
        //If the string is already short enough, return it
        if (strlen($text) <= $length) {
            return $text;
        } else {
            //Create a new string the size of $length, append "..."
            $newString = substr($text, 0, $length) . "...";

            //Return this new string
            return $newString;
        }
    }

    // Function Name: displayRecommend
    // Purpose: To convert the boolean value into text
    // Parameters:
    //   <1> $recommend: Boolean value
    // Returns:
    //   <1> A string that says Yes or No, depending on the value of $recommend
    // Side Effects: N/A
    private function displayRecommend(bool $recommend) {
        //If the flag is true, return yes string, return no otherwise
        if ($recommend == TRUE)
            return "Yes, I would recommend this game!";
        else if ($recommend == FALSE)
            return "No, I would not recommend this game.";
    }

    // Function Name: convertStatus
    // Purpose: To convert the status into text
    // Parameters:
    //   <1> $status: integer that is either 0, 1, or 2
    // Returns:
    //   <1> A string that says rejected, accepted, or pending review depending on the value of $status
    // Side Effects: N/A
    private function convertStatus(int $status) {
        //If the status is 0, it's been rejected
        switch ($status) {
            case 0:
                return "Rejected";
            case 1:
                return "Accepted";
            case 2: 
                return "Pending Review";
            default:
                return "Error";
        }
    }

    //-----------------index.php display functions--------------------//
    // Function Name: displayAllGames
    // Purpose: To display all of the games as mini cards on index.php
    // Parameters: None 
    // Returns: None 
    // Side Effects: 
    //   <1> All approved games are displayed as mini cards on index.php, if they exist
    //   <2> An error message is displayed if no games meet this criteria
    public function displayAllGames() {
        //Get all of the games from the DB
        $allGamesQuery = "SELECT gameTitle FROM GameDescriptionStatus WHERE status = 1";

        //Execute the query
        $allGamesResult = $this->dbConnect->query($allGamesQuery);

        //Create an array to hold all of the objects
        $newGame = array();

        //For each of the results, create an object and store it in the newGame array
        if ($allGamesResult->num_rows > 0) {
            while ($resultRows = $allGamesResult->fetch_assoc()) {
                $newGame[] = new TGE($resultRows["gameTitle"]);
            }
        }

        //If the newGame array is not empty (i.e. there are no results)
        if (sizeof($newGame) != 0) {
            //While there are still games to display
            while (sizeof($newGame) != 0) {
                //Set a counter to enforce three per row
                $counter = 0;

                //Print a row container
                echo '<div class="rowContainer">';

                //While there is room for 1 more game box (3 max)
                //While there are still games to display
                while ($counter <= 3 && sizeof($newGame) != 0) {
                    //Display the card for this TGE
                    $this->displayTGECard($newGame[0]);

                    //Remove this TGE from the array
                    array_shift($newGame);

                    //Increment the counter
                    $counter++;
                }

                //Close the row div so we can start a new one after 3 are printed
                echo '</div>';
            }
        } else {
            //Echo an error statement
            echo '<div class="rowContainer"><p>There are no games on the site yet! Sign up and submit!</div>';
        }
    }

    // Function Name: displayTGECard
    // Purpose: To display the contents of a tabletop game description as a mini card
    // Parameters: 
    //   <1> $TGE: a tabletop game entry object
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the contents of a tabletop game description as a mini card
    public function displayTGECard(TGE $TGE) {
        echo '<div class="smallGameBox">
                <p>' . htmlspecialchars($TGE->getGameTitle()) . '</p>
                <p>Rating: ' . htmlspecialchars($TGE->getOverallRating()) . '/10</p>
                <p>' . htmlspecialchars($this->limitChars($TGE->getDescription(), 200)) . '</p>
                <a href="viewTG.php?gameTitle=' . htmlspecialchars($TGE->getGameTitle()) . '" class="navButton">View Game Description</a>
            </div>';
    }

    // Function Name: displayTGEFeatureGameBox
    // Purpose: To display the contents of a tabletop game description as a feature game box
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the contents of a tabletop game description as a feature game box
    public function displayTGEFeatureGameBox(string $featureGame) {
        //Create new TGE object from the game
        $TGE = new TGE($featureGame);
        $status = ($TGE->getStatusInfo())["status"];
        
        if ($TGE->getGameTitle() != NULL && $status == 1) {
            //Get images array for output
            $images = $TGE->getImages();

            echo '<!-- left div for header + information -->
            <div class="featuredItemLeft">
                <a href="viewTG.php?gameTitle=' . htmlspecialchars($TGE->getGameTitle()) . '"><h2>' . htmlspecialchars($TGE->getGameTitle()) . '</h2></a>
                <p>Submitted by: ' . htmlspecialchars($TGE->getScreenName()) . '</p>
                <p>Rating: ' . htmlspecialchars($TGE->getOverallRating()) . '</p>
                <p>Number of Players: ' . htmlspecialchars($TGE->getNumPlayers()) . '</p>
                <p>Company: ' . htmlspecialchars($TGE->getCompany()) . '</p>
                <p>Game time: ' . htmlspecialchars($TGE->getPlayTime()) . ' hours </p>
                <p>Age Rating: ' . htmlspecialchars($TGE->getAgeRating()) . ' yrs</p>
                <p>Number of Expansions: ' . htmlspecialchars($TGE->getExpansions()) . '</p>
                <p>Description:</p>
                <p>' . htmlspecialchars($TGE->getDescription()) . '</p>
            </div>

            <!-- Right div for feature image-->
            <div class="featuredItemRight">
                <img src="' . htmlspecialchars($images[0]) . '" class="featureImage" alt="Featured Game Image" />
            </div>';
        } else {
            echo '<p class="errorMessage">This game has not been verified yet!</p>';
        }
    }

    //--------------User Display Functions----------------//
    // Function Name: displayViewProfile
    // Purpose: To display the contents of a users information on viewProfile.php
    // Parameters:
    //   <1> $userID: The UID of the user being displayed
    // Returns: N/A
    // Side Effects:
    //   <1> The information of the user is displayed on the viewProfile.php page
    //   <2> An error is displayed if the user does not exist 
    public function displayViewProfile($userID) {
        //Get info from DB; we don't want to instantiate a user through this
        $userQuery = "SELECT firstName, lastName, birthday, email, screenName, avatarURL, biography, favGame, gameType, playTime FROM Users WHERE UID = '" . $this->dbConnect->real_escape_string($userID) . "'";

        //Execute query
        $userResult = $this->dbConnect->query($userQuery);

        //If there are results, display them
        if ($userResult->num_rows > 0) {
            $resultRow = $userResult->fetch_assoc();

            echo '<h1>' . $resultRow["screenName"] . '</h1>
                <!-- Main Area Container Which holds all -->
                <div class="mainContainer">
            
                <!-- user information container -->
                <div class="userInformation">
                <!-- image and basic information container -->
                <div class="userInformationLeft">

                <!-- image container -->
                <div class="userProfileImage">
                    <img src="' . $resultRow["avatarURL"] . '" alt="' . $resultRow["screenName"] . '\'s avatar" class="userImg">
                </div>
                <!-- information container -->
                <div class="simpleUserInfo">
                    <p>' . $resultRow["firstName"] . ' ' . $resultRow["lastName"] . '</p>
                    <p>' . $resultRow["birthday"] . '</p>
                    <p>' . $resultRow["email"] . '</p>
                </div>
                </div>

                <!-- biography, favourites, and edit profile container-->
                <div class="userInformationRight">

                <!-- biography -->
                <div class="userBiography">
                    <p>' . $resultRow["biography"] . '</p>
                </div>

                <!-- right side information-->
                <div class="favouritesInfo">
                    <p>Favourite Game: ' . $resultRow["favGame"] . '</p>
                    <p>Type: ' . $resultRow["gameType"] . '</p>
                    <p>Time Playing Game: ' . $resultRow["playTime"] . ' years</p>
                </div>
                </div>
                </div>';

                //If the viewing user is an admin, show the promote/delete buttons
                if (isset($_SESSION["UID"]) && $_SESSION["UID"] > 0 && is_a($_SESSION["userObj"], 'adminUser'))
                    $this->displayAdminButtons($userID);
        } else {
            echo '<h1>This user does not exist! Please contact the site administrator!</h1>';
        } 
    }
  
    // Function Name: displayAdminButtons
    // Purpose: To display the promote and delete buttons for administrators
    // Parameters: 
    //   <1> $userID: The UID of the user being displayed
    // Returns: N/A
    // Side Effects:
    //   <1> Displays the promote and delete buttons for the viewProfile.php page
    private function displayAdminButtons(int $userID) {
        echo '<!-- This is where the buttons will go -->
        <div class="buttonContainer">
            <form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                <input class="buttonButton" type="submit" name="promoteUser" value="PROMOTE"> 
                <input class="buttonButton" type="submit" name="deleteUser" value="DELETE">
                <input type="hidden" name="UID" value="' . $userID . '">
            </form>
        </div>';
    }
  
    //--------------Dashboard Display Functions----------------//
    // Function Name: displayDashboard
    // Purpose: To display the dashboard of the give user on dashboard.php
    // Parameters:
    //   <1> $user: a user object 
    // Returns: N/A
    // Side Effects: 
    //   <1> The user dashboard is displayed
    //   <2> The administrator privledges are displayed if the user is an administrator
    public function displayDashboard($user) {
        //Display the contents of the dashboard that has the users personal info on it
        $this->displayDashboardTitle($user);
        $this->displayDashboardProfile($user);
        $this->displayDashboardTGEBox($user);

        //If this user is an administrator, display the admin functions too
        //Close the div if they are not an admin
        if (is_a($user, 'adminUser')) {
            $this->displayDashboardFlaggedReviews();
            $this->displayDashboardPendingTGE();
        } else {
            echo '</div>';
        }
    }

    // Function Name: displayDashboardTitle
    // Purpose: To display the user information over the header image on dashboard.php
    // Parameters:
    //   <1> $user: a user object 
    // Returns: N/A
    // Side Effects:
    //   <1> The user screen name and last login are displayed over the header image on dashboard.php 
    private function displayDashboardTitle($user) {
        echo '<!-- Dashboard header image -->
            <div class="dashboardHeader">
                <img src="dependencies/dashboardImage.png" class="dashboardHeaderImage" alt="Welcome to Queen City\'s Gambit!" />
                    <div class="headerImageMessage">
                        Welcome Back ' . $user->getScreenName() . '<br>
                        Last Login: ' . $user->getLastLogin() . '
                    </div>
            </div>';
    }

    // Function Name: displayDashboardProfile
    // Purpose: To display the user information on dashboard.php
    // Parameters:
    //   <1> $user: a user object 
    // Returns: N/A
    // Side Effects:
    //   <1> The basic user information is displayed on dashboard.php 
    private function displayDashboardProfile($user) {
        echo '<h1>' . $user->getScreenName() . '</h1>
        <!-- Main Area Container Which holds all -->
        <div class="mainContainer">
    
            <!-- user information container -->
            <div class="userInformation">
    
                <!-- image and basic information container -->
                <div class="userInformationLeft">
    
                    <!-- image container -->
                    <div class="userProfileImage">
                        <img src="' . $user->getAvatarURL() . '" alt="' . $user->getScreenName() . '\'s profile picture">
                    </div>
    
                    <!-- information container -->
                    <div class="simpleUserInfo">
                        <p>' . $user->getFirstName() . ' ' . $user->getLastName() . '</p>
                        <p>' . $user->getBirthday() . '</p>
                        <p>' . $user->getEmail() . '</p>
                    </div>
                </div>
    
                <!-- biography, favourites, and edit profile container-->
                <div class="userInformationRight">
                    
                    <!-- biography -->
                    <div class="userBiography">
                        <p>' . $user->getBiography() . '</p>
                    </div>
    
                    <!-- right side information-->
                    <div class="favouritesInfo">
                        <p>Favourite Game: ' . $user->getFavGame() . '</p>
                        <p>Type: ' . $user->getGameType() . '</p>
                        <p>Time Playing Game: ' . $user->getPlayTime() . ' years</p>
                    </div>
    
                    <!-- edit profile button-->
                    <div class="editProfileButton">
                        <a href="editProfile.php">
                            <input class="buttonButton" type="button" value="EDIT PROFILE">
                        </a>
                    </div>
                </div>
    
            </div>';
    }

    // Function Name: displayDashboardTGEBox
    // Purpose: To display the TGE information for the user on dashboard.php
    // Parameters:
    //   <1> $user: a user object 
    // Returns: N/A
    // Side Effects:
    //   <1> Displays the TGE information for the user on dashboard.php 
    private function displayDashboardTGEBox($user) {
        echo '<!-- submit game description and pending container-->
        <div class="submitPending">

            <!-- submit game description-->
            <div class="submitDescription">
                <a href="submitTGE.php">
                    <input type="button" value="SUBMIT A GAME DESCRIPTION" class="submitDescriptionButton">
                </a>
            </div>
            
            <!-- pending table -->
            <div class="pendingTableContainer">';

        //Grab all of the pending entries for this user
        $pendingEntriesQuery = "SELECT GameDescriptions.gameTitle, GameDescriptions.dateSubmitted, GameDescriptionStatus.status, GameDescriptionStatus.reason FROM GameDescriptions INNER JOIN GameDescriptionStatus ON (GameDescriptions.gameTitle = GameDescriptionStatus.gameTitle) WHERE GameDescriptions.UID = '" . $this->dbConnect->real_escape_string($user->getUID()) . "'";

        //Execute query
        $pendingResults = $this->dbConnect->query($pendingEntriesQuery);

        //If there are results, display them
        if ($pendingResults->num_rows > 0) {
            echo '<table>
                    <!-- header row -->
                    <tr>
                        <th>TITLE</th>
                        <th>DATE SUBMITTED</th>
                        <th>STATUS</th>
                        <th>REASON</th>
                    </tr>

                    <!-- information -->';
            
            //Fill the table rows
            while ($resultRow = $pendingResults->fetch_assoc()) {
                echo '<tr>
                        <td>' . $resultRow["gameTitle"] . '</td>
                        <td>' . $resultRow["dateSubmitted"] . '</td>
                        <td>' . $this->convertStatus($resultRow["status"]) . '</td>
                        <td>' . $resultRow["reason"] . '</td> 
                    </tr>';
            }

            echo '</table>';
        } else {
         echo '<p>You haven\'t submitted any tabletop game entries!</p>';
        }
        
        echo '</div>
                </div>';
    }

    // Function Name: displayDashboardFlaggedReviews
    // Purpose: To display all the flagged reviews for an admin to moderate
    // Parameters: None
    // Returns: None
    // Side Effects: 
    //   <1> To display all flagged reviews for moderation on an administrators dashboard
    private function displayDashboardFlaggedReviews() {
        echo '<!-- heading for admin area-->
        <div class="adminContainer">
            <div class="adminHeading">Administrator Area</div>
        </div>

        <!-- admin functionality -->
        <div class="adminArea">
        <!-- flags -->
            <div class="flagTable">';

        //Find all flagged reviews in DB
        $flaggedReviewsQuery = "SELECT Reviews.gameTitle, Reviews.UID, Users.screenName FROM Users INNER JOIN Reviews ON (Users.UID = Reviews.UID) WHERE Reviews.flag = 1";

        //Execute query
        $flaggedResults = $this->dbConnect->query($flaggedReviewsQuery);

        //If there are results, display them
        if ($flaggedResults->num_rows > 0) {
            echo '<table>
                    <tr>
                        <th>Game Title</th>
                        <th>User Screenname</th>
                        <th>Link</th>
                    </tr>';
            
            //Display all rows in the table
            while ($resultRow = $flaggedResults->fetch_assoc()) {
                echo '<tr>
                        <td>' . $resultRow["gameTitle"] . '</td>
                        <td>' . $resultRow["screenName"] . '</td>
                        <td><a href="reviewFlag.php?gameTitle=' . $resultRow["gameTitle"] . '&UID=' . $resultRow["UID"] . '">Review Flag</a></td>
                    </tr>';
            }
          
          echo '</table>';
        } else {
            echo '<p>There are no flagged reviews on the site!';
        }

        echo '</div>'; 
    }

    // Function Name: displayDashboardPendingTGE
    // Purpose: To display all pending TG entries needing moderation
    // Parameters: None
    // Returns: N/A 
    // Side Effects: 
    //   <1> Displays all pending TG entries requiring moderation on the administrators dashboard
    private function displayDashboardPendingTGE() {
        echo '<!-- Descriptions -->
            <div class="descriptionReview">';

        //Find all pending reviews
        $pendingReviewQuery = "SELECT GameDescriptions.gameTitle, GameDescriptions.dateSubmitted FROM GameDescriptions INNER JOIN GameDescriptionStatus ON (GameDescriptions.gameTitle = GameDescriptionStatus.gameTitle) WHERE GameDescriptionStatus.status = 2";

        //Execute query
        $pendingResults = $this->dbConnect->query($pendingReviewQuery);

        //If there are results, display them
        if ($pendingResults->num_rows > 0) {
            echo '<table>
            <tr>
                <th>Title</th>
                <th>Date Submitted</th>
                <th>Revision Link</th> 
            </tr>';

            //Display all rows in the table
            while ($resultRow = $pendingResults->fetch_assoc()) {
                echo '<tr>
                        <td>' . $resultRow["gameTitle"] . '</td>
                        <td>' . $resultRow["dateSubmitted"] . '</td>
                        <td><a href="reviewTGE.php?gameTitle=' . $resultRow["gameTitle"] . '">Review this game</a></td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo '<p>There are no pending tabletop game entries to review!</p>';
        }
                    
        echo '</div>
                </div>
                </div>';            
    }

    //-------------Review Display Functions----------------//
    // Function Name: displayReview
    // Purpose: To display the contents of this review 
    // Parameters: N/A
    // Returns: N/A
    // Side Effects: 
    //   <1> The contents of this review are displayed on a webpage
    public function displayReview(Review $review) {
        echo '<div class="elementContainer">
            
            <!-- 
                left side for rating information
            -->
            <div class="innerContainer">
                <div class="name">Rating ' . $review->getRating() . '</div>
                Submitted By: ' . $review->getSubmittedBy() . '<br>
                Recommended? ' . $this->displayRecommend($review->getRecommend()) . '<br>
                Number of Players: ' . $review->getNumPlays() . '<br>
                Age of Players: ' . $review->getAvgAge() . '<br>
                Time for one Round: ' . $review->getAvgPlayTime() . '<br>
                Percieved Difficulty: ' . $review->getDifficulty() . '<br>
                Number of Times Played: ' . $review->getNumPlays() . '<br>
            </div> 

            <!--
                right side for review itself and flag button
            -->
            <div class="innerContainer">
                <p><br>'
                   . $review->getReview() .  
                '</p>';
            
            //Set logic for displaying buttons or not
            if ($review->getFlag() == 0) {
                echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                    <input class="flag" type="submit" name="flag" id="flag" value="FLAG REVIEW">
                    <input type="hidden" name="gameTitle" value="' . $review->getGameTitle() . '">
                    <input type="hidden" name="UID" value="' . $review->getUID() . '">
                </form>';
            } else {
                echo '<p class="errorMessage">This review has already been flagged.</p>';
            }

        echo '</div>
            </div>';
    }
    
    // Function Name: displayReviewTGE
    // Purpose: To display the contents of a tabletop game description on the reviewTGE.php page
    // Parameters: 
    //   <1> $TGE: the tabletop game entry being displayed
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the contents of a tabletop game description on the reviewTGE.php page
    public function displayReviewTGE(TGE $TGE) {
        $images = $TGE->getImages();

        echo '<!-- Container for tabletop game description -->
        <div class="elementContainer">
            
            <!--
                Display name, user who submitted
                and other information on one side
            -->
            <div class="innerContainer">
                <div class="name">' . $TGE->getGameTitle() . '</div>
                Submitted by ' . $TGE->getScreenName() . ' on ' . $TGE->getDateSubmitted() . '<br>
                Company: ' . $TGE->getCompany() . ' <br>
                Play Time: ' . $TGE->getPlayTime() . ' hours <br>
                Age Rating: ' . $TGE->getAgeRating() . '+ <br>
                Number of Players: ' . $TGE->getNumPlayers() . ' <br>
                Expansions: ' . $TGE->getExpansions() . ' <br>
            </div>

            <!-- 
                The game description itseld on
                the other (right) side
            -->
            <div class="innerContainer">
                <p><br>
                '. $TGE->getDescription() .'    
                </p>
            </div>


        </div>

        <!-- Container for images of the tabletop game-->
        <div class="imageContainer">
            <!-- Images of the boardgame, ideally should appear
             as four in a row-->';
        
        foreach ($images as $displayImages)
             echo '<img class="image" src="' . $displayImages . '" alt="Image for ' . $TGE->getGameTitle() . '"/>';
             
        echo '</div>';
    }

    // Function Name: displayFlaggedReview
    // Purpose: To display a flagged review on reviewFlag.php
    // Parameters:
    //   <1> $review: A Review object
    // Returns: N/A
    // Side Effects:
    //   <1> Displays the flagged review on reviewFlag.php 
    public function displayFlaggedReview(Review $review) {
        echo '<div class="elementContainer">
            
            <!-- 
                left side for rating information
            -->
            <div class="innerContainer">
                <div class="name">Rating ' . $review->getRating() . '</div>
                Submitted By: ' . $review->getSubmittedBy() . '<br>
                Recommended? ' . $this->displayRecommend($review->getRecommend()) . '<br>
                Number of Players: ' . $review->getNumPlays() . '<br>
                Age of Players: ' . $review->getAvgAge() . '<br>
                Time for one Round: ' . $review->getAvgPlayTime() . '<br>
                Percieved Difficulty: ' . $review->getDifficulty() . '<br>
                Number of Times Played: ' . $review->getNumPlays() . '<br>
            </div> 

            <!--
                right side for review itself and flag button
            -->
            <div class="innerContainer">
                <p><br>'
                   . $review->getReview() .  
                '</p>
                </div>
            </div>';
    }

    //------------TGE Display Functions--------------------//
    // Function Name: displayTGE
    // Purpose: To display the contents of a tabletop game description on the viewTGE.php page
    // Parameters: 
    //   <1> $TGE: the tabletop game entry being displayed
    // Returns: N/A
    // Side Effects: 
    //   <1> Displays the contents of a tabletop game description on the viewTGE.php page
    public function displayTGE(TGE $TGE) {
        $images = $TGE->getImages();

        echo '<!-- Container for tabletop game description -->
        <div class="elementContainer">
            
            <!--
                Display name, user who submitted
                and other information on one side
            -->
            <div class="innerContainer">
                <div class="name">' . $TGE->getGameTitle() . '</div>
                Submitted by ' . $TGE->getScreenName() . ' on ' . $TGE->getDateSubmitted() . '<br>
                Rating: ' . round($TGE->getOverallRating(), 1) . '<br>
                Company: ' . $TGE->getCompany() . ' <br>
                Play Time: ' . $TGE->getPlayTime() . ' hours <br>
                Age Rating: ' . $TGE->getAgeRating() . '+ <br>
                Number of Players: ' . $TGE->getNumPlayers() . ' <br>
                Expansions: ' . $TGE->getExpansions() . ' <br>
            </div>

            <!-- 
                The game description itseld on
                the other (right) side
            -->
            <div class="innerContainer">
                <p><br>
                '. $TGE->getDescription() .'    
                </p>
            </div>
            <a href="reviewTG.php?gameTitle=' . htmlspecialchars($TGE->getGameTitle()) . '" class="navButton">Leave A Review!</a>
        </div>

        <!-- Container for images of the tabletop game-->
        <div class="imageContainer">
            <!-- Images of the boardgame, ideally should appear
             as four in a row-->';
        
        foreach ($images as $displayImages)
             echo '<img class="image" src="' . $displayImages . '" alt="Image for ' . $TGE->getGameTitle() . '"/>';
             
        echo '</div>';
    }
}