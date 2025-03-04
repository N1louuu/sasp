<?php

require "partials/head.php"

?>

<h1>Kirjoita arvostelu</h1>

<form action="" method="post" class="card d-flex flex-column mx-5 p-2">
    <label for="name">nimi:</label>
    <input type="text" name="name" class="form-control">
    
    <label for="type">tyyppi:</label>
    <select name="type" class="form-control">
        <option value="elokuva">elokuva</option>
        <option value="kirja">kirja</option>
        <option value="laulu">laulu</option>
        <option value="peli">peli</option>
    </select>

    <label for="rating">rating:</label>
    <input type="number" name="rating" class="form-control" min="0" max="5">

    <label for="review">review:</label>
    <input type="text" name="review" class="form-control">

    <input type="submit" class="btn btn-primary mt-2">
</form>
    
<?php

if (isset($_POST["name"], $_POST["type"], $_POST["rating"], $_POST["review"])) {
    $nimi = htmlentities($_POST["name"]);
    $type = $_POST["type"];
    $rating = htmlentities($_POST["rating"]);
    $review = htmlentities($_POST["review"]);
    $user = $_SESSION["name"];
    insertNewReview($type, $nimi, $rating, $review, $user);
}

require "partials/footer.php"

?>