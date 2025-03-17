<?php

session_start();
$id = session_id();
require "DBfunctions.php";

function näytäpisteet($pisteet) {
    echo "<p class=''>" . $pisteet . "/10</p>";
}

function lopeta() {
    header('Location: /index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>Visa</title>
</head>
<body>
    <div class="d-flex flex-column align-items-center justify-content-center w-100 mt-5">
        <?php
        echo "<h1>";
        switch($_SESSION["points"]) {
            case 0:
                echo "Hienosti!";
            break;

            case 1:
                echo "no... ainakin 1";
            break;

            case 2:
                echo "Olisit ajatellu vähän tarkemmin";
            break;

            case 3:
                echo "menikö onnella vai";
            break;

            case 4:
                echo "et taida olla tredulainen sittenkään";
            break;

            case 5:
                echo "paremminkin on muilla mennyt";
            break;

            case 6:
                echo "yli puolet";
            break;

            case 7:
                echo "hyvistä huonoin";
            break;

            case 8:
                echo "ei sen kummempi";
            break;

            case 9:
                echo "menee jo hyvin";
            break;

            case 10:
                echo "No nyt on kunnon tredu expertti paikalla!";
            break;
        }
        echo "</h1>";
    
        näytäpisteet($_SESSION["points"]);
    
        ?>
    
        <form action="" method="post">
            <input type="submit" name="valmis" value="Valmis!" class="form-control btn btn-primary">
    
        </form>
    </div>

<?php

if (isset($_POST["valmis"])) {
    lopeta();
}

?>

</body>
</html>