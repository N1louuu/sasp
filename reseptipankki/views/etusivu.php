<?php

require "partials/head.php"

?>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="d-flex flex-row justify-content-between">
                <h1 class="modal-title fs-5" id="modalTitle">rekisteröidy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form action="" method="post" class=" d-flex flex-column mx-5 p-2" id="editForm">
            <label for="username">username:</label>
            <input type="text" name="username" class="form-control" required>

            <label for="password">password:</label>
            <input type="password" name="password" class="form-control" required>

            <label for="email">sähköposti:</label>
            <input type="text" name="email" class="form-control" required>

            <?php
            echo '<label>Syntymävuosi:</label>
            <select name="birthyear" data-component="date" class="form-control">';
            for ($year = 1900; $year <= date('Y'); $year++) {
            echo '<option value="'.$year.'">' . $year . '</option>';
            }
            echo "</select>";
            ?>

            <button type="submit" class="btn btn-success form-control mt-2">rekisteröidy</button>
        </form>
        </div>
    </div>
  </div>
</div>

<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>UMM GUYS??</h1>
    <button data-bs-toggle='modal' data-bs-target='#exampleModal2' style="background: none; border: none;">
        <h3>rekisteröidy</h3>
    </button>

<?php

if (isset($_POST["username"], $_POST["password"])) {
    $nimi = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $year = htmlspecialchars($_POST["birthyear"]);
    $users = getUsers();
    $yes = true;
    foreach ($users as $user) {
        if ($email == $user["sähköposti"]) {
            $yes = false;
            echo "<p class='text-danger'>käyttämälläsi sähköpostilla on jo käyttäjä</p>";
        }
    }
    foreach ($users as $user) {
        if ($nimi == $user["username"]) {
            $yes = false;
            echo "<p class='text-danger'>nimi on jo käytössä</p>";
        }
    }
    if (date('Y') - $year < 15) {
        $yes = false;
        echo "<p class='text-danger'>liian nuori</p>";
    }

    if ($yes) {
        $sana = hashPassword($_POST["password"]);
        insertNewUser($nimi, $sana, $email, $year);
    } else {
        echo "";
    }
}

$reseptit = getReseptit();

foreach ($reseptit as $resepti) {
    $kategoria = "";
    switch($resepti["kategoria"]) {
        case 1:
            $kategoria = "aamiainen";
            break;
        case 2:
            $kategoria = "pääruoka";
            break;
        case 3:
            $kategoria = "välipala";
            break;
        case 4:
            $kategoria = "jälkiruoka";
            break;
    }

    $user = getUserById($resepti["lisääjä"]);

    echo 
    "
    <div class='card m-2 p-2 w-50'>

    <form method='get' action='reseptin_katsomis_sivu.php' class='d-flex flex-row justify-content-between'>
        <input name='resepti_id' type='text' value=".$resepti["id"]." class='d-none'>
        <button style='background: none; border: none; '>
            <h1>".$resepti["nimi"]."</h1>
        </button>
        <h2>".$user["username"]."</h2>
    </form>
    <p class='fw-bold'>".$kategoria." - ".$resepti["lisäyspäivämäärä"]."</p>";
    /*<h4 class='fw-bold'>aineosat:</h4>";
    /*echo "<ul>";

    $word = "";
    foreach (mb_str_split($resepti["ainesosaluettelo"]) as $letter) {
        if ($letter == " ") {
            echo "<li>".$word."</li>";
            $word = " ";
        } else {
            if ($letter != "-") {
                $word .= $letter;
            } else {
                $word .= " - ";
            }
        }
    }
    echo "<li>".$word."</li>";

    echo "</ul>    
    <h4 class='fw-bold'>valmistusohjeet:</h4>
    <p>".$resepti["valmistusohjeet"]."</p>
    ";*/
    echo "</div>";
}

?>
</div>

<?php

require "partials/footer.php";


?>