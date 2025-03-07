function submitForm($form) {
    document.getElementById($form).submit();

}

function submitAnswer($form, $answer, $correct, $given) {
    document.getElementById("ans").value = $answer;
    // document.getElementById($form).submit();

    document.getElementById("a1").disabled = true
    document.getElementById("a2").disabled = true
    document.getElementById("a3").disabled = true
    document.getElementById("a4").disabled = true
    document.getElementById("next").style = "display: block"

    document.getElementById($given).style = "color: red"
    document.getElementById($correct).style = "color: lightgreen"
}
