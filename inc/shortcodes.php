<?php

class shortcode_gallery {

	function __construct() {
		add_shortcode( 'slider', array( $this, 'shortcode_gallery'));
		add_action('init', array( $this, 'enqueue'), 30 );
		add_action('init', array( $this, 'image_size'), 30 );
		add_action('init', array( $this, 'my_slider_galeries'), 30 );
		add_action('admin_footer', array( $this, 'prompt_box'), 30 );
	}

	function shortcode_gallery($atts){
		extract( shortcode_atts( array(
			'id_gallery' => '',
		), $atts));

		$slides = get_field('images', $id_gallery);

		$return = '<div class="swipper-container"><div class="swipper-wrapper">';
		foreach ($slides as $slide => $image) {
			$return .= '<div class="swipper-slide">' . wp_get_attachment_image($image['image']['id'], 'slider_size') . '</div>';
		}

		$return .= '</div></div>';

		return $return;
	}

	function enqueue() {
		wp_enqueue_script('slider_swiper', WSF_PORTFOLIO_URL . '/lib/idangerous.swiper.js', array('jquery'), "1.0", false);
		wp_enqueue_script('slider_js', WSF_PORTFOLIO_URL . '/js/main.js', array('jquery'), "1.0", true);
		wp_enqueue_style( 'swiper', WSF_PORTFOLIO_URL . '/lib/idangerous.swiper.css', false, "1.0", 'all' );
	}

	function image_size(){
		add_theme_support('post-thumbnails');
		add_image_size('slider_size', 400, 175, true );
	}

	function my_slider_galeries() {

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
			return;
		}

		if ( get_user_option('rich_editing') == 'true' ) {
			
			add_filter( 'mce_external_plugins', array( $this, 'add_plugin') );
			add_filter( 'mce_buttons', array( $this, 'register_button') );

			wp_enqueue_style( 'galerie_shortcode_form', WSF_PORTFOLIO_URL . '/lib/style.css', false, "1.0", 'all' );
			wp_enqueue_script('button_js', WSF_PORTFOLIO_URL . '/js/button.js', array('jquery', 'tinymce'), "1.0", true);
		}

	}

	function prompt_box(){
		$gallery_query = new WP_Query( array(
			'post_type' => 'galerie'
		) );

		if (!$gallery_query->have_posts() ){
			return;
		}

		$box = "<div id='gallery-plugin' class='prompt'>
			<form>
				<label>Nom de la galerie:</label>
				<br>
				<select id='shortcode_list'>
					<option value=''>Choisissez votre galerie</option>";

					while ($gallery_query->have_posts()):
							$gallery_query->the_post();
							$box .= "<option value='" . get_the_ID() . "'>";
								$box .= get_the_title();
							$box .= "</option>";
					endwhile;
				$box .= "</select>
				<br>
				<input type='submit' value='Valider'/>
				<input class='shortcode_cancel' type='button' value='Cancel'/>
			<form>
		</div>";
		
		echo $box;
	}

	function register_button( $buttons ) {
	   array_push( $buttons, "|", "galeries" );
	   return $buttons;
	}

	function add_plugin( $plugin_array ) {
		$plugin_array['galeries'] = WSF_PORTFOLIO_URL . '/js/button.js';
		return $plugin_array;
	}
	
}
