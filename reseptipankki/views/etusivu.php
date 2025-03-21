<?php

require "partials/head.php"

?>


<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>UMM GUYS??</h1>
    <button data-bs-toggle='modal' data-bs-target='#exampleModal2' style="background: none; border: none;">
        <h3>rekisteröidy</h3>
    </button>
</div>


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
            <input type="text" name="username" class="form-control">

            <label for="password">password:</label>
            <input type="password" name="password" class="form-control">

            <label for="email">sähköposti:</label>
            <input type="text" name="email" class="form-control">

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


<?php

require "partials/footer.php";

if (isset($_POST["username"], $_POST["password"])) {
    $nimi = $_POST["username"];
    $email = $_POST["email"];
    $year = $_POST["birthyear"];
    $users = getUsers();
    $yes = true;
    foreach ($users as $user) {
        if ($email == $user["username"]) {
            $yes = false;
        }
    }
    if (!$yes) {
        $sana = hashPassword($_POST["password"]);
        insertNewUser($nimi, $sana, $email, $year);
    } else {
        echo "no";
    }
}

?>