<?php
/**
 * ACF fields cho trang Điều Khoản Dịch Vụ (page template: page-dieu-khoan-dich-vu.php)
 */
add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) return;

	acf_add_local_field_group([
		'key'    => 'group_dieu_khoan_dich_vu',
		'title'  => 'Điều Khoản Dịch Vụ – Nội dung trang',
		'fields' => [

			[
				'key'     => 'field_dkdv_content_note',
				'label'   => '',
				'name'    => '',
				'type'    => 'message',
				'message' => 'Nội dung các mục điều khoản nhập ngay trong khung "Nội dung" (block editor) của trang. Mỗi mục dùng khối <strong>Heading</strong>, chọn cấp độ <strong>H2</strong> — số thứ tự (01, 02...), id neo và mục lục bên trái sẽ tự tạo theo đúng thứ tự các khối H2 này.',
			],
			[
				'key'           => 'field_dkdv_eyebrow',
				'label'         => 'Nhãn nhỏ trên tiêu đề',
				'name'          => 'eyebrow',
				'type'          => 'text',
				'default_value' => 'PHÁP LÝ',
			],
			[
				'key'           => 'field_dkdv_description',
				'label'         => 'Mô tả ngắn dưới tiêu đề',
				'name'          => 'description',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'Các điều khoản dưới đây áp dụng khi bạn truy cập website và sử dụng dịch vụ tư vấn, chăm sóc da tại Tamya. Vui lòng đọc kỹ trước khi đặt lịch và sử dụng dịch vụ.',
			],

		],
		'location' => [
			[
				[
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-dieu-khoan-dich-vu.php',
				],
			],
		],
		'menu_order'      => 10,
		'position'        => 'normal',
		'style'           => 'default',
		'label_placement' => 'top',
	]);
});
