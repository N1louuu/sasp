<script>

function modalinfoX(user, name, type, rating, given_review, id) {

    mname = document.getElementById("modalname")
    mrating = document.getElementById("modalrating")
    review = document.getElementById("modalreview")
    mid = document.getElementById("modalid")
    mid2 = document.getElementById("modalid2")

    mname.value = name
    mrating.value = rating
    review.value = given_review
    mid.value = id
    mid2.value = id

}

function submitForm($form) {
    document.getElementById($form).submit();
}

</script>
<?php

require "partials/head.php";

function showReviews() {
    $reviews = getReviews();
    $user = $_SESSION["name"];

    $filter = "kaikki";
    if (isset($_GET["filter"])) {
        $filter = $_GET["filter"];
    }

    foreach ($reviews as $review) {
        if ($review["type"] == $filter || $filter == "kaikki") {
            echo "<div class='card m-2 p-2'>";
            echo "<div class='d-flex flex-row justify-content-between'>";
            echo "<h4>- " . $review["user"] . "</h4>";
            if ($review["user"] == $user) {
                echo "<button onClick='modalinfoX(\"".$review["user"]."\", \"".$review["name"]."\", \"".$review["type"]."\", \"".$review["rating"]."\", \"".$review["review"]."\" ,".$review["id"].")' class='btn btn-primary px-5' data-bs-toggle='modal' data-bs-target='#exampleModal'>edit</button>";
            }
            echo "</div>";
            echo "<div class='d-flex flex-row'>";
            echo "<h6 class='me-2'>" . htmlspecialchars($review["date"]) . "</h6>";
            echo "<h6 >" . htmlspecialchars($review["type"]) . "</h6>";
            echo "</div>";
            echo "<h2>" . htmlspecialchars($review["name"]) . "</h2>";
            echo "<p>" . htmlspecialchars($review["rating"]) . "/5</p>";
            echo "<p>" . htmlspecialchars($review["review"]) . "</p>";
            echo "</div>";
        }
    }
}

function makefilter() {
    $filter = "kaikki";
    if (isset($_GET["filter"])) {
        $filter = $_GET["filter"];
    }
    $arr = array("kaikki", "elokuva", "kirja", "sarja", "peli");
    echo 
    '<form action="" method="get" id="filter">
    <select name="filter" class="form-control mx-2" onchange="submitForm(\'filter\')">';
    foreach ($arr as $thing) {
        echo '<option';

        if ($filter == $thing) {
            echo ' selected="selected"';
        }
        
        echo ' value="'.$thing.'">'.$thing.'</option>';
    }

    echo 
    '</select>
    <input class="d-none" name="delete" value="1">
    </form>';
}

?>
<div class="d-flex justify-content-around w-100 mt-3">
    <h1>Arvostelut</h1>
</div>


<div class="d-flex justify-content-around w-100 mt-3">

<form action="" method="post">
    <input type="submit" name="logout" value="logout" class="btn btn-danger">
</form>

<a href="uusiArvostelu.php">Uusi arvostelu</a>


</div>
<?php
makefilter()
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTitle">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="" method="post" class="card d-flex flex-column mx-5 p-2" id="editForm">
            <label for="name">nimi:</label>
            <input type="text" name="name" class="form-control" id="modalname">

            <label for="rating">rating:</label>
            <input type="number" name="rating" class="form-control" id="modalrating" min="0" max="5">

            <input type="number" name="id" class="form-control d-none" id="modalid">

            <label for="review">review:</label>
            <input type="text" name="review" class="form-control" id="modalreview">
        </form>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <form action="" method="post">
                <input value="" type="number" name="id" class="form-control d-none" id="modalid2">
                <input class="d-none" name="delete" value="1">
                <button class="btn btn-danger">Delete</button>
            </form>
            <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('editForm')">Save changes</button>
            </div>
      </div>
    </div>
  </div>
</div>

<?php

showReviews();

if (isset($_POST["logout"])) {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();


    echo "<script>window.location='/'</script>";
}

if (isset($_POST["name"], $_POST["rating"], $_POST["review"])) {
    $nimi = $_POST["name"];
    $rating = min(max($_POST["rating"], 0), 5);
    $review = $_POST["review"];
    $user = $_SESSION["name"];
    $id = $_POST["id"];
    updateReview($nimi, $rating, $review, $id);
    echo "<script>window.location='/'</script>";
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    deleteReview($id);
    echo "<script>window.location='/'</script>";
}

require "partials/footer.php"

?>