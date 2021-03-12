<?php
//Template name: Contacts Page
get_header();
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

