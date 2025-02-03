<?php

require "dbfunctions.php";

$pdo = connect();

$games = getAllGames();

function printAllGames( $games ) {
    foreach ($games as $game) {
        echo "<div class='card d-flex flex-row justify-content-between'>";
        foreach ($game as $thing) {
            echo "<p>" . $thing . " </p>";
        }
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='id' value='" . $game["gameid"] . "'>";
        echo "<input type='submit' value='poista' name='delete' class='btn btn-danger'>";
        echo "</form>";
        echo "</div>";
        echo "<br>";
    }
    
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    deleteGame($id);
}

if (isset($_POST["name"]) && isset($_POST["company"]) && isset($_POST["release"])) {
    $name = $_POST["name"];
    $company = $_POST["company"];
    $release = $_POST["release"];
    insertNewGame($name, $company, $release);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>sasp</title>
</head>
<body>
    <div class="d-flex flex-row">
        <div class="w-50 m-2">
            <h1>All Games</h1>
            <?php
                printAllGames($games);
            ?>
        </div>
        <form class="w-50 m-5 d-flex flex-column" action="" method="post">
            <h1>Create a new game</h1>
            
            <label for="name">nimi: </label>
            <input type="text" name="name" class="form-control">
            
            <label for="company">company: </label>
            <input type="text" name="company" class="form-control">
            
            <label for="release">release: </label>
            <input type="number" name="release" class="form-control">
            
            <input type="submit" class="btn btn-primary mt-2" value="uusi">
        </form>
    </div>

</body>
</html>