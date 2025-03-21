<?php

require "partials/head.php"

?>


<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>SUN TIEDOT</h1>
    <p>- L</p>
    <p>- No skill</p>
    <p>- power: 0</p>
    <form method="post" action="">
        <input name="logout" type="submit" class="form-control btn btn-danger" value="kirjaudu ulos">
    </form>
</div>


<?php

require "partials/footer.php";

if (isset($_POST["logout"])) {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();


    header('Location: /etusivu.php');
}

?>