
function StatCheck(cahnged, not1, not2) {
    current_input = document.getElementById(cahnged)

    not_changed1 = document.getElementById(not1)
    not_changed2 = document.getElementById(not2)
    total_p = document.getElementById("6000")

    total = 15
    available = total - current_input.value - not_changed1.value - not_changed2.value
    console.log(total)
    total_p.innerText = available

    if (current_input.value<0) {
        current_input.value=0 
    }

    if (!available>=0) {
        current_input.value-available
    }

}