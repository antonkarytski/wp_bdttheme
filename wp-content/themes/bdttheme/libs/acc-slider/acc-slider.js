document.addEventListener("DOMContentLoaded", function(){
    let links =  document.querySelectorAll(".acc-slider > .link");
    links.forEach(function(link){
        let linkButton = link.querySelector(".small");
        linkButton.addEventListener('click',function (e) {
            e.target.closest('.acc-slider').querySelector('.link.current').classList.remove("current");
            e.target.closest('.link').classList.add("current");
        });
    });
});