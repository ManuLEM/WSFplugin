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
		$return = '<div class="swipper-container"><div class="swipper-wrapper">';
		foreach ($slides as $slide => $image) {
			$return .= '<div class = "swipper-slide">' . wp_get_attachment_image($image['image']['id'], 'slider_size') . '</div>';
		}

		$return .= '</div></div>';

		return $return;
	}

	function enqueue() {
		wp_enqueue_script('slider-swiper', WSF_PORTFOLIO_URL . '/lib/idangerous.swiper.js', array('jquery'), "1.0", false);
		wp_enqueue_script('slider-js', WSF_PORTFOLIO_URL . '/js/main.js', array('jquery'), "1.0", true);
		wp_enqueue_style( 'swiper', WSF_PORTFOLIO_URL . '/lib/idangerous.swiper.css', false, "1.0", 'all' );
	}

	function image_size(){
		add_theme_support('post-thumbnails');
		add_image_size('slider_size', 400, 175, true );
	}

	function my_slider_galeries() {

		return;

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
