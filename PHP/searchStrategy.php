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

class userSearch extends searchStrategy {
    public function getResults($query) {}

    public function displayResults($dbReturn) {}
}

?>