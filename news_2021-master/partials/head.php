<!DOCTYPE html>
<html lang="fi">
<head>
    <title>arvostelu</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="js/main.js"></script>
</head>
<body>

    <header class="">
        <div class="row">
            <div class="col-sm">

            </div>
            <div class="col-sm">
                <button onclick="noNewTab('etusivu.php')" style="background: none; border: none;">
                    <h1>get gud</h1>
                </button>
            </div>
            <div class="col-sm">
                <button onclick="noNewTab('omasivu.php')" style="background: none; border: none;">
                    <?php
                if (isset($_SESSION["name"])) {
                    $name = $_SESSION["name"];
                    echo "<h3 class='text-center'>" . $name . "</h3>";
                } else {
                    echo "<h3 class='text-center'>not logged in</h3>";
                }
                ?>
            </div>

        </div>
    </header>
