<?php

class shortcode_gallery {

	function __construct() {
		add_shortcode( 'slider', array( $this, 'shortcode_gallery'));
		add_action('init', array( $this, 'enqueue'), 30 );
		add_action('init', array( $this, 'image_size'), 30 );
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
		wp_enqueue_script('slider-swiper', WSF_PORTFOLIO_DIR . '/slider/idangerous.swiper.js', array('jquery'), "1.0", true);
		wp_enqueue_style( 'swiper', WSF_PORTFOLIO_DIR . '/slider/idangerous.swiper.css', false, "1.0", 'all' );
	}

	function image_size(){

		add_theme_support('post-thumbnails');
		add_image_size('slider_size', 400, 175, true );

	}
}