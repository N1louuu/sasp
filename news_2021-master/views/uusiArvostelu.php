<?php

require "partials/head.php"

?>


<h1>Kirjoita arvostelu</h1>

<form action="" method="post" class="card d-flex flex-column mx-5 p-2">
    <label for="name">nimi:</label>
    <input type="text" name="name" class="form-control">

    <label for="type">tyyppi:</label>
    <input type="text" name="type" class="form-control">

    <label for="rating">rating:</label>
    <input type="number" name="rating" class="form-control">

    <label for="review">review:</label>
    <input type="text" name="review" class="form-control">

    <input type="submit" class="btn btn-primary mt-2">
</form>
    
<?php

if (isset($_POST["name"], $_POST["type"], $_POST["rating"], $_POST["review"])) {
    $nimi = $_POST["name"];
    $type = $_POST["type"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];
    insertNewReview($type, $nimi, $rating, $review);
}

require "partials/footer.php"

?>