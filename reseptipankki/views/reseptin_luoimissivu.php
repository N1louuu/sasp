<?php

require "partials/head.php"

?>

<script defer>

id_counter=0

function aineetForm() {
    aineet = document.getElementsByClassName("aine_p")
    console.log(aineet)
    aine_input = document.getElementById("aine_input")
    aine_input2 = document.getElementById("aine_input2")


    for (let i = 0; i < aineet.length; i++) {
        const aine = aineet[i];
        aine_input.value += aine.innerHTML.replaceAll(" ", "")
        if (i < aineet.length-1) {
            aine_input.value += " "
        }
    }

    aine_input2.value = aine_input.value
}

function submitForm($form) {
    aineetForm()

    document.getElementById($form).submit();
}

function delete_parent(parent) {
    parent.remove()
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

function update_name() {
    resepti_nimi = document.getElementById("real_name");

    resepti_nimi_aine = document.getElementById("r_nimi");
    resepti_nimi_aine.value = resepti_nimi.value

    resepti_nimi_aine = document.getElementById("r_nimi2");
    resepti_nimi_aine.value = resepti_nimi.value

    resepti_nimi_aine = document.getElementById("r_nimi3");
    resepti_nimi_aine.value = resepti_nimi.value
}

function update_type() {
    resepti_type = document.getElementById("real_type");

    resepti_nimi_aine = document.getElementById("r_laji");
    resepti_nimi_aine.value = resepti_type.value

    resepti_nimi_aine = document.getElementById("r_laji2");
    resepti_nimi_aine.value = resepti_type.value

    resepti_nimi_aine = document.getElementById("r_laji3");
    resepti_nimi_aine.value = resepti_type.value
}

function update_ohje() {
    resepti_type = document.getElementById("real_ohje");

    resepti_nimi_aine = document.getElementById("r_ohje");
    resepti_nimi_aine.value = resepti_type.value

    resepti_nimi_aine = document.getElementById("r_ohje2");
    resepti_nimi_aine.value = resepti_type.value

    resepti_nimi_aine = document.getElementById("r_ohje3");
    resepti_nimi_aine.value = resepti_type.value
}

</script>

<?php

$resepti_nimi = "";
if (isset($_SESSION["resepti_nimi"])) {
    $resepti_nimi = $_SESSION["resepti_nimi"];
}

$resepti_ohje = "";
if (isset($_SESSION["resepti_ohje"])) {
    $resepti_ohje = $_SESSION["resepti_ohje"];
}

$resepti_laji = "";
if (isset($_SESSION["resepti_laji"])) {
    $resepti_laji = $_SESSION["resepti_laji"];
}

?>

<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>Luo resepti</h1>
    <form method="post" action="" class="w-50" id="resepti_form">
        <label for="nimi">resepti nimi:</label>
        <input onchange="update_name()" type="text" name="nimi" class="form-control" id="real_name" value="<?=$resepti_nimi?>" required>

        <label for="kategoria">kategoria:</label>
        <?php
        echo '<select onchange="update_type()" name="kategoria" class="form-control" id="real_type">
            <option value="1" '.($resepti_laji == 1 ? 'selected' : '').'>aamiainen</option>
            <option value="2" '.($resepti_laji == 2 ? 'selected' : '').'>pääruoka</option>
            <option value="3" '.($resepti_laji == 3 ? 'selected' : '').'>välipala</option>
            <option value="4" '.($resepti_laji == 4 ? 'selected' : '').'>jälkiruoka</option>
        </select>';
        ?>

        <label for="ohjeet">valmistusohjeet:</label>
        <textarea onchange="update_ohje()" name="ohjeet" rows="5" cols="33" class="form-control" id="real_ohje"><?=$resepti_ohje?></textarea>

        <input type="text" name="aineet" class="d-none" id="aine_input" value="">
    </form>

    <div class="w-50">
        <label for="kategoria">Aineosat:</label>
        <form method="post" class="d-flex flex-row mt-2 gap-2 align-items-center">
            <label for="ainenimi">Aine:</label>
            <input type="text" name="ainenimi" class="form-control" id="aine_nimi">

            <label for="määrä">Määrä:</label>
            <input type="text" name="määrä" class="form-control" id="aine_määrä">

            <input type="text" name="aineet2" class="d-none" id="aine_input2" value="">

            <!-- stoopid -->
            <input type="text" name="resepti_nimi_aine" class="d-none" id="r_nimi" value="<?=$resepti_nimi?>">
            <input type="text" name="resepti_ohje_aine" class="d-none" id="r_ohje" value="<?=$resepti_ohje?>">
            <input type="text" name="resepti_laji" class="d-none" id="r_laji" value="<?=$resepti_laji?>">

            <input type="submit" value="lisää" name="submit" class="d-none form-control btn btn-success mt-2">
            <button onclick="aineetForm()" class="form-control btn btn-success mt-2">lisää</button>
        </form>
        <h5 class="fw-bold">lista:</h5>
        <ul class="w-100 d-flex flex-column" id="aine_lista">
        <?php

        $aineet = "";
        if (isset($_SESSION["aineet"])) {
            $aineet = $_SESSION["aineet"];
        }


        $word = "";
        $i = 0;
        //echo $resepti["ainesosaluettelo"];
        if ($aineet != "") {
            foreach (mb_str_split($aineet) as $letter) {
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

        ?>
        </ul>
    </div>

    
    <form action="upload.php" method="post" enctype="multipart/form-data" class="w-50 mt-3 d-flex flex-column" id="img_form">
        Valitse kuva, jonka haluat lisätä:
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
        <input type="submit" value="Upload Image" name="submit" class="d-none form-control btn btn-success mt-2">

        <!-- stoopid -->
        <input type="text" name="resepti_nimi_aine" class="d-none" id="r_nimi2" value="<?=$resepti_nimi?>">
        <input type="text" name="resepti_ohje_aine" class="d-none" id="r_ohje2" value="<?=$resepti_ohje?>">
        <input type="text" name="resepti_laji" class="d-none" id="r_laji2" value="<?=$resepti_laji?>">

        <button onclick="aineetForm()" name="image_post" class="form-control btn btn-success mt-2">lisää</button>
    </form>

    <div class="w-50 mt-3 p-2 card d-flex flex-row flex-wrap">
    <?php
    $files = glob('images/*'); // get all file names
    foreach($files as $file){ // iterate files
        echo '<form method="post" class="d-flex flex-column w-100">
        <img src="'.$file.'" alt="kuvva" class="m-0 p-0" style="">
        <input type="text" value="'.$file.'" name="kuva_id" class="d-none">

        <!-- stoopid -->
        <input type="text" name="resepti_nimi_aine" class="d-none" id="r_nimi3" value="'.$resepti_nimi.'">
        <input type="text" name="resepti_ohje_aine" class="d-none" id="r_ohje3" value="'.$resepti_ohje.'">
        <input type="text" name="resepti_laji" class="d-none" id="r_laji3" value="'.$resepti_laji.'">

        <input type="submit" value="delete" name="poista_kuva" class="btn btn-danger">
        </form>';
    }

    ?>
    </div>
    
    <div class="w-50">
        <button class="form-control btn btn-primary mt-5" onclick="submitForm('resepti_form')">submit</button>
    </div>
    

</div>


<?php

if (isset($_POST["nimi"], $_POST["kategoria"], $_POST["ohjeet"])) {
    $nimi = htmlspecialchars($_POST["nimi"]);
    $kategoria = htmlspecialchars($_POST["kategoria"]);
    $ohjeet = htmlspecialchars($_POST["ohjeet"]);
    $aineet = htmlspecialchars($_POST["aineet"]);

    $lisääjä = $_SESSION["userid"];

    $kuvat = glob('images/*');
    $kuva = "";
    if (isset($kuvat[0])) {
        $kuva = $kuvat[0];
    }

    $_SESSION["aineet"] = "";
    $_SESSION["resepti_nimi"] = "";
    $_SESSION["resepti_ohje"] = "";
    $_SESSION["resepti_laji"] = "";

    insertNewResepti($nimi, $kategoria, $aineet, $ohjeet, $lisääjä, $kuva);

    $files = glob('images/*'); // get all file names
    foreach($files as $file){ // iterate files
    if(is_file($file)) {
        unlink($file); // delete file
    }
    }
}

if (isset($_POST["ainenimi"], $_POST["määrä"])) {
    $ainenimi = $_POST["ainenimi"];
    $määrä = $_POST["määrä"];

    $_SESSION["aineet"] = $_POST["aineet2"];

    if ($ainenimi != "" && $määrä != "") {
        if (strlen($_SESSION["aineet"]) > 0) {
            $_SESSION["aineet"] .= " ";
        }
        $_SESSION["aineet"] .= $ainenimi ."-".$määrä;
    }

    echo "<script>window.location = 'reseptin_luoimissivu.php'</script>";
}

if (isset($_POST["poista_kuva"])) {
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            if ($file == $_POST["kuva_id"]) {
                unlink($file); // delete file
            }
    }
    }
    echo "<script>window.location = 'reseptin_luoimissivu.php'</script>";
}

if (isset($_POST["resepti_nimi_aine"]) || isset($_POST["resepti_ohje_aine"]) || isset($_POST["resepti_laji"])) {
    // session shid
    $_SESSION["resepti_nimi"] = $_POST["resepti_nimi_aine"];
    $_SESSION["resepti_ohje"] = $_POST["resepti_ohje_aine"];
    $_SESSION["resepti_laji"] = $_POST["resepti_laji"];
}


require "partials/footer.php"

?>