document.addEventListener('DOMContentLoaded', function(){
    if (location.pathname == "/") {
        checkWindowScroll();
    }
});

window.addEventListener('scroll', function(e) {
    checkWindowScroll();
});


function checkWindowScroll() {
    offset = window.pageYOffset;
    if (offset>0) {
        document.querySelector(".header_navbar_outer").classList.add("sticked");
    } else {
        document.querySelector(".header_navbar_outer").classList.remove("sticked");
    }
}

document.addEventListener('DOMContentLoaded', function(){
    document.querySelector(".toggle_navigation").addEventListener("click", function() {
        navi = document.querySelector(".header_navigation");
        if (navi.classList.contains("showed")) {navi.classList.remove("showed");} else {navi.classList.add("showed");} 
        if (this.innerText=="Меню") {this.innerText = "Закрыть";} else {this.innerText = "Меню";}
    });
});