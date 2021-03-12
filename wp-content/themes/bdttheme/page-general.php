<?php
//Template name: General Page
get_header();
wp_enqueue_script('bdt-google-map');
the_post();
$custom_classes = get_field("site-body-custom-classes");
?>

<div id="site-body" class="<?= $custom_classes; ?>">
    <?php the_content(); ?>
</div>
<?php
if(get_field( "footer-settings-visible" ))
    get_footer();
else
    wp_footer();
?>

