<?php
include './userFactory.php';

//Construct all four users in the DB
$commUserFactory = new communityUserFactory();
$user5 = $commUserFactory->makeUser(5);


//Output the information for each user
echo '<h2>User: '.$user5->getScreenName().'</h2>';
echo '<p>User Name: '.$user5->getFirstName(). ' '.$user5->getLastName().'</p>';
echo '<p>Birthday: '.$user5->getBirthday().'</p>';
echo '<p>Email: '.$user5->getEmail().'</p>';
echo '<p>Avatar URL: '.$user5->getAvatarURL().'</p>';
echo '<p>Biography: '.$user5->getBiography().'</p>';
echo '<p>Favourite Game: '.$user5->getFavGame().'</p>';
echo '<p>Fav. Game Type: '.$user5->getGameType().'</p>';
echo '<p>Time spent playing games: '.$user5->getPlayTime().'</p>';
echo '<p>Last Login: '.$user5->getLastLogin().'</p>';
echo '<br><br>';

//Change the information
$newScreenname = $user5->setScreenName("Geek-A-GoGo");
$newFirstName = $user5->setFirstName("Ryan");
$newLastName = $user5->setLastName("Scott");
$newBirthday = $user5->setBirthday("1987-10-14");
$newEmail = $user5->setEmail("ryan.dj.scott@gmail.com");
$newAvatarURL = $user5->setAvatarURL("uploads/UserPics/ryan.jpg");
$newBiography = $user5->setBiography("Hey everyone! My name is Ryan and I am testing setters!");
$newFavGame = $user5->setFavGame("Betrayal at House on the Hill");
$newGameType = $user5->setGameType("Strategy Co-op Board Game");
$newTime = $user5->setPlayTIme("0-1");
$newLastLogin = $user5->setLastLogin("NOW()");

//Output the information for each user
echo '<h2>User: '.$user5->getScreenName().'</h2>';
echo '<p>User Name: '.$user5->getFirstName(). ' '.$user5->getLastName().'</p>';
echo '<p>Birthday: '.$user5->getBirthday().'</p>';
echo '<p>Email: '.$user5->getEmail().'</p>';
echo '<p>Avatar URL: '.$user5->getAvatarURL().'</p>';
echo '<p>Biography: '.$user5->getBiography().'</p>';
echo '<p>Favourite Game: '.$user5->getFavGame().'</p>';
echo '<p>Fav. Game Type: '.$user5->getGameType().'</p>';
echo '<p>Time spent playing games: '.$user5->getPlayTime().'</p>';
echo '<p>Last Login: '.$user5->getLastLogin().'</p>';
echo '<br><br>';

