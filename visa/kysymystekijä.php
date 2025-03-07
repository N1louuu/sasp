<?php

require "DBfunctions.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>AAA</title>
</head>
<body>
    
<form action="" method="post" class="container-xl">
    <label for="question">Question:</label>
    <input type="text" name="question" class="form-control">

    <label for="a1">awnser1:</label>
    <input type="text" name="a1" class="form-control">

    <label for="a2">awnser2:</label>
    <input type="text" name="a2" class="form-control">

    <label for="a3">awnser3:</label>
    <input type="text" name="a3" class="form-control">

    <label for="a4">awnser4:</label>
    <input type="text" name="a4" class="form-control">

    <label for="correct">oikea:</label>
    <select name="correct" class="form-control" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>

    <input type="submit" name="" id="" class="form-control btn btn-primary mt-3">
</form>

<a href="index.php">ei kys</a>

<?php

if (isset($_POST["question"], $_POST["a1"], $_POST["a2"], $_POST["a3"], $_POST["a4"], $_POST["correct"])) {
    $question = $_POST["question"];
    $a1 = $_POST["a1"];
    $a2 = $_POST["a2"];
    $a3 = $_POST["a3"];
    $a4 = $_POST["a4"];
    $correct = $_POST["correct"];

    insertNewQuestion($question, $a1, $a2, $a3, $a4, $correct);
}

?>

</body>
</html>