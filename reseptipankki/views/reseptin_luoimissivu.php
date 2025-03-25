<?php

require "partials/head.php"

?>

<script defer>

id_counter=0

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

function delete_parent(parent) {
    parent.remove()
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

<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>Luo resepti</h1>
    <form method="post" action="" class="w-50" id="resepti_form">
        <label for="nimi">resepti nimi:</label>
        <input type="text" name="nimi" class="form-control" required>

        <label for="kategoria">kategoria:</label>
        <select name="kategoria" class="form-control">
            <option value="1">aamiainen</option>
            <option value="2">pääruoka</option>
            <option value="3">välipala</option>
            <option value="4">jälkiruoka</option>
        </select>

        <label for="ohjeet">valmistusohjeet:</label>
        <textarea name="ohjeet" rows="5" cols="33" class="form-control"></textarea>

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
        <ul class="w-100 d-flex flex-column" id="aine_lista">

        </ul>
    </div>

    <div class="w-50">
        <button class="form-control btn btn-primary mt-2" onclick="submitForm('resepti_form')">submit</button>
    </div>


</div>


<?php

if (isset($_POST["nimi"], $_POST["kategoria"], $_POST["ohjeet"])) {
    $nimi = $_POST["nimi"];
    $kategoria = $_POST["kategoria"];
    $ohjeet = $_POST["ohjeet"];
    $aineet = $_POST["aineet"];

    $lisääjä = $_SESSION["userid"];

    insertNewResepti($nimi, $kategoria, $aineet, $ohjeet, $lisääjä);
}

require "partials/footer.php"

?>