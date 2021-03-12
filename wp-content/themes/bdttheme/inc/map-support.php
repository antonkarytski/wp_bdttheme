<?php
add_action('save_post_bdt_gallery', 'bdt_gallery_add_coordinates', 10, 3);
add_action('before_delete_post', 'bdt_gallery_erase_coordinates', 10, 3);


function bdt_gallery_add_coordinates($post_ID, $post, $post_before)
{
	$post_data = [
		 "id" => $post_ID,
		 "text" => get_field("map_short_desc", $post_ID),
		 "title" => $post->post_title,
		 "link" => get_permalink($post_ID)
	];
	$post_coordinate_pattern = "/ *(\-?\d{1,3}\.\d{2,7}), *(\-?\d{1,3}\.\d{2,7});?/";
	$post_coordinate_data_pattern = "/<mark><id>$post_ID<\/id>.+?<\/mark>/";
	$taxonomy_type = "bdt_gallery_cat";
	$taxonomies = get_the_terms($post_ID, "bdt_gallery_cat");
	if ($taxonomies) {
		foreach ($taxonomies as $taxonomy) {
			$taxonomyId = $taxonomy->term_id;
			$current_taxonomy = $taxonomy_type . "_" . $taxonomyId;
			$taxonomy_coordinates = get_field("map_marks_data", $current_taxonomy);
			$post_coordinates = get_field("map_coordinates", $post_ID);
			preg_match_all($post_coordinate_pattern, $post_coordinates, $coordinates, PREG_SET_ORDER);
			if ($coordinates[0]) {
				$post_data_xml = setXmlData($post_data, $coordinates);
				$post_pos = strpos($taxonomy_coordinates, "<id>$post_ID</id>");
				if ($post_pos !== FALSE) {
					$taxonomy_new_data = preg_replace($post_coordinate_data_pattern, $post_data_xml, $taxonomy_coordinates);
				} else {
					$taxonomy_new_data = $taxonomy_coordinates . $post_data_xml;
				}
			} else {
				$taxonomy_new_data = preg_replace($post_coordinate_data_pattern, "", $taxonomy_coordinates);
			}
			update_field("map_marks_data", $taxonomy_new_data, $current_taxonomy);
		}
	}
}

function bdt_gallery_erase_coordinates($post_ID, $post)
{
	if (get_post_type($post_ID) === 'bdt_gallery') {
		$post_coordinate_data_pattern = "/<mark><id>$post_ID<\/id>.+?<\/mark>/";
		$taxonomy_type = "bdt_gallery_cat";
		$taxonomies = get_the_terms($post_ID, $taxonomy_type);
		foreach ($taxonomies as $taxonomy) {
			$taxonomyId = $taxonomy->term_id;
			$current_taxonomy = $taxonomy_type . "_" . $taxonomyId;
			$taxonomy_coordinates = get_field("map_marks_data", $current_taxonomy);
			$taxonomy_new_data = preg_replace($post_coordinate_data_pattern, "", $taxonomy_coordinates);
			update_field("map_marks_data", $taxonomy_new_data, $current_taxonomy);
		}
	}
}


function setXmlData($post_data, $coordinates)
{
	$post_data_xml =
		 "<mark>" .
		 "<id>" . $post_data["id"] . "</id>" .
		 "<title>" . $post_data["title"] . "</title>" .
		 "<text>" . $post_data["text"] . "</text>" .
		 "<link>" . $post_data["link"] . "</link>" .
		 "<coordinates>";
	foreach ($coordinates as $coordinate) {
		$post_data_xml .=
			 "<coordinate>" .
			 "<lat>$coordinate[1]</lat>" .
			 "<lng>$coordinate[2]</lng>" .
			 "</coordinate>";
	}
	$post_data_xml .=
		 "</coordinates>" .
		 "</mark>";
	return $post_data_xml;
}