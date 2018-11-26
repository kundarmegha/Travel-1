<?php  
    class dbConnect {  
        public $conn;
        function __construct() {  

<<<<<<< HEAD
            $this->conn = new mysqli("localhost", "root", "Abcd@123", "Travel");
=======
            $this->conn = new mysqli("localhost", "root", "root", "Travel");
>>>>>>> 27811a8373c819429dcb2787841f98e754629ba3
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
            return $this->conn;    
        }  
        public function Close(){  
            mysqli_close();  
        }  
        
    }  
?> 