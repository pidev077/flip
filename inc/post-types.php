<?php

/**
 * Use this file to register any custom post types you wish to create.
 */
if (!function_exists('flip_create_custom_post_type')) {
	// Register Custom Post Type
	function flip_create_custom_post_type()
	{	

		register_post_type('teams', array(
			'labels' => [
				'name'               => 'Teams ',
				'singular_name'      => 'Teams',
				'add_new'            => 'Add New',
				'add_new_item'       => 'Add New Team',
				'edit_item'          => 'Edit Team',
				'new_item'           => 'New Team',
				'view_item'          => 'View Team',
				'search_items'       => 'Search Teams',
				'not_found'          => 'No case teams found',
				'not_found_in_trash' => 'No case teams found in Trash',
				'menu_name'          => 'Teams',
			],
			'description'        => 'Manage different teams',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-groups',
			'supports'           => ['title', 'editor', 'thumbnail', 'revisions', 'custom-fields'],
			'show_in_rest'       => false,
		));
	}

	add_action('init', 'flip_create_custom_post_type', 0);
}

if (!function_exists('flip_create_custom_taxonomy')) {
	function flip_create_custom_taxonomy()
	{

		

		register_taxonomy('team-category', array('teams'), array(
			'labels' => array(
				'name'              => 'Chuyên mục',
				'singular_name'     => 'Chuyên mục',
				'search_items'      => 'Tìm chuyên mục',
				'all_items'         => 'Tất cả chuyên mục',
				'parent_item'       => 'Chuyên mục cha',
				'parent_item_colon' => 'Chuyên mục cha:',
				'edit_item'         => 'Sửa chuyên mục',
				'update_item'       => 'Cập nhật chuyên mục',
				'add_new_item'      => 'Thêm chuyên mục mới',
				'new_item_name'     => 'Tên chuyên mục mới',
				'menu_name'         => 'Chuyên mục',
			),
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => false,
			'show_in_rest'      => true,
		));
	}

	add_action('init', 'flip_create_custom_taxonomy', 0);
}

if (!function_exists('flip_seed_team_category_terms')) {
	// Default job-title categories for the "teams" post type (Chuyên gia / Bác sĩ / Chuyên viên).
	function flip_seed_team_category_terms()
	{
		if (!taxonomy_exists('team-category')) {
			return;
		}

		$defaults = ['Chuyên gia', 'Bác sĩ', 'Chuyên viên'];

		foreach ($defaults as $term_name) {
			if (!term_exists($term_name, 'team-category')) {
				wp_insert_term($term_name, 'team-category');
			}
		}
	}

	add_action('init', 'flip_seed_team_category_terms', 5);
}

if (!function_exists('flip_register_team_category_acf_fields')) {
	// Group photo shown per tab in the "Đội ngũ chuyên môn" block.
	function flip_register_team_category_acf_fields()
	{
		if (!function_exists('acf_add_local_field_group')) {
			return;
		}

		acf_add_local_field_group(array(
			'key' => 'group_team_category_fields',
			'title' => 'Ảnh nhóm chuyên mục',
			'fields' => array(
				array(
					'key' => 'field_team_category_group_image',
					'label' => 'Ảnh nhóm',
					'name' => 'team_category_group_image',
					'type' => 'image',
					'return_format' => 'url',
					'preview_size' => 'medium',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'taxonomy',
						'operator' => '==',
						'value' => 'team-category',
					),
				),
			),
		));
	}

	add_action('acf/init', 'flip_register_team_category_acf_fields');
}

if (!function_exists('flip_register_dichvu_post_type')) {
	function flip_register_dichvu_post_type()
	{
		register_post_type('dichvu', [
			'labels' => [
				'name'          => 'Dịch vụ',
				'singular_name' => 'Dịch vụ',
				'add_new'       => 'Thêm mới',
				'add_new_item'  => 'Thêm dịch vụ mới',
				'edit_item'     => 'Chỉnh sửa dịch vụ',
				'new_item'      => 'Dịch vụ mới',
				'view_item'     => 'Xem dịch vụ',
				'search_items'  => 'Tìm dịch vụ',
				'not_found'     => 'Không tìm thấy dịch vụ',
				'menu_name'     => 'Dịch vụ',
			],
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 22,
			'menu_icon'          => 'dashicons-heart',
			'supports'           => ['title', 'thumbnail', 'excerpt', 'page-attributes'],
			'show_in_rest'       => true,
		]);
	}
	add_action('init', 'flip_register_dichvu_post_type', 0);
}

if (!function_exists('flip_register_sanpham_post_type')) {
	function flip_register_sanpham_post_type()
	{
		register_post_type('sanpham', [
			'labels' => [
				'name'          => 'Sản phẩm',
				'singular_name' => 'Sản phẩm',
				'add_new'       => 'Thêm mới',
				'add_new_item'  => 'Thêm sản phẩm mới',
				'edit_item'     => 'Chỉnh sửa sản phẩm',
				'new_item'      => 'Sản phẩm mới',
				'view_item'     => 'Xem sản phẩm',
				'search_items'  => 'Tìm sản phẩm',
				'not_found'     => 'Không tìm thấy sản phẩm',
				'menu_name'     => 'Sản phẩm',
			],
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 23,
			'menu_icon'          => 'dashicons-products',
			'supports'           => ['title', 'thumbnail', 'excerpt', 'page-attributes'],
			'show_in_rest'       => true,
			'rest_base'          => 'sanpham',
		]);
	}
	add_action('init', 'flip_register_sanpham_post_type', 0);
}

