<!DOCTYPE html>
<html lang="fi">
<head>
    <title>reseptit 😊😁👍</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="js/main.js"></script>
</head>
<body>
<script>

function modalinfoX(user, name, type, rating, given_review, id) {

}

function submitForm($form) {
    document.getElementById($form).submit();
}

</script>

<header class="w-100 bg-primary">
    <div class="d-flex flex-row justify-content-around">
        <button onclick="noNewTab('etusivu.php')" style="background: none; border: none;">
            <h1>reseptit</h1>
        </button>
        <div class="d-flex flex-row m-3 justify-content-between w-50">
            <button onclick="noNewTab('kategoriasivu.php')" style="background: none; border: none;">
                <h3>kategoriasivu</h3>
            </button>
            <button onclick="noNewTab('yhteystietosivu.php')" style="background: none; border: none;">
                <h3>yhteystietosivu</h3>
            </button>
            <?php
            if (isset($_SESSION["username"], $_SESSION["password"])) {
                echo "
                <button onclick=\"noNewTab('reseptin_luoimissivu.php')\" style='background: none; border: none;'>
                <h3>luo resepti</h3>
                </button>
                <button onclick=\"noNewTab('omat_tiedot.php')\" style='background: none; border: none;'>
                <h3>oma sivu - ".$_SESSION["username"]."</h3>
                </button>
                ";
            } else {
                echo "
                <button data-bs-toggle='modal' data-bs-target='#exampleModal' style=\"background: none; border: none;\">
                <h3>kirjaudu</h3>
                </button>
                ";
            }
            ?>
        </div>
    </div>
</header>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="d-flex flex-row justify-content-between">
                <h1 class="modal-title fs-5" id="modalTitle">Kirjaudu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form action="" method="post" class=" d-flex flex-column mx-5 p-2" id="editForm">
            <label for="username_login">username:</label>
            <input type="text" name="username_login" class="form-control" id="modalname">

            <label for="password_login">password:</label>
            <input type="password" name="password_login" class="form-control" id="modalrating" min="0" max="5">

            <button type="submit" class="btn btn-primary form-control mt-2">kirjaudu</button>
        </form>
        </div>
    </div>
  </div>
</div>

<?php

if (isset($_POST["username_login"], $_POST["password_login"])) {
    $nimi = $_POST["username_login"];
    $sana = $_POST["password_login"];
    if (login($nimi, $sana)) {
        echo "works";
        $user = login($nimi, $sana);
        $_SESSION["username"] = $nimi;
        $_SESSION["password"] = $sana;
        $_SESSION["userid"] = $user["id"];
        header("Refresh:0");
    } else {
        echo "<p class='mx-3 text-danger'>Väärä salasana tai nimi</p>";
    }
}

?>