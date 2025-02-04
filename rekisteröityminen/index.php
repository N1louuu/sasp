<?php

require "dbfunctions.php";

if (isset($_COOKIE["username"], $_COOKIE["password"])) {
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];

    echo "session account    user: " . $username;
    header("Location: /admin.php");
}

if (isset($_POST["username"], $_POST["password"])) {
    $username = cleanUpInput($_POST["username"]);
    $password = cleanUpInput($_POST["password"]);

    $user = login($username, $password);

    if ($user) {
        setcookie("username",$username, time() +1800);
        setcookie("password",$password, time() +1800);
        setcookie("enimi",$user["firstname"], time() +1800);
        setcookie("snimi",$user["lastname"], time() +1800);
        echo "logged in   user: ". $username;
        header("Location: /admin.php");
    } else {
        echo "ei toiminu";
    }

}

if (isset($_POST["logout"])) {
    setcookie("username","", time() -1800);
    setcookie("password","", time() -1800);
    setcookie("enimi","", time() -1800);
    setcookie("snimi","", time() -1800);
    header("Refresh:0");
}

if (isset($_POST["register"])) {
    header("Location: /register.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Samasana</title>
</head>
<body>
    <div class="m-3">
        <form action="" method="post" class="w-100 d-flex flex-column">
            <label for="username">username: </label>
            <input type="text" name="username" class="form-control">

            <label for="password">password: </label>
            <input type="password" name="password" class="form-control">

            <input type="submit" class="btn btn-primary mt-2" value="login">
        </form>
        <form action="" method="post" class="w-100 d-flex flex-column">
            <input type="submit" class="btn btn-success mt-2" value="register" name="register">
        </form>
    </div>
</body>
</html>