<?php

$id = session_id();

if (isset($_POST["info"])) {
    $info = $_POST["info"];
    setcookie("our_cookie",$info, time() +1800);
    header("Refresh:0");
}

if (isset($_POST["poista"])) {
    setcookie("our_cookie","", time() -1800);
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
    <title>evästeet</title>
</head>
<body>
    <div class="d-flex flex-column m-3">
        <form action="" method="post" class="w-100 d-flex flex-column">
            <label for="info"></label>
            <input type="text" name="info" class="form-control">
            <input type="submit" name="submit" value="tallenna" class="btn btn-primary mt-2">
        </form>
        <form action="" method="post" class="w-100 d-flex flex-column">
            <input type="submit" name="poista" value="poista" class="btn btn-danger mt-2">
        </form>
    </div>

    <div class="m-3">
        <h1>SAVED info:</h1>
        <?php
            if (isset($_COOKIE["our_cookie"])) {
                echo $_COOKIE["our_cookie"];
            } else {
                echo "ei infoa";
            }
        ?>
    </div>

</body>
</html>