<?php
/**
 * ACF field group for custom post type "dichvu"
 * Registered programmatically — no JSON file needed.
 */
add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) return;

	acf_add_local_field_group([
		'key'      => 'group_dichvu_popup',
		'title'    => 'Thông tin popup dịch vụ',
		'fields'   => [

			/* ── Card ─────────────────────────────── */
			[
				'key'           => 'field_service_card_label',
				'label'         => 'Nhãn phụ trên card (VD: Melasma Treatment)',
				'name'          => 'service_card_label',
				'type'          => 'text',
				'instructions'  => 'Hiển thị bên dưới tiêu đề trên card dịch vụ.',
			],

			/* ── Popup header ──────────────────────── */
			[
				'key'           => 'field_service_popup_subtitle',
				'label'         => 'Nhãn nhỏ đầu popup',
				'name'          => 'service_popup_subtitle',
				'type'          => 'text',
				'default_value' => 'Dịch vụ chuyên khoa da liễu',
			],
			[
				'key'           => 'field_service_popup_description',
				'label'         => 'Mô tả popup',
				'name'          => 'service_popup_description',
				'type'          => 'textarea',
				'rows'          => 4,
			],
			[
				'key'           => 'field_service_popup_tagline',
				'label'         => 'Câu tagline (in nghiêng)',
				'name'          => 'service_popup_tagline',
				'type'          => 'text',
			],
			[
				'key'           => 'field_service_popup_image',
				'label'         => 'Ảnh popup (cột phải)',
				'name'          => 'service_popup_image',
				'type'          => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
			],

			/* ── Tổng quan & chỉ số ────────────────── */
			[
				'key'        => 'field_service_overview',
				'label'      => 'Tổng quan & chỉ số trải nghiệm',
				'name'       => 'service_overview',
				'type'       => 'repeater',
				'max'        => 4,
				'layout'     => 'table',
				'button_label' => 'Thêm chỉ số',
				'sub_fields' => [
					[
						'key'           => 'field_overview_icon',
						'label'         => 'Icon',
						'name'          => 'overview_icon',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
						'column_width'  => '15',
					],
					[
						'key'          => 'field_overview_label',
						'label'        => 'Nhãn',
						'name'         => 'overview_label',
						'type'         => 'text',
						'column_width' => '30',
					],
					[
						'key'          => 'field_overview_value',
						'label'        => 'Nội dung',
						'name'         => 'overview_value',
						'type'         => 'textarea',
						'rows'         => 2,
						'column_width' => '55',
					],
				],
			],

			/* ── Hành trình chữa lành ──────────────── */
			[
				'key'        => 'field_service_journey',
				'label'      => 'Hành trình chữa lành',
				'name'       => 'service_journey',
				'type'       => 'repeater',
				'max'        => 4,
				'layout'     => 'table',
				'button_label' => 'Thêm bước',
				'sub_fields' => [
					[
						'key'           => 'field_journey_icon',
						'label'         => 'Icon',
						'name'          => 'journey_icon',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
						'column_width'  => '15',
					],
					[
						'key'          => 'field_journey_title',
						'label'        => 'Tên bước',
						'name'         => 'journey_title',
						'type'         => 'text',
						'column_width' => '30',
					],
					[
						'key'          => 'field_journey_desc',
						'label'        => 'Mô tả',
						'name'         => 'journey_desc',
						'type'         => 'textarea',
						'rows'         => 3,
						'column_width' => '55',
					],
				],
			],

			/* ── Bảng giá ──────────────────────────── */
			[
				'key'           => 'field_service_pricing_type',
				'label'         => 'Kiểu bảng giá',
				'name'          => 'service_pricing_type',
				'type'          => 'select',
				'choices'       => [
					'rows'    => 'Dạng hàng (cấp độ + thời gian + giá)',
					'columns' => 'Dạng cột (nhiều nhóm dịch vụ)',
				],
				'default_value' => 'rows',
				'instructions'  => 'Chọn "Dạng hàng" cho 1–3 mức giá. Chọn "Dạng cột" khi có nhiều nhóm dịch vụ.',
			],
			[
				'key'          => 'field_service_pricing',
				'label'        => 'Bảng giá — dạng hàng',
				'name'         => 'service_pricing',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Thêm mức giá',
				'conditional_logic' => [[
					['field' => 'field_service_pricing_type', 'operator' => '==', 'value' => 'rows'],
				]],
				'sub_fields' => [
					[
						'key'          => 'field_pricing_level',
						'label'        => 'Cấp độ / Tên dịch vụ',
						'name'         => 'pricing_level',
						'type'         => 'text',
						'column_width' => '30',
					],
					[
						'key'          => 'field_pricing_duration',
						'label'        => 'Thời gian (để trống nếu không cần)',
						'name'         => 'pricing_duration',
						'type'         => 'text',
						'column_width' => '35',
					],
					[
						'key'          => 'field_pricing_price',
						'label'        => 'Giá',
						'name'         => 'pricing_price',
						'type'         => 'text',
						'column_width' => '35',
					],
				],
			],
			[
				'key'          => 'field_service_pricing_columns',
				'label'        => 'Bảng giá — dạng cột',
				'name'         => 'service_pricing_columns',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Thêm nhóm dịch vụ',
				'conditional_logic' => [[
					['field' => 'field_service_pricing_type', 'operator' => '==', 'value' => 'columns'],
				]],
				'sub_fields' => [
					[
						'key'   => 'field_pricing_col_title',
						'label' => 'Tiêu đề nhóm',
						'name'  => 'col_title',
						'type'  => 'text',
					],
					[
						'key'          => 'field_pricing_col_items',
						'label'        => 'Mục giá trong nhóm',
						'name'         => 'col_items',
						'type'         => 'repeater',
						'layout'       => 'table',
						'button_label' => 'Thêm mục giá',
						'sub_fields'   => [
							[
								'key'          => 'field_pricing_item_label',
								'label'        => 'Tên dịch vụ',
								'name'         => 'item_label',
								'type'         => 'text',
								'column_width' => '55',
							],
							[
								'key'          => 'field_pricing_item_price',
								'label'        => 'Giá',
								'name'         => 'item_price',
								'type'         => 'text',
								'column_width' => '45',
							],
						],
					],
				],
			],
			[
				'key'   => 'field_service_pricing_note',
				'label' => 'Ghi chú bảng giá',
				'name'  => 'service_pricing_note',
				'type'  => 'text',
			],
			[
				'key'   => 'field_service_footer_text',
				'label' => 'Văn bản cuối popup',
				'name'  => 'service_footer_text',
				'type'  => 'textarea',
				'rows'  => 3,
			],

			/* ── Features (cột phải dưới ảnh) ─────── */
			[
				'key'        => 'field_service_features',
				'label'      => 'Điểm nổi bật (cột phải)',
				'name'       => 'service_features',
				'type'       => 'repeater',
				'max'        => 4,
				'layout'     => 'table',
				'button_label' => 'Thêm điểm nổi bật',
				'sub_fields' => [
					[
						'key'           => 'field_feature_icon',
						'label'         => 'Icon',
						'name'          => 'feature_icon',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
						'column_width'  => '20',
					],
					[
						'key'          => 'field_feature_text',
						'label'        => 'Nội dung',
						'name'         => 'feature_text',
						'type'         => 'text',
						'column_width' => '80',
					],
				],
			],

			/* ── Right bottom background ───────────── */
			[
				'key'           => 'field_service_right_bg',
				'label'         => 'Ảnh nền phần dưới cột phải (features + CTA)',
				'name'          => 'service_right_bg',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'medium',
			],

			/* ── CTA ───────────────────────────────── */
			[
				'key'   => 'field_service_cta_url',
				'label' => 'Link nút Tư vấn ngay',
				'name'  => 'service_cta_url',
				'type'  => 'url',
			],
			[
				'key'           => 'field_service_cta_note',
				'label'         => 'Ghi chú nhỏ bên dưới nút',
				'name'          => 'service_cta_note',
				'type'          => 'text',
				'default_value' => 'Tư vấn miễn phí · bảo mật thông tin · không áp lực mua liệu trình',
				'instructions'  => 'Hiển thị bên dưới nút Tư vấn ngay ở cột phải.',
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'dichvu',
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
