<?php
/**
 * ACF field group for custom post type "sanpham"
 * Registered programmatically — no JSON file needed.
 */
/* expose brand + subtitle to REST API so Gutenberg block editor can preview them */
add_action('rest_api_init', function () {
	foreach (['product_brand', 'product_subtitle'] as $field) {
		register_rest_field('sanpham', $field, [
			'get_callback' => fn($post) => get_field($field, $post['id']),
			'schema'       => ['type' => 'string'],
		]);
	}
});

add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) return;

	acf_add_local_field_group([
		'key'    => 'group_sanpham_popup',
		'title'  => 'Thông tin sản phẩm',
		'fields' => [

			/* ── Thông tin hiển thị trên card & popup ── */
			[
				'key'          => 'field_product_brand',
				'label'        => 'Thương hiệu (VD: LIVONE, RECV)',
				'name'         => 'product_brand',
				'type'         => 'text',
				'instructions' => 'Hiển thị dạng chữ in hoa trên card và popup.',
			],
			[
				'key'          => 'field_product_subtitle',
				'label'        => 'Tên phụ / dòng sản phẩm',
				'name'         => 'product_subtitle',
				'type'         => 'text',
				'instructions' => 'VD: Livone Vital Energy Toner — hiển thị nhỏ bên dưới tên chính.',
			],

			/* ── Gallery ── */
			[
				'key'           => 'field_product_gallery',
				'label'         => 'Thư viện ảnh sản phẩm',
				'name'          => 'product_gallery',
				'type'          => 'gallery',
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'insert'        => 'append',
				'instructions'  => 'Ảnh đầu tiên dùng làm thumbnail card. Có thể thêm nhiều ảnh để tạo slider trong popup.',
			],

			/* ── Thành phần chính ── */
			[
				'key'           => 'field_product_ingredients',
				'label'         => 'Thành phần chính',
				'name'          => 'product_ingredients',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'instructions'  => 'Dùng danh sách (ul/li) để liệt kê thành phần. Có thể in đậm tên thành phần.',
			],

			/* ── Công dụng ── */
			[
				'key'           => 'field_product_benefits',
				'label'         => 'Công dụng',
				'name'          => 'product_benefits',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'instructions'  => 'Dùng danh sách (ul/li) để liệt kê công dụng.',
			],

			/* ── CTA ── */
			[
				'key'   => 'field_product_cta_url',
				'label' => 'Link nút tư vấn',
				'name'  => 'product_cta_url',
				'type'  => 'url',
			],
			[
				'key'           => 'field_product_cta_label',
				'label'         => 'Nhãn nút tư vấn',
				'name'          => 'product_cta_label',
				'type'          => 'text',
				'default_value' => 'Tư vấn sản phẩm này',
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'sanpham',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	]);
});
