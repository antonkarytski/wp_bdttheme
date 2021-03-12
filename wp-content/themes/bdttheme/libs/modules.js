class owlCarouselAdj {
    constructor(settings) {
        Object.assign(this.settings,settings);
        this.settings = {
            selector : ".owl-carousel",
            loop: true,
            margin:0,
            items: 1,
            nav: false,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause:false,
            mouseDrag: true,
            touchDrag: true,
        };
    }

    on() {
        console.log(this.settings);
        let blocks = document.querySelectorAll(this.settings.selector + ":not(.owl-loaded)");
        blocks.forEach(block=>
        {
            let slides = block.querySelectorAll(this.settings.selector + "> div");
            this.setDraggableSettings(slides.length);
            $(this.settings.selector).owlCarousel(this.settings);
        });
    }


    setDraggableSettings(length)
    {
        // set draggable parameters like: mouseDrag, touchDrag, loop, include set by user, in case if carousel has only one
        // slide, these parameters will set in false
        let lengthMask = length>1;
        this.settings.loop = this.settings.loop && lengthMask;
        this.settings.mouseDrag = this.settings.mouseDrag && lengthMask;
        this.settings.touchDrag = this.settings.touchDrag && lengthMask;
    }
}

$(document).ready(function(){
    // SVG SETTINGS
    let svgBlocks = document.querySelectorAll("svg");
    svgBlocks.forEach(svgBlock =>
    {
        const targetBlocksFill = (targetBlock,e) => {targetBlock.style.fill = e.value;};
        for(let i = 0; i<svgBlock.parentElement.attributes.length; i++)
        {
            let e = svgBlock.parentElement.attributes.item(i);
            let colorAttr = "data-color-";
            if(e.name.startsWith(colorAttr))
            {
                const targetBlockName = e.name.substr(colorAttr.length,e.name.length - colorAttr.length);
                const targetBlocks = svgBlock.querySelectorAll("."+targetBlockName);
                for(let targetBlock of  targetBlocks) {
                    targetBlocksFill(targetBlock,e);
                }
            }
        }
    });
    /*
     *
     * BURGER MENU
     *
     */

    function burgerMenu(selector) {
        let menu = $(selector);
        let button = menu.find('.burger-nav-button, .burger-nav-lines');
        let links = menu.find('.menu-item a');
        let overlay = menu.find('.burger-menu-overlay');

        button.on('click', (e) => {
            e.preventDefault();
            toggleMenu();
        });

        links.on('click', () => toggleMenu());
        overlay.on('click', () => toggleMenu());

        function toggleMenu(){
            menu.toggleClass('active');

            if (menu.hasClass('active')) {
                $('body').css('overflow', 'hidden');
            } else {
                $('body').css('overflow', 'visible');
            }
        }
    }

    burgerMenu('.burger-navigation');
});