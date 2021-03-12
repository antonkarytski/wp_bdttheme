<?php
$post = get_post();
isset($_GET['fast']) ? $single_gallery_flag = true : $single_gallery_flag = false;
if (!$single_gallery_flag):
	get_header("gallery");
	$gallery_class = "";
	$left_block_class = " ";
	$left_block_type = get_field("left-block-type");
	switch ($left_block_type) {
		case "route":
			$left_block_class = "route";
			$route = get_field("route");
			$left_block_content = "
                <div class=\"route\">
                    <h3>Маршрут:</h3>
                    <ul>
                        <li>" . $route["route_start"] . "</li>
                        <li>" . $route["route_end"] . "</li>
                    </ul>
                </div>";
			break;
		case "works":
			$left_block_class = "works";
			$lb_data = get_field("left-block-works");
			$works_text = $lb_data['works-text'];
			if ($works_text) {
				$left_block_content = "<div class=\"works\">";
				if ($lb_data['show-header']) {
					$left_block_content .= "<h3>Выполненные работы</h3>";
				}


				$left_block_content .= $works_text;

				$price = $lb_data['works-price'];
				if ($price) {
					$left_block_content .= "<h3>Цена</h3><p>$price</p>";
				}
				$left_block_content .= "</div>";
			}
			break;
		default:
			$gallery_class = "";
			$left_block_content = "";

	}
	$custom_bg_img = get_field('custom-bg');
	if ($custom_bg_img) {
		$header_image = $custom_bg_img;
	} else {
		$header_image = wp_get_attachment_image_src(get_post_thumbnail_id($post), 'large')[0];
	}

	$h_offset = get_field("offset-horizontal");
	$v_offset = get_field("offset-vertical");
	?>
    <div id="site-body" class="single-gallery <?= $gallery_class; ?>">
    <div class="single-gallery-header wp-block-cover has-background-dim"
         style="background-image:url(<?php echo $header_image; ?>);background-position:<?php echo "$h_offset% $v_offset%"; ?>;">
        <div class="wp-block-cover__inner-container">
            <div class="wp-block-columns">
                <div class="wp-block-column left <?= $left_block_class ?>">
                   <?= $left_block_content; ?>
                </div>
                <div class="wp-block-column text">
                    <div class="content">
                       <?= get_field("ext_description"); ?>
                    </div>
                    <div class="header-block-1">
                        <h1><?=$post->post_title; ?></h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif ?>
    <div class="single-gallery-content">
		 <?= $post->post_content; ?>
    </div>
    </div>
<?php
if (!$single_gallery_flag) get_footer("gallery", ["bg_image" => $header_image]);
?>