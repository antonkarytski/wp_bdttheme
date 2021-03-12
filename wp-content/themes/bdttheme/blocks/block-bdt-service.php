<?php
if(block_value('visible')) {
    $type = block_value('type');
    $classes = block_value('custom-classes');
    if ($type == 'bootstrapSimpleService') {
        $wrap = "<div class=\"row block-service $classes\">";
        $posts_per_row = block_value('blocks-per-line');
        $b_md_index = round(12 / $posts_per_row); //bootstrap index
        $b_xs_index = 4;
    } else if ($type == 'verticalStickyService')
        $wrap = "<div class=\"block-service-sticky\">";

    $renderString = $wrap;
    while (block_rows('inside-blocks')) {
        block_row('inside-blocks');
        //CLASSES
        $block_custom_classes = block_sub_value('block-custom-classes');


        if (block_sub_value('article-page'))
        {
            $block_post = block_sub_value('article-page');
        }
        else
        {
            $block_post = block_sub_value('article-post');
        }

        //IMAGE
        $image = "";
        if (block_sub_value('block-image')) {
            $image = wp_get_attachment_url(block_sub_value('block-image'));
        } else if ($block_post)
        {
            $image = get_the_post_thumbnail_url($block_post->ID);
        }

        //LINK
        $link = '#';
        if ($block_post)
            $link = get_permalink($block_post->ID);

        //TITLE
        $title = block_sub_value('title');
        if (!$title && $block_post) {
            $title = get_the_title($block_post->ID);
        }


        if ($type == 'bootstrapSimpleService') {
            if ($image)
                $image = "<img alt=\"\" src=\"$image\" />";
            if ($title)
                $title = "<span class='header'>$title</span>";
            $renderString .= "<div class=\"part-block $block_custom_classes\">";
            $renderString .= "<a href= \"$link\" class=\"img-block\">";
            $renderString .= $image;
            $renderString .= "$title</a></div>";
        } else if ($type == 'verticalStickyService') {
            if ($title)
                $title = "<h3>$title</h3>";
            $renderString .= "<div class=\"part-block\">";
            $renderString .= "<div class=\"section-title-holder left\">";
            $renderString .= "$title</div>";
            $renderString .= "<div class=\"section-content-holder right\" style=\"height: 500px;\">";
            $renderString .= "<div class=\"content-wrapper\"></div>";
            $renderString .= "</div></div>";
        }
    }
    $renderString .= "</div>";
    echo $renderString;
    reset_block_rows( 'inside-blocks');
}

