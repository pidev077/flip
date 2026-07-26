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
			[
				'key'          => 'field_product_type_tag',
				'label'        => 'Loại sản phẩm (badge)',
				'name'         => 'product_type_tag',
				'type'         => 'text',
				'instructions' => 'VD: TONER, ESSENCE, SERUM, EMULSION, CREAM — hiển thị dạng "BƯỚC 0X · [loại]" trên popup.',
			],

			/* ── Thông số nhanh (3 cột trong popup) ── */
			[
				'key'   => 'field_product_skin_type',
				'label' => 'Loại da',
				'name'  => 'product_skin_type',
				'type'  => 'text',
			],
			[
				'key'   => 'field_product_texture',
				'label' => 'Kết cấu',
				'name'  => 'product_texture',
				'type'  => 'text',
			],
			[
				'key'   => 'field_product_volume',
				'label' => 'Dung tích',
				'name'  => 'product_volume',
				'type'  => 'text',
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

			/* ── Thành phần chính (mỗi thành phần 1 thẻ: tên + badge nồng độ tuỳ chọn + mô tả) ── */
			[
				'key'          => 'field_product_ingredients_repeater',
				'label'        => 'Thành phần chính',
				'name'         => 'product_ingredients',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Thêm thành phần',
				'sub_fields'   => [
					[
						'key'   => 'field_ingredient_name',
						'label' => 'Tên thành phần',
						'name'  => 'ingredient_name',
						'type'  => 'text',
					],
					[
						'key'          => 'field_ingredient_badge',
						'label'        => 'Badge nồng độ (tuỳ chọn)',
						'name'         => 'ingredient_badge',
						'type'         => 'text',
						'instructions' => 'VD: 5000PPM. Để trống nếu không có.',
					],
					[
						'key'   => 'field_ingredient_desc',
						'label' => 'Mô tả công dụng thành phần',
						'name'  => 'ingredient_desc',
						'type'  => 'textarea',
						'rows'  => 2,
					],
				],
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

			/* ── Cách dùng ── */
			[
				'key'           => 'field_product_usage',
				'label'         => 'Cách dùng',
				'name'          => 'product_usage',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
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
