<?php

class Search {
    private $searchType;
    private $query;
    private $searchStrategy = NULL;
    
    public function __construct ($searchOption, $searchQuery) {}

    public function publishResults ($query) {}
}

interface searchStrategy {
    public function getResults($query);
    public function displayResults($dbReturn);
}

class userSearch implements searchStrategy {
    public function getResults($query) {}

    public function displayResults($dbReturn) {}
}

class gameSearch implements searchStrategy {
    public function getResults($querry) {}

    public function displayResults($dbReturn) {}
}

?>