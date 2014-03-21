<?php
add_action('init', 'new_fields');

function new_fields(){
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_galeries-champs-additionnels',
			'title' => 'Galeries - champs additionnels',
			'fields' => array (
				array (
					'key' => 'field_5329c711ef08e',
					'label' => 'Images',
					'name' => 'images',
					'type' => 'repeater',
					'required' => 1,
					'sub_fields' => array (
						array (
							'key' => 'field_5329c86bef08f',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'column_width' => 50,
							'save_format' => 'object',
							'preview_size' => 'thumbnail',
							'library' => 'all',
						),
						array (
							'key' => 'field_5329c887ef090',
							'label' => 'Description',
							'name' => 'description',
							'type' => 'textarea',
							'column_width' => '',
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'formatting' => 'br',
						),
					),
					'row_min' => 0,
					'row_limit' => '',
					'layout' => 'table',
					'button_label' => 'Ajouter une image',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'galerie',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
	}
}