<script>
function modalinfo(user, name, type, rating, given_review, id) {
    mname = document.getElementById("modalname")
    mtype = document.getElementById("modaltype")
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

function submitModal() {
    document.getElementById("editForm").submit();
}

</script>
<?php

require "partials/head.php";

function showReviews() {
    $reviews = getReviews();
    $user = $_SESSION["name"];

    foreach ($reviews as $review) {
        if ($user == $review["user"]) {
            echo "<div class='card m-2 p-2'>";
            echo "<div class='d-flex flex-row justify-content-between'>";
            echo "<h4>- " . $review["user"] . "</h4>";
            echo "<button onClick='modalinfo(\"".$review["user"]."\", \"".$review["name"]."\", \"".$review["type"]."\", \"".$review["rating"]."\", \"".$review["review"]."\" ,".$review["id"].")' class='btn btn-primary px-5' data-bs-toggle='modal' data-bs-target='#exampleModal'>edit</button>";
            echo "</div>";
            echo "<div class='d-flex flex-row'>";
            echo "<h6 class='me-2'>" . $review["date"] . "</h6>";
            echo "<h6 >" . $review["type"] . "</h6>";
            echo "</div>";
            echo "<h2>" . $review["name"] . "</h2>";
            echo "<p>" . $review["rating"] . "/5</p>";
            echo "<p>" . $review["review"] . "</p>";
            echo "</div>";
        }
    }
}

?>

<div class="mt-3 d-flex justify-content-around w-100 ">
    <h1>My page</h1>
    
    <form action="" method="post">
        <input type="submit" name="logout" value="logout" class="btn btn-danger">
    </form>
</div>

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
                <button type="button" class="btn btn-primary" onclick="submitModal()">Save changes</button>
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
    echo "<script>window.location='/omasivu.php'</script>";
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    deleteReview($id);
    echo "<script>window.location='/omasivu.php'</script>";
}

require "partials/footer.php"

?>