document.addEventListener("DOMContentLoaded", function(){
    let tabsBlock = document.querySelectorAll(".bdt-tabs");
    tabsBlock.forEach(tabBlock =>{
        let navigation = tabBlock.querySelectorAll(".navigation > .menu a");
        console.log(navigation)

        navigation.forEach(button =>{
            button.addEventListener('click',function (e) {
                e.preventDefault();
                if(!e.target.classList.contains("current"))
                {
                    let href = e.target.getAttribute("data-href");
                    let contentWrap = e.target.closest(".bdt-tabs").querySelector(".content")
                    e.target.closest(".bdt-tabs").querySelector(".navigation").querySelector(".current").classList.remove("current");
                    e.target.classList.add("current");
                    selectTab(href, contentWrap);
                }
            });
        });
        let contentBlock = tabBlock.querySelector(".content")
        selectTab(0, contentBlock);
        tabBlock.querySelector(".navigation > .menu a[data-href = \"0\"]").classList.add("current");
    });


});

function selectTab(index, contentWrap)
{
    console.log(contentWrap);
    let activeBlock = contentWrap.querySelector(".inside-content.current");
    if(activeBlock)
        {
            activeBlock.classList.remove("current");
        }
    let newActiveBlock = contentWrap.querySelector(".inside-content[data-hash = \""+index+"\"]");
    newActiveBlock.classList.add("current");
}