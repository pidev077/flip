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

if (!function_exists('flip_register_su_kien_dao_tao_post_type')) {
	function flip_register_su_kien_dao_tao_post_type()
	{
		register_post_type('su-kien-dao-tao', [
			'labels' => [
				'name'          => 'Sự kiện đào tạo',
				'singular_name' => 'Sự kiện đào tạo',
				'add_new'       => 'Thêm mới',
				'add_new_item'  => 'Thêm sự kiện đào tạo mới',
				'edit_item'     => 'Chỉnh sửa sự kiện đào tạo',
				'new_item'      => 'Sự kiện đào tạo mới',
				'view_item'     => 'Xem sự kiện đào tạo',
				'search_items'  => 'Tìm sự kiện đào tạo',
				'not_found'     => 'Không tìm thấy sự kiện đào tạo',
				'menu_name'     => 'Đào tạo',
			],
			'description'        => 'Các buổi đào tạo / workshop hiển thị trên trang Đào Tạo',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 24,
			'menu_icon'          => 'dashicons-welcome-learn-more',
			'supports'           => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
			'rewrite'            => ['slug' => 'su-kien-dao-tao'],
			'show_in_rest'       => true,
		]);
	}
	add_action('init', 'flip_register_su_kien_dao_tao_post_type', 0);
}

if (!function_exists('flip_register_su_kien_dao_tao_taxonomy')) {
	function flip_register_su_kien_dao_tao_taxonomy()
	{
		register_taxonomy('loai-su-kien', ['su-kien-dao-tao'], [
			'labels' => [
				'name'              => 'Loại chuyên gia',
				'singular_name'     => 'Loại chuyên gia',
				'search_items'      => 'Tìm loại chuyên gia',
				'all_items'         => 'Tất cả loại chuyên gia',
				'edit_item'         => 'Sửa loại chuyên gia',
				'update_item'       => 'Cập nhật loại chuyên gia',
				'add_new_item'      => 'Thêm loại chuyên gia mới',
				'new_item_name'     => 'Tên loại chuyên gia mới',
				'menu_name'         => 'Loại chuyên gia',
			],
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => false,
			'show_in_rest'      => true,
		]);
	}
	add_action('init', 'flip_register_su_kien_dao_tao_taxonomy', 0);
}

if (!function_exists('flip_seed_loai_su_kien_terms')) {
	// Nhãn badge mặc định hiển thị trên card sự kiện đào tạo.
	function flip_seed_loai_su_kien_terms()
	{
		if (!taxonomy_exists('loai-su-kien')) {
			return;
		}

		$defaults = ['Chuyên gia Hàn Quốc', 'Chuyên gia Việt Nam'];

		foreach ($defaults as $term_name) {
			if (!term_exists($term_name, 'loai-su-kien')) {
				wp_insert_term($term_name, 'loai-su-kien');
			}
		}
	}
	add_action('init', 'flip_seed_loai_su_kien_terms', 5);
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

if (!function_exists('flip_register_su_kien_post_type')) {
	function flip_register_su_kien_post_type()
	{
		register_post_type('su-kien', [
			'labels' => [
				'name'          => 'Sự kiện',
				'singular_name' => 'Sự kiện',
				'add_new'       => 'Thêm mới',
				'add_new_item'  => 'Thêm sự kiện mới',
				'edit_item'     => 'Chỉnh sửa sự kiện',
				'new_item'      => 'Sự kiện mới',
				'view_item'     => 'Xem sự kiện',
				'search_items'  => 'Tìm sự kiện',
				'not_found'     => 'Không tìm thấy sự kiện',
				'menu_name'     => 'Sự kiện',
			],
			'description'        => 'Workshop, talkshow, lễ ra mắt và các hoạt động hiển thị trên trang Sự Kiện',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-calendar-alt',
			'supports'           => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
			'rewrite'            => ['slug' => 'su-kien'],
			'show_in_rest'       => true,
		]);
	}
	add_action('init', 'flip_register_su_kien_post_type', 0);
}

if (!function_exists('flip_register_su_kien_taxonomy')) {
	function flip_register_su_kien_taxonomy()
	{
		register_taxonomy('danh-muc-su-kien', ['su-kien'], [
			'labels' => [
				'name'              => 'Danh mục sự kiện',
				'singular_name'     => 'Danh mục sự kiện',
				'search_items'      => 'Tìm danh mục',
				'all_items'         => 'Tất cả danh mục',
				'edit_item'         => 'Sửa danh mục',
				'update_item'       => 'Cập nhật danh mục',
				'add_new_item'      => 'Thêm danh mục mới',
				'new_item_name'     => 'Tên danh mục mới',
				'menu_name'         => 'Danh mục sự kiện',
			],
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => false,
			'show_in_rest'      => true,
		]);
	}
	add_action('init', 'flip_register_su_kien_taxonomy', 0);
}

if (!function_exists('flip_seed_danh_muc_su_kien_terms')) {
	// Danh mục dùng làm badge trên thẻ sự kiện + tab lọc trên trang Sự Kiện.
	// Một sự kiện có thể gắn nhiều danh mục, ví dụ vừa "Lễ ra mắt" vừa "Sắp diễn ra".
	function flip_seed_danh_muc_su_kien_terms()
	{
		if (!taxonomy_exists('danh-muc-su-kien')) {
			return;
		}

		$defaults = ['Sắp diễn ra', 'Đã diễn ra', 'Nội bộ', 'Vì Cộng đồng', 'Lễ ra mắt', 'Talkshow', 'Tri ân'];

		foreach ($defaults as $term_name) {
			if (!term_exists($term_name, 'danh-muc-su-kien')) {
				wp_insert_term($term_name, 'danh-muc-su-kien');
			}
		}
	}
	add_action('init', 'flip_seed_danh_muc_su_kien_terms', 5);
}

