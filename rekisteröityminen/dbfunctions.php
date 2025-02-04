<?php

function connect() {
    $servername = "nilsch24.treok.io";
    $username = "nilsch24_users";
    $password = "UJ(]LkdS?_;x";
    //$port = 3306;
    $dbname = "nilsch24_users";

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

function cleanUpInput($userinput){
    $input = trim($userinput);
    $cleaninput = filter_var($input,FILTER_SANITIZE_STRING);
    return $cleaninput;
}

function hashPassword($password){
    $password = trim($password);
    $hashedpassword = password_hash($password,PASSWORD_DEFAULT);
    return $hashedpassword;
}

function addUser($firstname, $lastname, $username, $password){
    $pdo = connect();
    $hashedpassword = hashPassword($password);
    $data = [$firstname, $lastname, $username, $hashedpassword];
    $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES(?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function login($username, $password){
    $pdo = connect();
    $sql = "SELECT * FROM users WHERE username=?";
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