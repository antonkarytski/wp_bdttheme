<?php
$posts_count = block_value("items-per-line");
$gallery_id = block_value("id");
$classes = block_value("additional-classes");
if($gallery_id)
{
    $gallery_id = "id = \"$gallery_id\"";
}
$category = block_value("gallery-category");
$tag_filter = block_value("tag-filter");
$posts = get_posts(array(
    'numberposts' => $posts_count,
    'post_type'   => 'bdt_gallery',
    'tag' => $tag_filter->slug,
    'suppress_filters' => true,
    'tax_query' => array(
        array(
            'taxonomy' => 'bdt_gallery_cat',
            'field' => 'slug',
            'terms' => $category->slug,
        )
    )
));
$style = "";
$bg_color = block_value("bg-color");
if($bg_color)
    $style = "style = \"background-color:$bg_color;\"";
?>
<div class="block-gallery <?php echo $classes ?>" <?php echo $gallery_id." ".$style; ?>>
<?php
foreach( $posts as $post ){
    setup_postdata($post);

    $img = get_the_post_thumbnail();
    $link = get_permalink();
    $title = "";
    if(block_value("title-visible"))
        $title = "<h4>".get_the_title()."</h4>";

    $short_text = "";
    if(block_value("description-visible"))
        $short_text = "<p>".get_field("map_short_desc")."</p>";

    echo "<div class=\"item\">";
    if(get_field("gallery_fast_post")){
        echo "<a data-fancybox data-type=\"ajax\" data-src=\"$link?fast=1\" href=\"javascript:;\">";
    }
    else{
        echo "<a href=\"$link\">";
    }
    echo "<div class=\"overlay\">$title<br>$short_text</div>";
    echo "$img</a>";
    echo "</div>";
}
wp_reset_postdata();
?>
</div>
