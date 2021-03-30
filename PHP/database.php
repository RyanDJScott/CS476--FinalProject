<?php
    class database {
        //Member variables that define a db connection
        private $dbConnect = NULL;

        // Function Name: Constructor
        // Purpose: To open a database connection and store it in a member variable
        // Parameters: None
        // Returns: N/A
        // Side Effects: 
        //   <1> The member variables are set to the login credentials for connecting to the database
        public function __construct() {
            $this->dbConnect = new mysqli("", "", "", "");
        
            //Check the connection
            if ($this->dbConnect->connect_error) 
                die("There was an error connecting to the DB:" . $this->dbConnect->connect_error);   
        }

        // Function Name: getDBConnection
        // Purpose: To return the DB connection to the caller
        // Parameters: None
        // Returns:
        //   <1> $this->dbConnect
        // Side Effects: N/A
        public function getDBConnection () {
            return $this->dbConnect;
        }

        //Function Name: wakeup
        //Purpose: To re-establish the DB connection when the object is unserialized
        //Parameters: None
        //Returns: None
        //Side Effects:
        //   <1> $this->dbConnect is reinitialized with a DB object
        public function __wakeup()
        {
            $this->dbConnect = new mysqli("localhost", "geekagog", "5i4C-o5tN)7MhA", "geekagog_QueenCityGambit");
        }
    }
    
?>