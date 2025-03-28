<?php

require "partials/head.php"

?>

<script defer>

function submitForm($form) {
    aineet = document.getElementsByClassName("aine_p")
    console.log(aineet)
    aine_input = document.getElementById("aine_input")

    for (let i = 0; i < aineet.length; i++) {
        const aine = aineet[i];
        aine_input.value += aine.innerHTML.replaceAll(" ", "")
        if (i < aineet.length-1) {
            aine_input.value += " "
        }
    }

    document.getElementById($form).submit();
}

id_counter=0

function delete_parent(elem) {
    elem.remove()
}

function delete_parent_by_id(id) {
    elem = document.getElementById(id)
    elem.parentElement.parentElement.remove()
}


function add_item() {
    aine_lista = document.getElementById("aine_lista")
    nimi = document.getElementById("aine_nimi")
    määrä = document.getElementById("aine_määrä")

    const li = document.createElement("li");
    li.id="aineosadiv"+id_counter

    const div = document.createElement("div");
    div.className = "d-flex flex-row align-items-center"

    const texti = document.createElement("p");
    texti.innerHTML = String(nimi.value).replaceAll("-", "") + " - " + String(määrä.value).replaceAll("-", "")
    texti.className = "aine_p"
    div.appendChild(texti);

    const buttoni = document.createElement("button");
    buttoni.innerHTML = "delete"
    buttoni.className = "m-2 btn btn-danger"
    div.appendChild(buttoni);
    
    li.appendChild(div);
    aine_lista.appendChild(li);
    
    
    buttoni.onclick = function() {delete_parent(buttoni.parentElement.parentElement)};

    nimi.value = ""
    määrä.value = ""

    id_counter++
}

</script>

<?php

if (isset($_GET["resepti_id"])) {
    $resepti = getReseptiById($_GET["resepti_id"]);

    echo '<div class="w-100 d-flex flex-column align-items-center mt-5">
        <h1>Editoi resepti</h1>
        <form method="post" action="" class="w-50" id="resepti_form">
            <label for="nimi">resepti nimi:</label>
            <input type="text" name="nimi" class="form-control" value="'.$resepti["nimi"].'" required>

            <label for="kategoria">resepti nimi:</label>
            <select name="kategoria" class="form-control">
                <option value="1" '.($resepti["kategoria"] == 1 ? 'selected' : '').'>aamiainen</option>
                <option value="2" '.($resepti["kategoria"] == 2 ? 'selected' : '').'>pääruoka</option>
                <option value="3" '.($resepti["kategoria"] == 3 ? 'selected' : '').'>välipala</option>
                <option value="4" '.($resepti["kategoria"] == 4 ? 'selected' : '').'>jälkiruoka</option>
            </select>

            <label for="ohjeet">valmistusohjeet:</label>
            <textarea name="ohjeet" rows="5" cols="33" class="form-control">'.$resepti["valmistusohjeet"].'</textarea>

            <input type="text" name="aineet" class="d-none" id="aine_input" value="">
        </form>

        <div class="w-50">
            <label for="kategoria">Aineosat:</label>
            <div class="d-flex flex-row mt-2 gap-2 align-items-center">
                <label for="ainenimi">Aine:</label>
                <input type="text" name="ainenimi" class="form-control" id="aine_nimi">

                <label for="määrä">Määrä:</label>
                <input type="text" name="määrä" class="form-control" id="aine_määrä">

                <button class="form-control btn btn-success" id="aine_nappi" onclick="add_item()">lisää</button>
            </div>
            <h5 class="fw-bold">lista:</h5>
            <ul class="w-100 d-flex flex-column" id="aine_lista">';

            $word = "";
            $i = 0;
            //echo $resepti["ainesosaluettelo"];
            if ($resepti["ainesosaluettelo"] != "") {
                foreach (mb_str_split($resepti["ainesosaluettelo"]) as $letter) {
                    if ($letter == " ") {
                        echo "<li><div class='d-flex flex-row align-items-center'><p class='aine_p'>$word</p>
                        <button class='m-2 btn btn-danger' id='$i' onclick='delete_parent_by_id(\"$i\")'>delete</button>
                        </div></li>";
                        $word = " ";
                    } else {
                        if ($letter != "-") {
                            $word .= $letter;
                        } else {
                            $word .= " - ";
                        }
                    }
                    $i++;
                }
                echo "<li><div class='d-flex flex-row align-items-center'><p class='aine_p'>$word</p>
                <button class='m-2 btn btn-danger' id='$i' onclick='delete_parent_by_id(\"$i\")'>delete</button>
                </div></li>";
            }

            echo '</ul>
        </div>
        
        <div class="w-50">
            <button class="form-control btn btn-primary mt-2" onclick="submitForm(\'resepti_form\')">submit</button>
        </div>

        <form method="post" class="w-50">
            <input type="submit" name="poista" class="form-control btn btn-danger mt-5" value="poista">
        </form>


    </div>';

}


if (isset($_POST["nimi"], $_POST["kategoria"], $_POST["ohjeet"])) {
    $nimi = $_POST["nimi"];
    $kategoria = $_POST["kategoria"];
    $ohjeet = $_POST["ohjeet"];
    $aineet = $_POST["aineet"];

    $lisääjä = $_SESSION["userid"];

    updateResepti($nimi, $kategoria, $aineet, $ohjeet, $_GET["resepti_id"]);
    echo "<script>window.location = 'etusivu.php'</script>";
}

if (isset($_POST["poista"])) {
    deleteResepti($_GET["resepti_id"]);
    echo "<script>window.location = 'etusivu.php'</script>";
}

require "partials/footer.php"

?>