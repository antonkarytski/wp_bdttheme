<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
$siteHeaderClasses = get_field("menu-additional-classes");
if ($siteHeaderClasses) {
	$siteHeaderClasses = "class = \"$siteHeaderClasses\"";
}
?>
<div id="site-header" <?= $siteHeaderClasses ?>>
	<?php
	$style = "";
	if (get_field("menu-additional-align") || get_field("menu-navigation-text-color")) {
		$style = "style=\"";
		if (get_field("menu-additional-align"))
			$style .= "justify-content: " . get_field("menu-additional-align") . ";";
		if (get_field("menu-navigation-text-color"))
			$style .= " color: " . get_field("menu-navigation-text-color") . "; ";
		$style .= "\"";
	}
	?>
    <div class="inside-wrap" <?= $style ?>>
		 <?php
		 $style = "";
		 if (get_field("menu-navigation-block-custom-width"))
			 $style = "style=\"width: " . get_field("menu-navigation-block-width") . "%;\"";
		 if (get_field("menu-navigation-block-visible")):
			 ?>

           <div class="navigation" <?= $style ?>>
               <nav>
						<?php
						get_template_part("temp/functions/function", "getMenuArgs");
						$menuArgs = getMenuArgs();
						if ($menuArgs) {
							$menu = wp_nav_menu(array(
								 'theme_location' => $menuArgs['theme_location'],
								 'menu' => $menuArgs['menu'],
								 'items_wrap' => '<ul class="%2$s">%3$s</ul>',
								 'menu_class' => 'menu inline',
								 'container' => false
							));
						}
						?>
               </nav>
           </div>
           <div class="burger-navigation">
               <a href="" class="burger-nav-button" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))">
                   <svg class="line-box" viewBox="0 0 100 100">
                       <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                       <path class="line line2" d="M 20,50 H 80" />
                       <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                   </svg>
               </a>
               <nav class="burger-nav-list">
                   <ul>
						<?php
						if ($menuArgs) {
							$menu = wp_nav_menu(array(
								 'theme_location' => $menuArgs['theme_location'],
								 'menu' => $menuArgs['menu'],
								 'items_wrap' => '%3$s',
								 'container' => false
							));
						}
						$menu = wp_nav_menu(array(
							 'theme_location' => "generalServices",
							 'items_wrap' => '%3$s',
							 'container' => false
						));
						?>
                   </ul>
               </nav>
               <div class="burger-menu-overlay"></div>
           </div>

		 <?php
		 endif;
		 $style = "";
		 if (get_field("menu-logo-block-custom-width"))
			 $style = "style=\"width: " . get_field("menu-logo-block-width") . "%\"";
		 ?>
        <div class="logo-block" <?= $style ?>>
            <div class="logo-container">
					<?php
					$gearColor = get_field("logo-gear-color");
					$textColor = get_field("logo-text-color");
					if ($gearColor) {
						$gearColor = "data-color-gear=\"$gearColor\"";
					}
					if ($textColor) {
						$textColor = "data-color-logo-text=\"$textColor\"";
					}
					$homeUrl = home_url() . "/";
					echo "<a href=\"$homeUrl\" $gearColor $textColor>";
					get_template_part("temp/svg/inline", "logo1.svg");
					echo "</a>";
					?>
            </div>
        </div>
		 <?php
		 $style = "";
		 if (get_field("menu-contacts-block-custom-width") || get_field("menu-contacts-block-text-color"))
			 $style = "style=\"";
		 if (get_field("menu-contacts-block-custom-width"))
			 $style .= "width: " . get_field("menu-contacts-block-width") . "%; ";
		 if (get_field("menu-contacts-block-text-color"))
			 $style .= "color: " . get_field("menu-contacts-block-text-color") . "; ";
		 $style .= "\"";
		 ?>
		 <?php if (get_field("menu-contacts-block-visible")): ?>
           <div class="phone-container" <?= $style ?>>
				  <?php $contactsBlockType = get_field("menu-contacts-block-type");
				  if ($contactsBlockType == "defaultTransport"): ?>
                  <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> +375(29) 700-35-24</span><br>
                  <span class="email"><i class="fa fa-envelope" aria-hidden="true"></i> bdt_2010@mail.ru</span><br>
                  <span class="email"><i class="fa fa-skype" aria-hidden="true"></i> bdt_2010</span><br>
				  <?php elseif ($contactsBlockType == "defaultService"): ?>
                  <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> +375(44) 554-25-59</span><br>
                  <span class="email"><i class="fa fa-phone" aria-hidden="true"></i> +375(29) 700-35-24</span><br>
                  <span class="email"><i class="fa fa-envelope" aria-hidden="true"></i> service@belroad.ru</span><br>
				  <?php endif; ?>
           </div>
		 <?php endif; ?>
    </div>
</div>