<?php

require "dbfunctions.php";

$characters = getCharacters();

$classes = getClasses();

$races = getRace();


function printCharacters($characters) {
    echo "<div class='h-100'>";
    foreach ($characters as $char) {
        echo "<div class='card h-100 w-25'>";
        echo "<p>". $char["name"] ."</p>";
        echo "</div>";
    }
    echo "</div>";
}

function typesQuestion() {
    $classes = getClasses();
    $races = getRace();

    echo '<label for="race" class="ms-2">Rotu</label>';
    echo '<select name="race" class="m-2">';
    foreach ($races as $race) {
        echo '<option value='.$race["raceid"].'>'.$race["racename"].'</option>';
    }
    echo "</select>";

    echo '<label for="race" class="ms-2">Luokka</label>';
    echo '<select name="class" class="m-2">';
    foreach ($classes as $class) {
        echo '<option value='.$class["classid"].'>'.$class["classname"].'</option>';
    }
    echo "</select>";
}

if (isset($_POST[""]))

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
<?php
require "header.php"
?>
<main class="m-3">
    <div class="card bg-light">
        <form action="" method="post" class="d-flex flex-column">
            <?php
            typesQuestion();
            ?>
            <label for="name" class="ms-2">Nimi</label>
            <input type="text" name="name" class="m-2">
            <input type="submit" value="create" class="btn btn-warning m-2">
        </form>
    </div>
    <div class="mt-3">
        <?php
        printCharacters($characters);
        ?>
    </div>
</main>
</body>
</html>