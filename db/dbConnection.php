<?php
    class Connection {
        private $conn;
        public function __construct(){
            $this->conn = new mysqli("localhost","root","","appointmentsmanager");
        }
        public function getConnection(){
            return $this->conn;
        }
    }
?>