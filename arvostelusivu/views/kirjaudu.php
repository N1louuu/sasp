<?php

require "partials/head.php"

?>

<div class="d-flex justify-content-around w-100 mt-3">
    <h1>KIRJAUDU</h1>
</div>

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
    $sana = $_POST["pass"];
    if (login($nimi, $sana)) {
        echo "works";
        $_SESSION["name"] = $nimi;
        $_SESSION["pass"] = $sana;
        header('Location: /arvostelu.php');
    } else {
        echo "<p class='mx-3 text-danger'>Väärä salasana tai nimi</p>";
    }
}

require "partials/footer.php"

?>