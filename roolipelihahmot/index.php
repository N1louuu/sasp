<?php

require "dbfunctions.php";

$character = getCharacters();

$classes = getClasses();

$races = getRace();

function printClasses($classes) {
    echo "<ul>";
    foreach ($classes as $class) {
        echo "<li>";
        echo "<form action='' method='post' class='d-flex flex-row justify-content-between'>";
        echo $class["classname"];
        echo '<input hidden type="text" name="id" value='.$class["classid"].'>';
        echo '<input type="submit" class="" value="poista" name="poista">';
        echo "</form>";
        echo "</li>";
    }
    echo "</ul>";
}

if (isset($_POST["luokan_nimi"])) {
    $classname = $_POST["luokan_nimi"];

    insertNewClass($classname);
    header("Refresh:0");
}

if (isset($_POST["poista"])) {
    $classid = $_POST["id"];
    deleteClass($classid);
    header("Refresh:0");
}

function printRaces($races) {
    echo "<ul>";
    foreach ($races as $race) {
        echo "<li>";
        echo "<form action='' method='post' class='d-flex flex-row justify-content-between'>";
        echo $race["racename"];
        echo '<input hidden type="text" name="id" value='.$race["raceid"].'>';
        echo '<input type="submit" class="" value="poista" name="poista_rotu">';
        echo "</form>";
        echo "</li>";
    }
    echo "</ul>";
}

if (isset($_POST["rodun_nimi"])) {
    $rodun_nimi = $_POST["rodun_nimi"];

    insertNewRace($rodun_nimi);
    header("Refresh:0");
}

if (isset($_POST["poista_rotu"])) {
    $raceid = $_POST["id"];
    deleteRace($raceid);
    header("Refresh:0");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>roolipeli hahmot</title>
</head>
<body>
    <div class="d-flex flex-row">
        <div class="m-3 w-50">
            <h2>Luokat</h2>
            <h3>Lisää luokka</h3>
            <form class="w-100 d-flex flex-column" action="" method="post">           
                <label for="luokan_nimi">Luokan nimi: </label>
                <input type="text" name="luokan_nimi" class="form-control">
                
                <input type="submit" class="btn btn-primary mt-2" value="Lisää">
            </form>

            <h3>Luokat</h3>
            <?php
                printClasses($classes);
            ?>
        </div>

        <div class="m-3 w-50">
            <h2>Rodut</h2>
            <h3>Lisää rotu</h3>
            <form class="w-100 d-flex flex-column" action="" method="post">           
                <label for="rodun_nimi">Rodun nimi: </label>
                <input type="text" name="rodun_nimi" class="form-control">
                
                <input type="submit" class="btn btn-primary mt-2" value="Lisää">
            </form>

            <h3>Rodut</h3>
            <?php
                printRaces(races: $races);
            ?>
        </div>
    </div>


</body>
</html>