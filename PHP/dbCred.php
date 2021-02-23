<?php
    //Database class
    //Used for dependency injection for all other classes
    class database {
        //Member variables that define a db connection
        private $host = NULL;
        private $userName = NULL;
        private $userPW = NULL;
        private $dbName = NULL;

        // Function Name: Constructor
        // Purpose: To set the member variables to the login credentials for the database
        // Parameters: None
        // Returns: N/A
        // Side Effects: 
        //   <1> The member variables are set to the login credentials for connecting to the database
        function __construct() {
            $this->host = "localhost";
            $this->userName = "geekagog";
            $this->userPW = "5i4C-o5tN)7MhA";
            $this->dbName = "geekagog_QueenCityGambit";
        }

        // Function Name: dbConnect
        // Purpose: To connect to the database 
        // Parameters: None
        // Returns:
        //   <1> A database connection object (mysqli)
        // Side Effects:
        //   <1> A connection is created to the database
        public function dbConnect () {
            return new mysqli($this->host, $this->userName, $this->userPW, $this->dbName);
        }
    }
    
?>