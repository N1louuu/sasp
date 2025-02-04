<?php

require "dbfunctions.php";

if (isset($_POST["username"], $_POST["password"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $enimi =  $_POST["enimi"];
    $snimi = $_POST["snimi"];

    addUser($enimi, $snimi,  $username, $password);

}

if (isset($_POST["nvm"])) {
    header("Location: /index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="m-3">
        <form action="" method="post" class="w-100 d-flex flex-column">
            <h1>Create new user</h1>

            <label for="enimi">etunimi:</label>
            <input type="text" name="enimi" class="form-control">

            <label for="enimi">sukunimi:</label>
            <input type="text" name="snimi" class="form-control">

            <label for="enimi">username:</label>
            <input type="text" name="username" class="form-control">

            <label for="enimi">password:</label>
            <input type="text" name="password" class="form-control">
            <input type="submit" class="btn btn-primary mt-2" value="create">
        </form>
        <form action="" method="post" class="w-100 d-flex flex-column">
            <input type="submit" class="btn btn-secondary mt-2" value="back" name="nvm">
        </form>
    </div>
</body>
</html>