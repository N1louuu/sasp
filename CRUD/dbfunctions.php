<?php

function connect() {
    $servername = "nilsch24.treok.io";
    $username = "nilsch24_sasp";
    $password = "v}PrFPu?OLU8";
    //$port = 3306;
    $dbname = "nilsch24_db-sasp";

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

function getAllGames() {
    $pdo = connect();
    $sql = "SELECT * FROM test_games";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
}

function getGameById($id) {
    $pdo = connect();
    $sql = "SELECT * FROM test_games WHERE gameid=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $game = $stm->fetch(PDO::FETCH_ASSOC);
    return $game;
}

function insertNewGame($name, $company, $release) {
    $pdo = connect();
    $sql = "INSERT INTO test_games (`name`, company, `release`) VALUES (?, ?, ?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $company, $release]);
    return $ok;
}

function updateGame($name, $company, $release, $id) {
    $pdo = connect();
    $sql = "UPDATE test_games SET `name`=?, company=?, `release`=? WHERE gameid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $company, $release, $id]);
    return $ok;
}

function deleteGame($id) {
    $pdo = connect();
    $sql = "DELETE FROM test_games WHERE gameid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}  

?>