<?php
/**
 * Font Awesome Kit Setup
 *
 * This will add your Font Awesome Kit to the front-end, the admin back-end,
 * and the login screen area.
 */

add_filter('wp_get_attachment_image_src','delete_width_height', 100, 4);
function delete_width_height($image, $attachment_id, $size, $icon){

    $image[1] = '';
    $image[2] = '';
    return $image;
}


if (! function_exists('fa_custom_setup_kit') ) {
  function fa_custom_setup_kit($kit_url = '') {
    foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
      add_action(
        $action,
        function () use ( $kit_url ) {
          wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
        }
      );
    }
  }
}

fa_custom_setup_kit('https://kit.fontawesome.com/4606866578.js');

/**
 * Font Awesome Kit Setup -- END*/
//Font Awesome SETUP

class Path{
	public static $libs = "/libs";
	public static $style = "/libs/style";
	public static $bdt_gallery_slag = "bdt_gallery";
	public static $bdt_gallery_cat_slag = "bdt_gallery_cat";
	public static $functions_slag = "temp/functions/function";

}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

require get_template_directory() . '/inc/custom-header.php'; // * Implement the Custom Header feature.
require get_template_directory() . '/inc/template-tags.php'; // * Custom template tags for this theme.
require get_template_directory() . '/inc/template-functions.php'; // * Functions which enhance the theme by hooking into WordPress.
require get_template_directory(). '/inc/init-tgm.php';
require get_template_directory(). '/inc/theme-options.php';
require get_template_directory() . '/inc/map-support.php';


add_action('after_setup_theme', 'bdt_setup');
function bdt_setup()
{
	load_theme_textdomain('bdt');
	add_theme_support('title-tag'); //FIGURE OUT
	add_theme_support('custom-logo', //FIGURE OUT
					  array('flex-width' => true)); //FIGURE OUT
	add_theme_support('post-thumbnails'); //FIGURE OUT
	add_theme_support('html5', array(  //FIGURE OUT
		'gallery',
		'caption'));

	add_theme_support('post-formats', array('gallery'));
	register_nav_menu('generalServices', 'General Services Menu');
	register_nav_menu('specialServices', 'Special Services Menu');
}

// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний

//SCRIPT LOADING
add_action( 'wp_enqueue_scripts', 'bdt_scripts' );
function bdt_scripts() {
	wp_enqueue_style( 'bdt-font-awesome-brands', get_template_directory_uri().Path::$libs."/font-awesome/wf/css/fa-brands.min.css");
	wp_enqueue_style( 'bdt-fa-colors', get_template_directory_uri().Path::$libs."/font-awesome/wf/css/fab-default-colors.css");
	wp_enqueue_style( 'bdt-bootstrap', get_template_directory_uri().Path::$libs."/bootstrap/css/bootstrap-grid.min.css");
	wp_enqueue_style( 'bdt-acc-slider', get_template_directory_uri().Path::$libs."/acc-slider/acc-slider.css");
	wp_enqueue_style( 'bdt-font-oswald', 'https://fonts.googleapis.com/css?family=Oswald');
	wp_enqueue_style( 'bdt-fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css');
	wp_register_style( 'bdt-owl-carousel', get_template_directory_uri().Path::$libs."/owl-carousel/assets/owl.carousel.min.css");
	wp_enqueue_style( 'bdt-style', get_stylesheet_uri() );


	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.1.1.min.js', array(), '3.1.1', false);
	wp_register_script( 'bdt-owl-carousel-script', get_template_directory_uri().Path::$libs.'/owl-carousel/owl.carousel.min.js', array('jquery'), _S_VERSION, true );
	wp_register_script( 'bdt-acc-slider-script', get_template_directory_uri().Path::$libs."/acc-slider/acc-slider.js", array(), _S_VERSION, true );
	wp_register_script( 'bdt-google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCV1YxqkxJB2rf943udFVH8_tMCu608Bk8&callback=initMap');
	//wp_enqueue_script( 'bdt-navigation', get_template_directory_uri().Path::$libs.'/navigation.js', array(), _S_VERSION, true );
	//wp_enqueue_script( 'bdt-skip-link-focus-fix', get_template_directory_uri() .Path::$libs.'/skip-link-focus-fix.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bdt-modules', get_template_directory_uri().Path::$libs.'/modules.js', array('jquery','bdt-owl-carousel-script'), _S_VERSION, true );
	wp_enqueue_script( 'bdt-tabs', get_template_directory_uri().Path::$libs."/tabs/tabs.js", array(), _S_VERSION, true );
	wp_enqueue_script( 'bdt-fancybox', "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js", array('jquery'), _S_VERSION, true );
}

add_action('init', 'bdt_register_post_types');
function bdt_register_post_types(){
	register_post_type('bdt_gallery', array(
		'labels'             => array(
			'name'               => 'Галерея', // Основное название типа записи
			'singular_name'      => 'Запись', // отдельное название записи типа Book
			'add_new'            => 'Добавить запись',
			'add_new_item'       => 'Добавить новую запись',
			'edit_item'          => 'Редактировать запись',
			'new_item'           => 'Новая запись',
			'view_item'          => 'Посмотреть запись',
			'search_items'       => 'Найти запись в галерее',
			'not_found'          =>  'Записей в галерее не найдено',
			'not_found_in_trash' => 'В корзине записей не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Галерея'

		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon'			 => "dashicons-images-alt",
		'rewrite'            => array('slug' => 'gallery'),
		'capability_type'    => 'post',
		'show_in_rest'		 => true,
		'taxonomies'		 => array("bdt_gallery_cat", "post_tag"),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 4,
		'supports'           => array('title','editor','author','thumbnail','excerpt')
	) );



	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'bdt_gallery_cat', [ 'bdt_gallery' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Рубрика галереи',
			'singular_name'     => 'Рубрика галереи',
			'search_items'      => 'Найти рубрику',
			'all_items'         => 'Все рубрики',
			'view_item '        => 'Посмотреть галерею',
			'parent_item'       => 'Родительская галерея',
			'parent_item_colon' => 'Родительская галерея:',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новую галерею ',
			'new_item_name'     => 'Имя новой галереи',
			'menu_name'         => 'Рубрики гелереи',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => false, // равен аргументу show_ui
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => true, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => false, // добавить в REST API
		'rest_base'             => null, // $taxonomy

		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	]);
}


add_action( 'after_setup_theme', 'bdt_custom_editor_styles' );
function bdt_custom_editor_styles(){
	add_theme_support( 'editor-styles' ); // включает поддержку
	add_editor_style('editor-style.css');
	// добавляет файл стилей style-editor.css
}






add_action('customize_register', 'bdt_customize_register');
function bdt_customize_register($wp_customize) //FIGURE OUT
{
	$wp_customize->add_setting( 'footer_bg' , array(
    	'default'   => '#000000',
    	'transport' => 'refresh',
) );
	$wp_customize->add_section( 'footer_bg_sect' , array(
    	'title'      => __( 'Футер', 'bdt' ),
    	'priority'   => 30,
) );
	
	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'logo',
           array(
               'label'      => __( 'Upload a logo', 'bdt' ),
               'section'    => 'footer_bg_sect',
               'settings'   => 'footer_bg',
               'context'    => 'your_setting_context' 
           )
       )
   );

}


function async_script_loading($tag, $handle) {

	$handles = array(
		'bdt_googleMap'
	);

	foreach( $handles as $defer_script) {
		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' async defer src', $tag );

			//AIzaSyCV1YxqkxJB2rf943udFVH8_tMCu608Bk8
		}
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'async_script_loading', 10, 2 );

function menu_selector_field( $field ) {

	$menus = get_terms(array("taxonomy" => "nav_menu"));
	foreach ($menus as $menu)
	{
		$field["choices"][$menu->term_id] = $menu->name;
	}
	$menu_field = get_nav_menu_locations();
	foreach ($menu_field as $field_name =>$menu)
	{
		$field["choices"]["field_type:".$field_name] = "Область ($field_name)";
	}
	return $field;
}

// Apply to fields named "example_field".
add_filter('acf/prepare_field/name=menu-navigation-name', 'menu_selector_field');
add_filter('acf/prepare_field/name=footer-navigation-name', 'menu_selector_field');
//General Page - About Us under Slider http://www.vancutsem.be/en/



//add_filter('wp_nav_menu_objects', 'css_for_nav_parrent');
//function css_for_nav_parent( $items ){
//	foreach( $items as $item ){
//
//	}
//	return $items;
//}

?>
