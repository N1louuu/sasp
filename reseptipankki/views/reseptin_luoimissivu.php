<?php

require "partials/head.php"

?>


<div class="w-100 d-flex flex-column align-items-center mt-5">
    <h1>Luo resepti</h1>
    <form method="post" action="" class="w-50">
        <label for="nimi">resepti nimi:</label>
        <input type="text" name="nimi" class="form-control" required>

        <label for="kategoria">resepti nimi:</label>
        <select name="kategoria" class="form-control">
            <option value="aamiainen">aamiainen</option>
            <option value="pääruoka">pääruoka</option>
            <option value="välipala">välipala</option>
            <option value="jälkiruoka">jälkiruoka</option>
        </select>

        <label for="kategoria">Aineosat:</label>
        <div class="d-flex flex-row card mt-2">
            <label for="ainenimi">Aine:</label>
            <input type="text" name="ainenimi" class="form-control" required>

            <label for="määrä">Määrä:</label>
            <input type="text" name="määrä" class="form-control" required>

            <input type="submit" class="form-control btn btn-success mt-2" value="lisää">
        </div>

        <label for="ohjeet">valmistusohjeet:</label>
        <textarea name="ohjeet" rows="5" cols="33" class="form-control"></textarea>

    </form>
</div>


<?php

require "partials/footer.php"

?>