<?php

function connect() {
    $servername = "nilsch24.treok.io";
    $username = "nilsch24_resepti";
    $password = "B(.GEffntg,=";
    //$port = 3306;
    $dbname = "nilsch24_reseptipankki";

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

function insertNewUser($name, $password, $email, $year) {
    $name = cleanUpInput($name);
    $password = cleanUpInput($password);
    $email = cleanUpInput($email);
    $year = cleanUpInput($year);
    $pdo = connect();
    $sql = "INSERT INTO users (`username`, `password`, `sähköposti`, `syntymävuosi`) VALUES (?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $password, $email, $year]);
    return $ok;
}

function login($username, $password){
    $username = cleanUpInput($username);
    $password = cleanUpInput($password);
    $pdo = connect();
    $sql = "SELECT * FROM users WHERE `username`=?";
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