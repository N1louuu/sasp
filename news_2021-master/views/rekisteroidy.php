<?php

require "partials/head.php"

?>

<h1>REKISTERÖIDY</h1>

<form action="" method="post" class="card d-flex flex-column mx-5 p-2">
    <label for="name">nimi:</label>
    <input type="text" name="name" class="form-control">
    <label for="pass">salasana:</label>
    <input type="password" name="pass" class="form-control">
    <input type="submit" class="btn btn-primary mt-2">
</form>

<?php

if (isset($_POST["name"], $_POST["pass"])) {
    $nimi = $_POST["name"];
    $sana = hashPassword($_POST["pass"]);
    insertNewUser($nimi, $sana);
}

require "partials/footer.php"

?>