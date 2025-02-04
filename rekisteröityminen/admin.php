<?php

require "dbfunctions.php";

if (isset($_COOKIE["username"], $_COOKIE["password"])) {
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];

    // echo "session account    user: " . $username;
} else {
    echo "GO AWAY";
    header("Location: /index.php");
}

if (isset($_POST["logout"])) {
    setcookie("username","", time() -1800);
    setcookie("password","", time() -1800);
    setcookie("enimi","", time() -1800);
    setcookie("snimi","", time() -1800);
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
    <title>admin!!!!!!!!</title>
</head>
<body>
    <div class="m-3">
        <?php
            echo "<div class='card p-1'>";
            echo "username: " . $_COOKIE["username"] . "<br>";
            echo "first: " . $_COOKIE["enimi"] . "<br>";
            echo "last: " . $_COOKIE["snimi"] . "<br>";
            echo "</div>";
        ?>
        <form action="" method="post" class="w-100 d-flex flex-column">
            <input type="submit" class="btn btn-danger mt-2" value="logout" name="logout">
        </form>
    </div>
</body>
</html>