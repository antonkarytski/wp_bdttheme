<?php

if(!function_exists("boolToStr"))
{
    function boolToStr($var)
    {
        if($var)
            return "true";
        return "false";
    }
}


if (block_value('visible')):

    $items = block_value('items');
    $loop = boolToStr(block_value('loop'));
    $mouseDrag = boolToStr(block_value('mouse-drag'));
    $touchDrag = boolToStr(block_value('touch-drag'));
    $pullDrag = boolToStr(block_value('pull-drag'));
    $freeDrag = boolToStr(block_value('free-drag'));
    $startPosition = block_value('start-position');
    if(!(int)$startPosition == $startPosition)
        $startPosition = "\"#$startPosition\"";
    $autoplay = boolToStr(block_value('autoplay'));
    $autoplayTimeout = block_value('autoplay-timeout');
    $autoplayHoverPause = boolToStr(block_value('autoplay-hover-pause'));


    $renderString = '';
    if (block_value('wrap') == 'none')

        $renderString .= '';
    else if (block_value('wrap') == 'block-carousel') {
        $renderString .= "<div class=\"row block-carousel\">";
    }

    $blockId = "";
    if(block_value('block-id'))
    {
        $blockId = " id = \"".block_value('block-id')."\"";
    }

    $carouselCustomClasses = block_value('custom-classes');


    $renderString .= "<div class=\"owl-carousel $carouselCustomClasses\" $blockId>";
    while (block_rows('slides')) {
        block_row('slides');

        $slideImage = wp_get_attachment_url(block_sub_value('slide-image'));
        $renderString .= "<div>";
        $renderString .= "<img src=\"$slideImage\"/>";
        $renderString .= "<div class=\"carousel-content-box row w-pad\">";
        $renderString .= block_sub_value('slide-content');
        $renderString .= "</div>";
        $renderString .= "</div>";
    }
    $renderString .= "</div>";
    if (!block_value('wrap') == 'none')
        $renderString .= "</div>";
    echo $renderString;
    reset_block_rows( 'slides' );

?>

<script>

    $(document).ready(function(){

        let owlSettings = {
            <?php
            echo block_value('block-id') ? "selector : \"#". block_value('block-id')."\"," : '';
            echo "items : $items,";
            echo "loop : $loop,";
            echo "mouseDrag : $mouseDrag,";
            echo "touchDrag : $touchDrag,";
            echo "pullDrag : $pullDrag,";
            echo "freeDrag : $freeDrag,";
            echo "startPosition : $startPosition,";
            echo "autoplay : $autoplay,";
            echo "autoplayTimeout : $autoplayTimeout,";
            echo "autoplayHoverPause : $autoplayHoverPause,";
            ?>
        };

        let owl = new owlCarouselAdj(owlSettings);
        owl.on();

    });
</script>


<?php
    endif
?>