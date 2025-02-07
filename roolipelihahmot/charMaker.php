<?php

require "dbfunctions.php";

$characters = getCharacters();

$classes = getClasses();

$races = getRace();

function editModal() {
    global $characters, $classes, $races;
    echo '
    <div class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>';
}
function printCharacters($characters) {
    echo "<div class='h-100 d-flex flex-row flex-wrap gap-2'>";
    foreach ($characters as $char) {
        echo "<div class='card h-100 p-2' style='width: calc(25% - 6px)'>";
        echo "<h5>". $char["name"] ."</h5>";
        echo "<p>Luokka: ". $char["classname"] ."</p>";
        echo "<p>Rotu: ". $char["racename"] ."</p>";
        echo "<ul>";
        echo "<li><p class='m-0'>str: ". $char["strength"] ."</p></li>";
        echo "<li><p class='m-0'>dex: ". $char["dexterity"] ."</p></li>";
        echo "<li><p class='m-0'>wiz: ". $char["wisdom"] ."</p></li>";
        echo "</ul>";


        echo "<div class='d-flex flex-row justify-content-between'>";
        echo "  <button onclick='showEdit(\"".$char["name"]."\", ".$char["strength"].", ".$char["dexterity"].", ".$char["wisdom"].", ".$char["characterid"].")' data-bs-toggle='modal' class='btn btn-primary w-50 btn-sm m-1 text-nowrap' data-bs-target='#exampleModal'>muokkaa</button>";
        echo "  <form method='post' class='w-50 m-1'>
                    <input hidden name='characterid' value='".$char["characterid"]."'>
                    <input type='submit' name='poista' value='posta' class='btn btn-danger btn-sm w-100'>
                </form>";
        echo "</div>";

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

    echo '<label for="class" class="ms-2">Luokka</label>';
    echo '<select name="class" class="m-2">';
    foreach ($classes as $class) {
        echo '<option value='.$class["classid"].'>'.$class["classname"].'</option>';
    }
    echo "</select>";
}

if (isset($_POST["newChar"], $_POST["name"])) {
    $name = $_POST["name"];
    $class = $_POST["class"];
    $race = $_POST["race"];

    insertNewChar($name, 0, 0, 0, $class, $race);
    header("Refresh:0");
}

if (isset($_POST["poista"])) {
    $id = $_POST["characterid"];

    deleteChar($id);
    header("Refresh:0");
}

if (isset($_POST["str"], $_POST["dex"], $_POST["int"], $_POST["charId"])) {
    $id = $_POST["charId"];
    $str = $_POST["str"];
    $dex = $_POST["dex"];
    $int = $_POST["int"];

    updateChar($str, $dex, $int, $id);
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
    <script defer src="main.js"></script>
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
            <input type="submit" value="create" name="newChar" class="btn btn-warning m-2">
        </form>
    </div>
    <div class="mt-3">
        <?php
        printCharacters($characters);
        ?>
    </div>
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTitle">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" class="d-flex flex-row flex-wrap" id="editForm">
            <input hidden type="number" name="charId" id="charachterid-input">

            <label for="str" class="w-25 text-center mt-2">str: </label>
            <input type="number" name="str" class="form-control w-75 mt-2" id="str-input" onchange="StatCheck('str-input', 'dex-input', 'int-input')" min="0">
            <label for="dex" class="w-25 text-center mt-2">dex: </label>
            <input type="number" name="dex" class="form-control w-75 mt-2" id="dex-input" onchange="StatCheck('dex-input', 'str-input', 'int-input')" min="0">
            <label for="int" class="w-25 text-center mt-2">wiz: </label>
            <input type="number" name="int" class="form-control w-75 mt-2" id="int-input" onchange="StatCheck('int-input', 'str-input', 'dex-input')" min="0">

            <p class="w-25 text-center mt-2">total: </p>
            <p class="w-75 mt-2" id="6000"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitModal()">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>