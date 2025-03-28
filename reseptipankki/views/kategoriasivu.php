<?php

require "partials/head.php"

?>

<script>

function submitForm($form) {
    console.log("!!!")
    document.getElementById($form).submit();
}

</script>

<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>Kategoriat 😎??</h1>

    <?php

$kategory = 0;
if (isset($_GET["kate"])) {
    $kategory = $_GET["kate"];
}

echo '
<form method="get" action="" class="mt-3 w-50" id="kategory_form">
<select name="kate" class="form-control" onchange="submitForm(\'kategory_form\')">
<option value="0" '.($kategory == 0 ? 'selected' : '').'>-- valitse --</option>
<option value="1" '.($kategory == 1 ? 'selected' : '').'>aamiainen</option>
<option value="2" '.($kategory == 2 ? 'selected' : '').'>pääruoka</option>
<option value="3" '.($kategory == 3 ? 'selected' : '').'>välipala</option>
<option value="4" '.($kategory == 4 ? 'selected' : '').'>jälkiruoka</option>
</select>
</form>
';

$reseptit = getReseptit();

foreach ($reseptit as $resepti) {
    if ($resepti["kategoria"] == $kategory || $kategory == 0) {
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
        echo "</div>";
    }
}

?>
</div>


<?php

require "partials/footer.php"

?>