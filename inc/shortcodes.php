<?php

class shortcode_gallery {

	function __construct() {
		add_shortcode( 'slider', array( $this, 'shortcode_gallery'));
		add_action('init', array( $this, 'enqueue'), 30 );
		add_action('init', array( $this, 'image_size'), 30 );
		add_action('init', array( $this, 'my_slider_galeries'), 30 );
	}

	function shortcode_gallery($atts){
		extract( shortcode_atts( array(
			'id_gallery' => '',
		), $atts));

		$slides = get_field('images', $id_gallery);
		$return = '';
		foreach ($slides as $slide => $image) {
			$return .= wp_get_attachment_image($image['image']['id'], 'slider_size');
		}

		return $return;
	}

	function enqueue() {
		wp_enqueue_script('slider-swiper', WSF_PORTFOLIO_URL . '/lib/idangerous.swiper.js', array('jquery'), "1.0", true);
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
			$i = 1;
			echo "<div id='gallery-plugin' class='prompt'>
				<form>
					<label>Nom de la galerie:</label>
					<br>
					<select>
						<option value='1'>Test halala</option>
					</select>
					<br>
					<input type='submit' value='Valider'/>
				<form>
			</div>";
		}

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
