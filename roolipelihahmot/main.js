function noNewTab(location) {
    window.location.href=location;
}
  
function newTab() {
    window.open(location, "_blank");
}

function submitModal() {
    document.getElementById("editForm").submit();
}

function StatCheck(cahnged, not1, not2) {
    current_input = document.getElementById(cahnged)

    not_changed1 = document.getElementById(not1)
    not_changed2 = document.getElementById(not2)
    total_p = document.getElementById("6000")

    total = 20
    available = total - current_input.value - not_changed1.value - not_changed2.value
    console.log(total)

    if (current_input.value<0) {
        current_input.value=0 
    }

    if (available<0) {
        current_input.value = parseInt(current_input.value)+parseInt(available)
    }
    
    available = total - current_input.value - not_changed1.value - not_changed2.value
    total_p.innerText = available

}

function showEdit(name, str, dex, int, id) {

    edit = document.getElementById("edit")
    modalTitle = document.getElementById("modalTitle")
    modalTitle.innerText = name

    str_input = document.getElementById("str-input")
    dex_input = document.getElementById("dex-input")
    int_input = document.getElementById("int-input") 
    charachterid_input = document.getElementById("charachterid-input")

    str_input.value = str
    dex_input.value = dex
    int_input.value = int

    charachterid_input.value = id


    i1 = document.getElementById("str-input")
    i2 = document.getElementById("dex-input")
    i3 = document.getElementById("int-input")
    total_p = document.getElementById("6000")

    total = 20
    available = total - i1.value - i2.value - i3.value
    total_p.innerText = available
}