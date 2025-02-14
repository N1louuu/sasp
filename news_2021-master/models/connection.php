<?php
function connect() {
        $servername = "nilsch24.treok.io";
        $username = "nilsch24_arvostelu";
        $password = "a.Y^~eYaz6Vz";
        //$port = 3306;
        $dbname = "nilsch24_arvostelu";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    function getUsers() {
        $pdo = connect();
        $sql = "SELECT * FROM users";
        $stm = $pdo->query($sql);
        $games = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $games;
    }

?>