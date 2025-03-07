<?php

session_start();
$id = session_id();

echo $id;

require "DBfunctions.php";

function startGame() {
    $questions = getAllQuestion();
    $questions_save = getAllQuestion();

    $order = array();
    $go = count($questions);
    for ($i=0; $i < $go; $i++) { 
        $random = rand(0, count($questions)-1);

        array_push($order, array_search($questions[$random], $questions_save));
        // echo $questions[$random]["id"] . " " . count($questions) . "<br>";
        array_splice($questions, $random, 1);
    }
    $_SESSION["order"] = $order;
    $_SESSION["count"] = -1;
    $_SESSION["points"] = 0;
    header('Location: /kysymykset.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa</title>
</head>
<body>
    <h1>HELLO!??</h1>
    <a href="kysymystekijä.php">tee kys</a><br>

    <form action="" method="post">
        <input type="submit" name="play" value="pelaa!">

    </form>

<?php

if (isset($_POST["play"])) {
    startGame();
}

?>

</body>
</html>