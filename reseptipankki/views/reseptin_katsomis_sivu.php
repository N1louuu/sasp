<?php
ob_start();
require "partials/head.php";

$user_id = -1;
if (isset($_SESSION["userid"])) {
    $user_id = $_SESSION["userid"];
}

?>


<div class="w-100 d-flex flex-column align-items-center mt-5">

<h1>RESEPTI:</h1>

<?php

if (isset($_GET["resepti_id"])) {
    $resepti = getReseptiById($_GET["resepti_id"]);

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

    <div method='get' action='reseptin_katsomis_sivu.php' class='d-flex flex-row justify-content-between'>
        <h1>".$resepti["nimi"]."</h1>
        <h2>".$user["username"]."</h2>
    </div>
    <p class='fw-bold'>".$kategoria." - ".$resepti["lisäyspäivämäärä"]."</p>
    <h4 class='fw-bold'>aineosat:</h4>";
    echo "<ul>";

    $word = "";
    if ($resepti["ainesosaluettelo"] != "") {
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
    }

    echo "</ul>    
    <h4 class='fw-bold'>valmistusohjeet:</h4>
    <p>".$resepti["valmistusohjeet"]."</p>
    ";

    $binary_data = $resepti["images"];

    // Define the path where the image will be saved
    $image_path = 'temp_image/image.jpg';
    
    // Save the binary data as an image
    file_put_contents($image_path, $binary_data);

    echo '<img src="temp_image/image.jpg" alt="ei kuvaa" class="w-100 m-2">';


    if ($user_id == $resepti["lisääjä"]) {
        echo "
        <form method='get' action='reseptin_editoiminen.php'>
            <input name='resepti_id' type='text' value=".$resepti["id"]." class='d-none'>
            <input type='submit' class='form-control btn btn-primary' value='editoi'>
        </form>
        ";
    }

    echo "</div>";
    echo 
    "<form method='post' class='w-50'>
        <input type='submit' name='lataa' class='btn btn-warning' value='lataa pdf'>
    </form>
    ";
}

if (isset($_POST["lataa"])) {
    require_once('libraries/TCPDF-main/tcpdf.php');

    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->AddPage();
    
    // Set font
    $pdf->SetFont('dejavusans', '', 24);
    
    // Add content
    $pdf->Write(10, $resepti["nimi"]."  ".$resepti["lisäyspäivämäärä"]);

    $pdf->SetFont('dejavusans', '', 16);

    $pdf->Ln(10); // Moves down by 10 units
    $pdf->Ln(10); // Moves down by 10 units

    $word = "";
    if ($resepti["ainesosaluettelo"] != "") {
        foreach (mb_str_split($resepti["ainesosaluettelo"]) as $letter) {
            if ($letter == " ") {
                echo "<li>".$word."</li>";
                
                $pdf->Write(10, $word);
                $pdf->Ln(10); // Moves down by 10 units
                $word = "";
            } else {
                if ($letter != "-") {
                    $word .= $letter;
                } else {
                    $word .= " - ";
                }
            }
        }
        $pdf->Write(10, $word);
        $pdf->Ln(10); // Moves down by 10 units
    }

    $pdf->Ln(10); // Moves down by 10 units
    $pdf->Write(10, $resepti["valmistusohjeet"]);
    
    // Output PDF
    ob_end_clean();

    $pdf->Output('', 'D'); // 'D' forces download
    
}

?>

</div>


<?php

require "partials/footer.php"

?>