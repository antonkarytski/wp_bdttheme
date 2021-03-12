<?php if(block_row('visible')): ?>
<div class="acc-slider row block-carousel">

    <?php
    $currentFlag = true;
    $compiledSlider = "";
    while (block_rows('slides')) {
        block_row('slides');
        $img = wp_get_attachment_url(block_sub_value('slide-image'));
        $content = block_sub_value('content');
        $title = block_sub_value('title');
        $offset = block_sub_value('background-offset');
        $offset = "background-position: $offset%;";
        $current = '';
        if ($currentFlag) {
            $current = "current";
            $currentFlag = false;
        }

        $compiledSlider .=
            "<div class=\"link $current\">".
            "<div class=\"bg\" style=\"background-image: url($img); $offset\"></div>".
            "<div class=\"small\"><div class=\"thumbnail-title\">$title</div></div>".
            "<div class=\"full\">$content</div>".
            "</div>";
    }
    echo $compiledSlider;
    reset_block_rows( 'slides' );
    ?>
</div>
<?php endif; ?>
