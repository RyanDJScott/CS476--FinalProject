<?php
include './searchStrategy.php';

//Make a search object for users
$userSearch = new Search("USER", "Betrayal");

$resultUser = $userSearch->publishResults();

var_dump($resultUser);

echo '<br><br>';

//Make a search object for games
$gameSearch = new Search("GAME", "Tokaido");

$resultGame = $gameSearch->publishResults();

var_dump($resultGame);

echo '<br><br>';

//Make a search object for both
$gameSearch = new Search("BOTH", "Tokaido");

$resultBoth = $gameSearch->publishResults();

var_dump($resultBoth);

?>