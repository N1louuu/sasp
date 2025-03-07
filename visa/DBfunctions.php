<?php

function connect() {
    $servername = "nilsch24.treok.io";
    $username = "nilsch24_visaaja";
    $password = "]L~_tV&ztzzZ";
    //$port = 3306;
    $dbname = "nilsch24_visa";

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

function getAllQuestion() {
    $pdo = connect();
    $sql = "SELECT * FROM kysymykset";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
}

function insertNewQuestion($question, $awnser1, $awnser2, $awnser3, $awnser4, $correct) {
    $pdo = connect();
    $sql = "INSERT INTO kysymykset (`question`, `answer1`, `answer2`, `answer3`, `answer4`, `correct`) VALUES (?, ?, ?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$question, $awnser1, $awnser2, $awnser3, $awnser4, $correct]);
    return $ok;
}

?>