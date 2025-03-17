<?php

session_start();
$id = session_id();
require "DBfunctions.php";

$questions = getAllQuestion();

if ($_SESSION["count"] >= 10) {
    header('Location: /loppuruutu.php');
}

function printAllQuestions($questions) {
    foreach ($questions as $q) {
        foreach ($q as $t) {
            echo "<p>".$t."</p><br>";
        }
    }
}

$correct = $questions[$_SESSION["order"][$_SESSION["count"]]]["correct"];

function printQuestion($q, $correct) {
    echo 
    "<form action='' method='post' id='queston' class='container-xl d-flex flex-column justify-content-center mt-5'>".
    "<input type='text' value='".$q["id"]."' name='queston' class='d-none'>".
    "<input type='text' name='ans' id='ans' class='d-none'>".
    "<h1 class='text-center'>". $q["question"] ."</h1>".
    "<div class='container-xl d-flex flex-row justify-content-between mt-5'>".
    "<button type='button' Onclick='submitAnswer(\"queston\", 1, \"a".$correct."\", \"a1\")' class='btn' id='a1'><h3 class='text-center'>". $q["answer1"] ."</h3></button>".
    "<button type='button' Onclick='submitAnswer(\"queston\", 1, \"a".$correct."\", \"a2\")' class='btn' id='a2'><h3 class='text-center'>". $q["answer2"] ."</h3></button>".
    "</div>".
    "<div class='container-xl d-flex flex-row justify-content-between mt-5'>".
    "<button type='button' Onclick='submitAnswer(\"queston\", 1, \"a".$correct."\", \"a3\")' class='btn' id='a3'><h3 class='text-center'>". $q["answer3"] ."</h3></button>".
    "<button type='button' Onclick='submitAnswer(\"queston\", 1, \"a".$correct."\", \"a4\")' class='btn' id='a4'><h3 class='text-center'>". $q["answer4"] ."</h3></button>".
    "</div>".
    "</form>";
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>HMMMMmmmmmmmmmmm???</title>
    <script src="main.js" defer></script>
</head>

<body>

<div class="d-flex flex-column align-items-center justify-content-center w-100 mt-5">
    <?php
        echo $_SESSION["count"] . "/10";
    ?>
</div>

<?php

printQuestion($questions[$_SESSION["order"][$_SESSION["count"]]], $correct);

?>

<form action="" method="post" class="mt-5 d-flex justify-content-center flex-column align-items-center">
    <h1 id='koma'></h1>
    <input type='text' name='ans' id='tulos' style="display: none" value='hai'>
    <input type="submit" value="next" name="next" id="next" class="btn btn-primary w-25" style="display: none">
</form>

<?php

if (isset($_POST["next"])) {
    $_SESSION["count"]+=1;
    if ($_POST["ans"] == "true") {
        $_SESSION["points"]+=1;
    }
    header("Refresh:0");
}

?>
</body>
</html>