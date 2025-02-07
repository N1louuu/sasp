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
    $sql = "SELECT * FROM `character`
    INNER JOIN class ON class.classid = character.classid
    INNER JOIN race ON race.raceid = character.raceid;";
    $stm = $pdo->query($sql);
    $games = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $games;
}

function insertNewChar($name, $str, $dex, $int, $class, $race) {
    $pdo = connect();
    $sql = "INSERT INTO `character` (`name`, strength, dexterity, wisdom, classid, raceid) VALUES (?, ?, ?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $str, $dex, $int, $class, $race]);
    return $ok;
}

function deleteChar($id) {
    $pdo = connect();
    $sql = "DELETE FROM `character` WHERE characterid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}

function updateChar($str, $dex, $int, $id) {
    $pdo = connect();
    $sql = "UPDATE `character` SET `strength`=?, dexterity=?, `wisdom`=? WHERE characterid=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$str, $dex, $int, $id]);
    return $ok;
} 

?>