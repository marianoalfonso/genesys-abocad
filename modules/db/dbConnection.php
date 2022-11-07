<?php
    class db {
        public static function conectar() {
            try {
                $host = 'localhost';
                $dbName = 'abocad';
                $dbUser = 'root';
                $dbPassword = '';
                $conn = new PDO('mysql:host=localhost; dbname=abocad', $dbUser, $dbPassword);
                return $conn;
            } catch (PDOException $error1) {
                echo 'no es posible conectarse con la base de datos ('.$error1->getMessage().')';
            } catch (Exception $error2) {
                echo 'error general ('.$error2->getMessage().')';
            }
        }
    }
?>