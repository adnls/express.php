/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */

function toggleMenu() {

    var nav = document.querySelector("nav");
    var main = document.querySelector(".Main");
    
    if (nav.style.width === "0px"){
        nav.style.width = "250px";
        main.style.marginLeft = "250px";
    } else {
        nav.style.width = "0px";
        main.style.marginLeft = "0px";
    }
}