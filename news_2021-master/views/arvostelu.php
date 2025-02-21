<?php

require "partials/head.php"

?>

<h1>ADMINN</h1>

<div class="d-flex justify-content-around w-100 ">

<form action="" method="post">
    <input type="submit" name="logout" value="logout" class="btn btn-danger">
</form>

<a href="uusiArvostelu.php">Uusi arvostelu</a>


</div>


<?php

if (isset($_POST["logout"])) {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    session_regenerate_id();

    header('Location: /etusivu.php');
}

require "partials/footer.php"

?>