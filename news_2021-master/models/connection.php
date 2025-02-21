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

    function insertNewUser($name, $password) {
        $name = cleanUpInput($name);
        $password = cleanUpInput($password);
        $pdo = connect();
        $sql = "INSERT INTO users (`name`, `password`) VALUES (?, ?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute([$name, $password]);
        return $ok;
    }

    function insertNewReview($type, $title, $rating, $review) {
        $pdo = connect();
        $date = date("Y/m/d");
        $sql = "INSERT INTO arvostelu (`date`, `type`, `name`, `rating`, `review`) VALUES (?, ?, ?, ?, ?)";
        $stm = $pdo->prepare($sql);
        $ok = $stm->execute([$date, $type, $title, $rating, $review]);
        return $ok;
    }

    function cleanUpInput($userinput){
        $input = trim($userinput);
        $cleaninput = filter_var($input,FILTER_SANITIZE_STRING);
        return $cleaninput;
    }

    function login($username, $password){
        $username = cleanUpInput($username);
        $password = cleanUpInput($password);
        $pdo = connect();
        $sql = "SELECT * FROM users WHERE `name`=?";
        $stm= $pdo->prepare($sql);
        $stm->execute([$username]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);
        $hashedpassword = "";
        if (isset($user["password"])) {
            $hashedpassword = $user["password"];
        }
    
        if($hashedpassword && password_verify($password, $hashedpassword))
            return $user;
        else 
            return false;
    }


?>