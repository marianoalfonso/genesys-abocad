<?php

    class ConectarDB {
        protected $dbh;
        protected function Conexion() {
            try {
                $conectar = $this->dbh = new PDO("mysql:host=localhost;dbName=appointmentsManager;charset=utf8", "root", "");
                return $conectar;
            } catch (Exception $ex) {
                print "error conectando a la base de datos: " . $ex->getMessage() . "<br/>";
                die();
            }
            
        }
    }
    
?>