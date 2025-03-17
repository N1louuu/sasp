<?php

session_start();
$id = session_id();

require "DBfunctions.php";

function startGame() {
    $questions = getAllQuestion();
    $questions_save = getAllQuestion();

    $order = array();
    $go = count($questions);
    for ($i=0; $i < $go; $i++) { 
        $random = rand(0, count($questions)-1);

        array_push($order, array_search($questions[$random], $questions_save));
        // echo $questions[$random]["question"] . "<br>";
        array_splice($questions, $random, 1);
    }
    $_SESSION["order"] = $order;
    $_SESSION["count"] = 0;
    $_SESSION["points"] = 0;
    $_SESSION["next"] = false;
    header('Location: /kysymykset.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>Visa</title>
</head>
<body>
    <div class="d-flex flex-column align-items-center justify-content-center w-100 mt-5">
        <h1>VISA</h1>
        <a href="kysymystekijä.php">tee kys</a><br>

        <form action="" method="post">
            <input type="submit" name="play" value="pelaa!" class="form-control btn btn-primary">

        </form>
    </div>
<?php

if (isset($_POST["play"])) {
    startGame();
}

?>

</body>
</html>