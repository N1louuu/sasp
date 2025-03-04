function noNewTab(location) {
    window.location.href=location;
}
  
function newTab() {
    window.open(location, "_blank");
}

function modalinfo(user, name, type, rating, review) {
    mname = document.getElementById("modalname")
    mtype = document.getElementById("modaltype")
    mrating = document.getElementById("modalrating")
    review = document.getElementById("modalreview")

    mname.value = name
    mtype.value = type
    mrating.value = rating
    review.value = review

    console.log("HEYYY")
}