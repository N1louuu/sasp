<?php

function connect() {
    $servername = "nilsch24.treok.io";
    $username = "nilsch24_dnd";
    $password = "E#E8?lj6Q.K9";
    //$port = 3306;
    $dbname = "nilsch24_dnd";

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

function getClasses() {
    $pdo = connect();
    $sql = "SELECT * FROM class";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
}

function insertNewClass($classname) {
    $pdo = connect();
    $sql = "INSERT INTO class (`classname`) VALUES (?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$classname]);
    return $ok;
}

function deleteClass($id) {
    $pdo = connect();
    $sql = "DELETE FROM class WHERE classid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}


function getRace() {
    $pdo = connect();
    $sql = "SELECT * FROM `race`";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
}

function insertNewRace($racename) {
    $pdo = connect();
    $sql = "INSERT INTO race (`racename`) VALUES (?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$racename]);
    return $ok;
}

function deleteRace($id) {
    $pdo = connect();
    $sql = "DELETE FROM race WHERE raceid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}




function getCharacters() {
    $pdo = connect();
    $sql = "SELECT * FROM `character`";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
}



?>