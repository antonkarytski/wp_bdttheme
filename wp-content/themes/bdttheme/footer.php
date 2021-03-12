<div id="site-footer">
    <?php
        $p = get_post();
        if(get_field("footer-settings-custom",$p))
        {
            if(get_field("footer-bg-type",$p))
            {
                $footer_bg = get_field("footer-bg-image",$p);
                $footer_bg = wp_get_attachment_url($footer_bg);
                $footer_bg = "background-image:url($footer_bg);";
            }
            else
            {
                $footer_bg = get_field("footer-bg-color",$p);
                $footer_bg = "background-color:$footer_bg;";
            }
            $footer_text_color = get_field("footer-text-color");
            $footer_text_color = "color: $footer_text_color;";
        }
        else
        {
            $footer_bg = get_theme_mod('footer_bg');
            $footer_bg = "background-image:url($footer_bg);";
        }
        $footer_style = "$footer_bg $footer_text_color";
    ?>
<div class="row overlay img-bg" style="<?php echo $footer_style ?>">
        <div class="col-xs-6 col-sm-4 col-md-5 col-lg-4 content navigation">
            <?php
            get_template_part("temp/functions/function","getMenuArgs");
            $menuArgs = getMenuArgs(["field_name" =>"footer-navigation-name"]);
            if($menuArgs) {
                $menu = wp_nav_menu(array(
                    'theme_location' => $menuArgs['theme_location'],
                    'menu' => $menuArgs['menu'],
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'menu_class' => 'menu list',
                    'container' => false
                ));
            }
            ?>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-offset-1 content contact-block">
            <div class=" buttons-block col-sm-6">
                <div class="row social-block">
                    <a href="https://t.me/belfortech" target="_blank">
						<i class="fab fa-telegram" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.instagram.com/bel_traveler/" target="_blank">
						<i class="fab fa-instagram" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="phone-container col-xs-12 col-sm-5 col-sm-offset-1">
                <div class="row">
                    <div class="col-xs-12">
                        <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> +375(29) 700-35-24</span>
						<i class="fab fa-whatsapp" aria-hidden="true" title="Этот телефон есть в whats up"></i>
                        <i class="fab fa-viber" title="Это телефон есть в viber"></i><br>
                        <span class="phone mts"><i class="fa fa-phone" aria-hidden="true"></i> +375(29) 700-35-27</span>
                        <i class="fab fa-whatsapp" aria-hidden="true" title="Это телефон есть в whats up"></i>
                        <i class="fab fa-viber" title="Это телефон есть в viber"></i><br>
                        <span class="phone" title="Факс"><i class="fa fa-phone" aria-hidden="true"></i> +375(44) 554-25-59</span>
                        <i class="fab fa-whatsapp" aria-hidden="true" title="Это телефон есть в whats up"></i>
                        <i class="fab fa-viber" title="Это телефон есть в viber"></i><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <span><i class="fa fa-envelope" aria-hidden="true"></i> E-mail: bdt_2010@mail.ru</span><br>
                        <span class="skype"><i class="fab fa-skype" aria-hidden="true"></i> Skype: bdt_2010</span><br>
                        <span class="skype"><i class="fa fa-info-circle" aria-hidden="true"></i> ATI: 728355</span><br>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<script>
    let gBLock = document.getElementsByClassName("block-gallery");
</script>
<?php wp_footer(); ?>